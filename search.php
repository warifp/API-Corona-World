<?php
error_reporting(0);
require __DIR__ . '/vendor/autoload.php';
include "modules/moduleAPI.php";
header('Content-Type: application/json');

use \Curl\Curl;
$curl = new Curl();

$errorCountry[] = array(
    'curlStatus' => 0,
    'data' =>
    [
        'code' => '404',
        'message' => 'country error, not defined in request parameter.'
    ]
);

$input = $_GET['country'] or die (json_encode($errorCountry));

$inputCountry = ucfirst($input);

$dataLMAO = fetchDataLMAO($curl, $inputCountry);
$dataKawalCorona = fetchKawalCorona($curl, $inputCountry);

// validate country
$statusInput = $dataLMAO; // use function fetchDataLMAO()
// end validate country

if($statusInput == 'Country not found'){
    $arrayOutput = array(
        'curlStatus' => 1,
        'data' =>
        [
            'code' => '404',
            'message' => 'country not found'
        ],
        'timeFetch' => date("Y/m/d")
    );
    echo json_encode($arrayOutput);
} else {
    
    // Data LMAO
    $country = $dataLMAO->country;
    $cases = $dataLMAO->cases;
    $todayCases = $dataLMAO->todayCases;
    $deaths = $dataLMAO->deaths;
    $todayDeaths = $dataLMAO->todayDeaths;
    $recovered = $dataLMAO->recovered;
    $active = $dataLMAO->active;
    $casesPerOneMillion = $dataLMAO->casesPerOneMillion;
    $latitude = $dataKawalCorona->data->coordinates->latitude;
    $longitude = $dataKawalCorona->data->coordinates->longitude;
    // End Data LMAO

    // Collect Data to Array
    $arrayOutput = array(
        'curlStatus' => 1,
        [
            'country' => $country,
            'cases' => $cases,
            'todayCases' => $todayCases,
            'deaths' => $deaths,
            'todayDeaths' => $todayDeaths,
            'recovered' => $recovered,
            'active' => $active,
            'casesPerOneMillion' => $casesPerOneMillion,
            'coordinates' =>
            [
                'latitude' => $latitude,
                'longitude' => $longitude
            ]
        ],
        'time' => date("Y/m/d")
    );
    // End Collect Data to Array
    
    echo json_encode($arrayOutput);
}
