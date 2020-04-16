<?php
error_reporting(0);
header('Content-Type: application/json');
require __DIR__ . '/vendor/autoload.php';
use \Curl\Curl;
$curl = new Curl();
include "modules/moduleAPI.php";


$errorDetails = array(
    'curlStatus' => 0,
    'data' =>
    [
        'code' => '404',
        'message' => 'details error, not defined in request parameter.'
    ]
);

$errorNotFound = array(
    'curlStatus' => 0,
    'data' =>
    [
        'code' => '404',
        'message' => 'data not found.'
    ]
);

$input = $_GET['get'] or die (json_encode($errorDetails));

if($input == 'recovered'){
    $dataCurl = fetchDetail($curl, 'https://api.kawalcorona.com/recovered/');
    $dataFetch = $dataCurl[0];
    $data = $dataFetch->TotalRecovered;
    $arr = array(
        'curlStatus' => 1,
        'data' =>
        [
            'value' => $data,
            'time' => date('Y-m-d')
        ]
    );
    echo json_encode($arr);
} else if ($input == 'deaths') {
    $dataCurl = fetchDetail($curl, 'https://api.kawalcorona.com/meninggal/');
    $data = $dataCurl->value;
    $arr = array(
        'curlStatus' => 1,
        'data' =>
        [
            'value' => $data,
            'time' => date('Y-m-d')
        ]
    );
    echo json_encode($arr);
} else if ($input == 'positif'){
    $dataCurl = fetchDetail($curl, 'https://api.kawalcorona.com/positif/');
    $data = $dataCurl->value;
    $arr = array(
        'curlStatus' => 1,
        'data' =>
        [
            'value' => $data,
            'time' => date('Y-m-d')
        ]
    );
    echo json_encode($arr);
} else if ($input == 'all'){
    $dataCurl_positif = fetchDetail($curl, 'https://api.kawalcorona.com/positif/');
    $dataCurl_deaths = fetchDetail($curl, 'https://api.kawalcorona.com/meninggal/');
    $dataCurl_recovered = fetchDetail($curl, 'https://api.kawalcorona.com/recovered/');

    $dataFetch = $dataCurl_recovered[0];

    $data_recovered = number_format($dataFetch->TotalRecovered, 0, ".", ".");
    $data_deaths = number_format($dataCurl_deaths->value, 0, ".", ".");
    $data_positif = number_format($dataCurl_positif->value, 0, ".", ".");

    $dataCurl->value;
    $arr = array(
        'curlStatus' => 1,
        'data' =>
        [
            'positif' => $data_positif,
            'deaths' => $data_deaths,
            'recovered' => $data_recovered
        ]
    );
    echo json_encode($arr);
} else {
    header('Content-Type: application/json');
    echo json_encode($errorNotFound);
}