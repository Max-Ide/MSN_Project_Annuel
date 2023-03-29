#ifndef DATABASE_H
#define DATABASE_H

#include <sqlite3.h>

typedef struct {
    int id;
    char* question;
    char* response;
} BotResponse;

int init_db();

int insert_response(char* question, char* response);

char* get_response(char* question);

#endif
