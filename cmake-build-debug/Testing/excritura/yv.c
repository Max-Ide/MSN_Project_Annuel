//
// Created by Steph on 09/04/2023.
//
#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#include <stdbool.h>
#include <ctype.h>
#include <locale.h>
#include <mysql/mysql.h>
#include <microhttpd.h>

#define MAX_INPUT 500
#define PORT 5000

MYSQL *mysql_conn;

// Fonction pour se connecter à la base de données
void connect_to_database() {
    mysql_conn = mysql_init(NULL);

    if (!mysql_real_connect(mysql_conn, "localhost", "bot", "*", "", 0, NULL, 0)) {
        fprintf(stderr, "%s\n", mysql_error(mysql_conn));
        exit(1);
    }
}

// Fonction pour se déconnecter de la base de données
void disconnect_from_database() {
    mysql_close(mysql_conn);
}


// Fonction pour vérifier si une chaîne de caractères contient un mot-clé
bool contains_keyword(const char *str, const char *keyword) {
    // Dupliquer les chaînes de caractères pour les convertir en minuscules
    char *lower_str = strdup(str);
    char *lower_keyword = strdup(keyword);

    // Vérifier si les duplications ont réussi, sinon libérer la mémoire et retourner false
    if (!lower_str || !lower_keyword) {
        free(lower_str);
        free(lower_keyword);
        return false;
    }

    // Convertir la chaîne de caractères en minuscules
    for (int i = 0; lower_str[i]; i++) lower_str[i] = tolower(lower_str[i]);
    // Convertir le mot-clé en minuscules
    for (int i = 0; lower_keyword[i]; i++) lower_keyword[i] = tolower(lower_keyword[i]);

    // Vérifier si le mot-clé est présent dans la chaîne de caractères
    bool result = strstr(lower_str, lower_keyword) != NULL;

    // Libérer la mémoire des chaînes de caractères en minuscules
    free(lower_str);
    free(lower_keyword);

    // Retourner true si le mot-clé est présent dans la chaîne de caractères, sinon false
    return result;
}


// Fonction pour trouver la question la plus adaptée à la saisie de l'utilisateur
int find_best_matching_question(const char *input) {
    // Initialiser le nombre maximal de correspondances et l'ID de la question correspondante
    int max_matches = -1;
    int max_id = -1;

    // Préparer la requête SQL pour récupérer toutes les questions et leurs ID
    char query[] = "SELECT id, question FROM questions";
    // Exécuter la requête SQL
    if (mysql_query(mysql_conn, query)) {
        // En cas d'erreur, afficher le message d'erreur et retourner -1
        fprintf(stderr, "%s\n", mysql_error(mysql_conn));
        return -1;
    }

    // Stocker le résultat de la requête SQL
    MYSQL_RES *result = mysql_store_result(mysql_conn);
    MYSQL_ROW row;

    // Parcourir les lignes du résultat
    while ((row = mysql_fetch_row(result))) {
        // Initialiser le nombre de correspondances pour la question en cours
        int nb_matches = 0;
        // Récupérer l'ID et le texte de la question
        int question_id = atoi(row[0]);
        const char *question = row[1];
        char query_mot_cle[100];
        // Préparer la requête SQL pour récupérer les mots-clés associés à la question en cours
        snprintf(query_mot_cle, sizeof(query_mot_cle), "SELECT mot_cle FROM mots_cles WHERE question_id = %d", question_id);

        // Exécuter la requête SQL pour les mots-clés
        if (mysql_query(mysql_conn, query_mot_cle)) {
            // En cas d'erreur, afficher le message d'erreur et passer à l'itération suivante
            fprintf(stderr, "%s\n", mysql_error(mysql_conn));
            continue;
        }

        // Stocker le résultat de la requête SQL pour les mots-clés
        MYSQL_RES *result_mot_cle = mysql_store_result(mysql_conn);
        MYSQL_ROW row_mot_cle;
        // Parcourir les lignes du résultat pour les mots-clés
        while ((row_mot_cle = mysql_fetch_row(result_mot_cle))) {
            // Récupérer le mot-clé
            const char *mot_cle = row_mot_cle[0];
            // Si le mot-clé est présent dans la saisie de l'utilisateur, incrémenter le nombre de correspondances
            if (contains_keyword(input, mot_cle)) {
                nb_matches++;
            }
        }

        // Si le nombre de correspondances est supérieur ou égal au nombre maximal de correspondances précédent,
        // mettre à jour le nombre maximal de correspondances et l'ID de la question correspondante
        if (nb_matches >= max_matches) {
            max_matches = nb_matches;
            max_id = question_id;
        }

        // Libérer le résultat de la requête SQL pour les mots-clés
        mysql_free_result(result_mot_cle);
    }

    // Libérer le résultat de la requête SQL pour les questions
    mysql_free_result(result);
    // Retourner l'ID de la question la plus adaptée
    return max_id;
}


// Fonction pour obtenir une réponse en fonction de l'ID de la question
void get_answer_by_question_id(int id, char *buffer, size_t buffer_size) {
    // Préparer la requête SQL pour sélectionner la réponse correspondant à l'ID de la question
    char query[100];
    snprintf(query, sizeof(query), "SELECT reponse FROM reponses WHERE question_id = %d", id);

    // Exécuter la requête SQL
    if (mysql_query(mysql_conn, query)) {
        // Si une erreur se produit, afficher l'erreur et quitter le programme
        fprintf(stderr, "%s\n", mysql_error(mysql_conn));
        exit(1);
    }

    // Stocker le résultat de la requête SQL
    MYSQL_RES *result = mysql_store_result(mysql_conn);
    // Récupérer la première ligne du résultat (la réponse)
    MYSQL_ROW row = mysql_fetch_row(result);

    // Si une réponse a été trouvée
    if (row) {
        // Copier la réponse dans le buffer, en veillant à ne pas dépasser la taille du buffer
        strncpy(buffer, row[0], buffer_size - 1);
        // S'assurer que la chaîne de caractères est correctement terminée
        buffer[buffer_size - 1] = '\0';
    } else {
        // Si aucune réponse n'a été trouvée, utiliser un message d'erreur par défaut
        strncpy(buffer, "Je ne peux pas répondre à cette question.", buffer_size - 1);
        // S'assurer que la chaîne de caractères est correctement terminée
        buffer[buffer_size - 1] = '\0';
    }

    // Libérer la mémoire utilisée pour stocker le résultat de la requête SQL
    mysql_free_result(result);
}


// Fonction pour supprimer les sauts de ligne d'une chaîne de caractères
void remove_newline(char *str) {
    // Rechercher le caractère de saut de ligne ('\n') dans la chaîne
    char *newline = strchr(str, '\n');
    // Si un saut de ligne est trouvé, le remplacer par un caractère nul ('\0')
    if (newline) {
        *newline = '\0';
    }
}

// Fonction pour obtenir une réponse à partir d'une question
char * get_answer(char* question) {
    // Allouer de l'espace pour stocker la réponse
    char *answer = malloc(MAX_INPUT * sizeof(char));
    // Trouver l'ID de la question correspondant le mieux à la question en entrée
    int best_question_id = find_best_matching_question(question);
    // Afficher la valeur de best_question_id pour le débogage
    printf("La valeur de best_question_id est %d\n", best_question_id);

    // Si un ID de question a été trouvé
    if (best_question_id != -1) {
        // Récupérer la réponse correspondant à l'ID de la question
        get_answer_by_question_id(best_question_id, answer, MAX_INPUT);
        // Afficher la réponse
        printf("%s\n", answer);
    } else {
        // Si aucune question correspondante n'a été trouvée, utiliser un message d'erreur
        strcpy(answer, "Je ne peux pas répondre à cette question");
        printf("Je ne peux pas répondre à cette question.\n");
    }

    // Retourner la réponse
    return answer;
}



// Fonction pour envoyer la réponse au client
static int
send_response(struct MHD_Connection *connection, const char *response_str)
{
    struct MHD_Response *response;
    int ret;
    char *json_response;

    // Allouer suffisamment de mémoire pour la réponse JSON
    json_response = (char *) malloc(strlen(response_str) + 20);

    // Créer une réponse JSON valide
    sprintf(json_response, "{\"answer\":\"%s\"}", response_str);

    // Créer une réponse HTTP à partir du tampon de réponse JSON
    response = MHD_create_response_from_buffer(strlen(json_response), (void *)json_response, MHD_RESPMEM_MUST_FREE);
    if (!response)
        return MHD_NO;

    // Ajouter des en-têtes de réponse pour indiquer le type de contenu et les autorisations d'accès
    MHD_add_response_header(response, "Content-Type", "application/json");
    MHD_add_response_header(response, "Access-Control-Allow-Origin", "*");

    // Mettre en file d'attente la réponse pour l'envoi au client
    ret = MHD_queue_response(connection, MHD_HTTP_OK, response);

    // Détruire la réponse pour libérer la mémoire
    MHD_destroy_response(response);

    // Retourner le résultat de la mise en file d'attente de la réponse
    return ret;
}

// Structure pour stocker les données POST
struct PostData {
    char *data;
    size_t size;
};

// Fonction pour gérer les connexions entrantes
static int
answer_to_connection(void *cls, struct MHD_Connection *connection,
                     const char *url, const char *method,
                     const char *version, const char *upload_data,
                     size_t *upload_data_size, void **con_cls)
{
    if (0 == strcmp(method, "OPTIONS")) {
// Gérer les requêtes OPTIONS (preflight)
        struct MHD_Response *response;
        response = MHD_create_response_from_buffer(0, NULL, MHD_RESPMEM_PERSISTENT);
        MHD_add_response_header(response, "Access-Control-Allow-Origin", "*");
        MHD_add_response_header(response, "Access-Control-Allow-Headers", "Content-Type");
        MHD_add_response_header(response, "Access-Control-Allow-Methods", "GET, POST, OPTIONS");
        int ret = MHD_queue_response(connection, MHD_HTTP_OK, response);
        MHD_destroy_response(response);
        return ret;
    }

    if (0 != strcmp(method, "POST"))
        return MHD_NO; // accept que les requetes POST

    // Si le pointeur de contexte est NULL, allouer et initialiser un nouvel objet PostData
    if (*con_cls == NULL) {
        struct PostData *post_data = malloc(sizeof(struct PostData));
        post_data->data = NULL;
        post_data->size = 0;
        *con_cls = post_data;
        return MHD_YES;
    }

    // Si la taille des données téléchargées n'est pas nulle, ajouter les données au tampon de PostData
    if (*upload_data_size != 0) {
        struct PostData *post_data = *con_cls;
        post_data->data = realloc(post_data->data, post_data->size + *upload_data_size + 1);
        memcpy(post_data->data + post_data->size, upload_data, *upload_data_size);
        post_data->size += *upload_data_size;
        post_data->data[post_data->size] = '\0';
        *upload_data_size = 0;
        return MHD_YES;
    } else {
        // Si toutes les données ont été téléchargées, obtenir une réponse et l'envoyer au client
        struct PostData *post_data = *con_cls;
        const char *response = get_answer(post_data->data);
        int ret = send_response(connection, response);

        // Libérer la mémoire et effacer le pointeur de contexte
        free(post_data->data);
        free(post_data);
        *con_cls = NULL;

        return ret;
    }


}

int main() {
    setlocale(LC_ALL, "fr_FR.UTF-8");

    connect_to_database();
    struct MHD_Daemon *daemon;

    daemon = MHD_start_daemon(MHD_USE_INTERNAL_POLLING_THREAD, PORT, NULL, NULL,
                              &answer_to_connection, NULL, MHD_OPTION_END);
    if (NULL == daemon)
        return 1;
    printf(" Le bot est prêt à répondre à vos questions. Pour discuter, allez sur http://localhost:8080 ...");

    getchar();

    MHD_stop_daemon(daemon);

    disconnect_from_database();

    return 0;
}
