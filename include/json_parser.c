#include "../inclu/json_parser.h"

char* parse_response(char* json) {
    cJSON* root = cJSON_Parse(json);
    char* response = NULL;

    if (root) {
        cJSON* text = cJSON_GetObjectItemCaseSensitive(root, "text");

        if (cJSON_IsString(text) && (text->valuestring != NULL)) {
            response = cJSON_Print(text);
        }

        cJSON_Delete(root);
    }

    return response;
}
//
// Created by Steph on 19/03/2023.
//

