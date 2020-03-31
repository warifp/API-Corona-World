<?php

function fetchDataLMAO($curl, $country)
{
    $curl->get('https://corona.lmao.ninja/countries/' . $country);
    if ($curl->error) {
        echo 'Error: ' . $curl->errorCode . ': ' . $curl->errorMessage . "\n";
    } else {
        return $curl->response;
    }
}

function fetchKawalCorona($curl, $country)
{
    $curl->get('http://localhost/api-corona/v2/api-search.php?country=' . $country);
    if ($curl->error) {
        echo 'Error: ' . $curl->errorCode . ': ' . $curl->errorMessage . "\n";
    } else {
        return $curl->response;
    }
}

function fetchDetail($curl, $url)
{
    $curl->get($url);

    if ($curl->error) {
        echo 'Error: ' . $curl->errorCode . ': ' . $curl->errorMessage . "\n";
    } else {
        return $curl->response;
    }
}

function fetchKawalCoronaALL($curl)
{
    $curl->get('https://api.kawalcorona.com/');

    if ($curl->error) {
        echo 'Error: ' . $curl->errorCode . ': ' . $curl->errorMessage . "\n";
    } else {
        return $curl->response;
    }
}
