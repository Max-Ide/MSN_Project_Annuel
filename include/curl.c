#include <stdio.h>
#include <../inclu/curl.h>
#include "curl.h"

// Fonction de rappel pour CURL pour traiter la réponse HTTP
size_t handle_http_response(void *contents, size_t size, size_t nmemb, void *userp) {
    size_t realsize = size * nmemb;
    char *data = (char *) userp;

    memcpy(data, contents, realsize);
    data[realsize] = '\0';

    return realsize;
}

// Fonction pour envoyer une requête GET avec CURL
int send_get_request_with_curl(const char *url, char *response) {
    CURL *curl;
    CURLcode res;
    char error_buffer[CURL_ERROR_SIZE];

    curl_global_init(CURL_GLOBAL_DEFAULT);

    curl = curl_easy_init
//
// Created by Steph on 19/03/2023.
//

