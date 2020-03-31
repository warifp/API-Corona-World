<?php
// error_reporting(0);
header('Content-Type: application/json');
require __DIR__ . '/vendor/autoload.php';
use \Curl\Curl;
$curl = new Curl();
include "modules/api.php";


$errorDetails[]['error'] = array(
    'curlStatus' => 0,
    'code' => '404',
    'message' => 'details error, not defined in request parameter.'
);

$errorNotFound[]['error'] = array(
    'curlStatus' => 0,
    'code' => '404',
    'message' => 'data not found.'
);

$input = $_GET['get'] or die (json_encode($errorDetails));

if($input == 'recovered'){
    $dataCurl = fetchDetail($curl, 'https://api.kawalcorona.com/recovered/');
    $dataFetch = $dataCurl[0];
    $data = $dataFetch->TotalRecovered;
    $arr[][$input] = array(
        'curlStatus' => 1,
        'value' => $data,
        'time' => date('Y-m-d')
    );
    echo json_encode($arr);
} else if ($input == 'deaths') {
    $dataCurl = fetchDetail($curl, 'https://api.kawalcorona.com/meninggal/');
    $data = $dataCurl->value;
    $arr[][$input] = array(
        'curlStatus' => 1,
        'value' => $data,
        'time' => date('Y-m-d')
    );
    echo json_encode($arr);
} else if ($input == 'positif'){
    $dataCurl = fetchDetail($curl, 'https://api.kawalcorona.com/positif/');
    $data = $dataCurl->value;
    $arr[][$input] = array(
        'curlStatus' => 1,
        'value' => $data,
        'time' => date('Y-m-d')
    );
    echo json_encode($arr);
} else if ($input == 'all'){
    $dataCurl_positif = fetchDetail($curl, 'https://api.kawalcorona.com/positif/');
    $dataCurl_deaths = fetchDetail($curl, 'https://api.kawalcorona.com/meninggal/');
    $dataCurl_recovered = fetchDetail($curl, 'https://api.kawalcorona.com/recovered/');

    $dataFetch = $dataCurl_recovered[0];
    $data_recovered = $dataFetch->TotalRecovered;

    $data_deaths = $dataCurl_deaths->value;

    $data_positif = $dataCurl_positif->value;

    $dataCurl->value;
    $arr['value'] = array(
        'curlStatus' => 1,
        'positif' => $data_positif,
        'deaths' => $data_deaths,
        'recovered' => $data_recovered
    );
    echo json_encode($arr);
} else {
    header('Content-Type: application/json');
    echo json_encode($errorNotFound);
}