<?php
error_reporting(0);
require __DIR__ . '/vendor/autoload.php';
include "modules/moduleAPI.php";
header('Content-Type: application/json');

use \Curl\Curl;
$curl = new Curl();

$errorCountry = array(
    'curlStatus' => 0,
    'data' =>
    [
        'code' => '404',
        'message' => 'country error, not defined in request parameter.'
    ]
);

$input = $_GET['country'] or die (json_encode($errorCountry));

$inputCountry = strtolower($input);

if($inputCountry == 'korea'){
    $inputCountry = 'kr';
}

$dataLMAO = fetchDataLMAO($curl, $inputCountry);
$dataKawalCorona = fetchKawalCorona($curl, $inputCountry, $baseURL);

// validate country
$statusInput = $dataLMAO; // use function fetchDataLMAO()
// end validate country

if($statusInput == NULL){
    $arrayOutput = array(
        'curlStatus' => 0,
        'data' =>
        [
            'code' => '404',
            'message' => 'country not found'
        ],
        'time' => date("Y/m/d")
    );
    echo json_encode($arrayOutput);
} else {
    
    // Data LMAO
    $country = $dataLMAO->country;
    $cases = number_format($dataLMAO->cases, 0, ".", ".");
    $todayCases = number_format($dataLMAO->todayCases, 0, ".", ".");
    $deaths = number_format($dataLMAO->deaths, 0, ".", ".");
    $todayDeaths = number_format($dataLMAO->todayDeaths, 0, ".", ".");
    $recovered = number_format($dataLMAO->recovered, 0, ".", ".");
    $active = number_format($dataLMAO->active, 0, ".", ".");
    $latitude = $dataKawalCorona->data->coordinates->latitude;
    $longitude = $dataKawalCorona->data->coordinates->longitude;
    // End Data LMAO

    // Collect Data to Array
    $arrayOutput = array(
        'curlStatus' => 1,
        'data'=>
        [
            'country' => $country,
            'cases' => $cases,
            'todayCases' => $todayCases,
            'deaths' => $deaths,
            'todayDeaths' => $todayDeaths,
            'recovered' => $recovered,
            'active' => $active,
            'coordinates' =>
            [
                'latitude' => $latitude,
                'longitude' => $longitude
            ],
        ],
        'time' => date("Y/m/d")
    );
    // End Collect Data to Array
    
    echo json_encode($arrayOutput);
}
