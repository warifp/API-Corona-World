<?php
include 'config/config.php';
function fetchDataLMAO($curl, $country)
{
    $curl->get('https://corona.lmao.ninja/countries/' . $country);
    if ($curl->error) {
        // error response
    } else {
        return $curl->response;
    }
}

function fetchKawalCorona($curl, $country, $baseURL)
{
    $curl->get($baseURL .'/api-search.php?country=' . $country);
    if ($curl->error) {
        // error response
    } else {
        return $curl->response;
    }
}

function fetchDetail($curl, $url)
{
    $curl->get($url);

    if ($curl->error) {
        // error response
    } else {
        return $curl->response;
    }
}

function fetchKawalCoronaALL($curl)
{
    $curl->get('https://api.kawalcorona.com/');

    if ($curl->error) {
        // error response
    } else {
        return $curl->response;
    }
}
