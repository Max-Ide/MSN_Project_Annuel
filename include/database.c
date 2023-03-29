#include <stdio.h>
#include <sqlite3.h>
#include "database.h"

// Ouvre la base de données SQLite
int open_database(sqlite3 **db, const char *filename) {
    return sqlite3_open(filename, db);
}

// Ferme la base de données SQLite
int close_database(sqlite3 *db) {
    return sqlite3_close(db);
}

// Récupère la réponse pour une question donnée à partir de la base de données
int get_response_from_database(sqlite3 *db, const char *question_id, char *response) {
    char sql[512];
    sqlite3_stmt *stmt;
    int rc;

    sprintf(sql, "SELECT response FROM responses WHERE question_id = '%s'", question_id);

    rc = sqlite3_prepare_v2(db, sql, -1, &stmt, NULL);
    if (rc != SQLITE_OK) {
        fprintf(stderr, "Erreur lors de la préparation de la requête SQL : %s\n", sqlite3_errmsg(db));
        return 0;
    }

    rc = sqlite3_step(stmt);
    if (rc == SQLITE_ROW) {
        strcpy(response, sqlite3_column_text(stmt, 0));
        sqlite3_finalize(stmt);
        return 1;
    } else if (rc == SQLITE_DONE) {
        fprintf(stderr, "Aucune réponse trouvée pour la question %s\n", question_id);
        sqlite3_finalize(stmt);
        return 0;
    } else {
        fprintf(stderr, "Erreur lors de l'exécution de la requête SQL : %s\n", sqlite3_errmsg(db));
        sqlite3_finalize(stmt);
        return 0;
    }
}

// Insère une nouvelle réponse dans la base de données
int insert_response_into_database(sqlite3 *db, const char *question_id, const char *response) {
    char sql[512];
    sqlite3_stmt *stmt;
    int rc;

    sprintf(sql, "INSERT INTO responses (question_id, response) VALUES ('%s', '%s')", question_id, response);

    rc = sqlite3_prepare_v2(db, sql, -1, &stmt, NULL);
    if (rc != SQLITE_OK) {
        fprintf(stderr, "Erreur lors de la préparation de la requête SQL : %s\n", sqlite3_errmsg(db));
        return 0;
    }

    rc = sqlite3_step(stmt);
    if (rc != SQLITE_DONE) {
        fprintf(stderr, "Erreur lors de l'exécution de la requête SQL : %s\n", sqlite3_errmsg(db));
        sqlite3_finalize(stmt);
        return 0;
    }

    sqlite3_finalize(stmt);
    return 1;
}

