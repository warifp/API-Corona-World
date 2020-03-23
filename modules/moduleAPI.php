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
    $curl->get('http://localhost/api-corona/corona/api-search.php?country=' . $country);
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

$errorCountry[]['error'] = array(
    'code' => '404',
    'message' => 'country error, not defined in request parameter.'
);