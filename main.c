//
// Created by Steph on 23/03/2023.
//

#include <stdio.h>
#include "inclu/curl.h"
#include "inclu/database.h"


int main(void) {
    // Initialisez CURL et la base de données
    curl_init();
    database_init();

    // Posez une question à l'utilisateur et construisez l'URL
    char question[256];
    printf("Posez votre question : ");
    scanf("%s", question);
    char url[512];
    sprintf(url, "https://ipdetonserveur/tondossierApi/?question=%s", question);

    // Envoyez la requête CURL à l'API et récupérez la réponse JSON
    char* json_response = curl_get(url);

    // Convertissez la réponse JSON en structure de données C
    response_t response = json_to_struct(json_response);

    // Affichez la réponse de la base de données ou de l'API
    if (response.found) {
        printf("%s\n", response.answer);
    } else {
        printf("Désolé, je n'ai pas trouvé de réponse à votre question.\n");
    }

    // Libérez la mémoire utilisée par la réponse JSON et la structure de données C
    free(json_response);
    free_response(&response);

    // Fermez CURL et la base de données
    curl_cleanup();
    database_cleanup();

    return 0;
}
