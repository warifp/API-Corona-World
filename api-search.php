<?php
error_reporting(0);
header('Content-Type: application/json');
require __DIR__ . '/vendor/autoload.php';
use \Curl\Curl;
$curl = new Curl();
include "modules/moduleAPI.php";

$errorCountry[]['error'] = array(
    'curlStatus' => 0,
    'code' => '404',
    'message' => 'country error, not defined in request parameter.'
);

$errorNotFound[]['error'] = array(
    'curlStatus' => 0,
    'code' => '404',
    'message' => 'data not found.'
);

$input = $_GET['country'] or die (json_encode($errorCountry));

$search = ucfirst($input);

$data = fetchKawalCoronaALL($curl);

for ($x = 0; $x < count($data); $x++) {
    $dataCorona = $data[$x]->attributes;
    if ($dataCorona->Country_Region == $search) {
        $arrayOutput = array(
            'curlStatus' => 1,
            'country' => $dataCorona->Country_Region,
            'confirmed' => $dataCorona->Confirmed,
            'deaths' => $dataCorona->Deaths,
            'recovered' => $dataCorona->Recovered,
            'active' => $dataCorona->Active,
            'coordinates' =>
            [
                'latitude' => $dataCorona->Lat,
                'longitude' => $dataCorona->Long_
            ],
            'fetch' => date("Y/m/d")
        );
        header('Content-Type: application/json');
        echo json_encode($arrayOutput);
        exit;
    }
}
echo json_encode($errorNotFound);