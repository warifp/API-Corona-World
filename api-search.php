<?php
error_reporting(0);
header('Content-Type: application/json');
require __DIR__ . '/vendor/autoload.php';
use \Curl\Curl;
$curl = new Curl();
include "modules/moduleAPI.php";

$errorCountry = array(
    'curlStatus' => 0,
    'data' =>
    [
    'code' => '404',
    'message' => 'country error, not defined in request parameter.'
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

$input = $_GET['country'] or die (json_encode($errorCountry));

$search = ucfirst($input);

$data = fetchKawalCoronaALL($curl);

for ($x = 0; $x < count($data); $x++) {
    $dataCorona = $data[$x]->attributes;
    if ($dataCorona->Country_Region == $search) {

        $active = number_format($dataCorona->Active, 0, ".", ".");
        $deaths = number_format($dataCorona->Deaths, 0, ".", ".");
        $recovered = number_format($dataCorona->Recovered, 0, ".", ".");
        $confirmed = number_format($dataCorona->Confirmed, 0, ".", ".");

        $arrayOutput = array(
            'curlStatus' => 1,
            'data' =>
            [
                'country' => $dataCorona->Country_Region,
                'confirmed' => $confirmed,
                'deaths' => $deaths,
                'recovered' => $recovered,
                'active' => $active,
                'coordinates' =>
                [
                    'latitude' => $dataCorona->Lat,
                    'longitude' => $dataCorona->Long_
                ],
            ],
            'time' => date("Y/m/d")
        );
        header('Content-Type: application/json');
        echo json_encode($arrayOutput);
        exit;
    }
}
echo json_encode($errorNotFound);