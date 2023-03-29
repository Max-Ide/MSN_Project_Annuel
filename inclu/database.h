
int init_db() {
    sqlite3* db;
    char* error;

    int rc = sqlite3_open("db/bot.db", &db);

    if (rc) {
        fprintf(stderr, "Can't open database: %s\n", sqlite3_errmsg(db));
        sqlite3_close(db);
        return -1;
    }

    char* sql = "CREATE TABLE IF NOT EXISTS bot_responses (id INTEGER PRIMARY KEY AUTOINCREMENT, question TEXT, response TEXT);";

    rc = sqlite3_exec(db, sql, NULL, NULL, &error);

    if (rc != SQLITE_OK) {
        fprintf(stderr, "SQL error: %s\n", error);
        sqlite3_free(error);
        sqlite3_close(db);
        return -1;
    }

    sqlite3_close(db);

    return 0;
}
