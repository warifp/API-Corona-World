<?php
error_reporting(0);
require __DIR__ . '/vendor/autoload.php';
include "modules/moduleAPI.php";
header('Content-Type: application/json');

use \Curl\Curl;
$curl = new Curl();

$input = $_GET['country'] or die (json_encode($errorCountry));

$inputCountry = ucfirst($input);

$dataLMAO = fetchDataLMAO($curl, $inputCountry);
$dataKawalCorona = fetchKawalCorona($curl, $inputCountry);
dump($dataKawalCorona);

// validate country
$statusInput = $dataLMAO; // use function fetchDataLMAO()
// end validate country

if($statusInput == 'Country not found'){
    $arrayOutput = array(
        'errors' =>
        [
            'curlStatus' => 0,
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
    $latitude = $dataKawalCorona->Lat;
    $longitude = $dataKawalCorona->Long_;
    // End Data LMAO

    // Collect Data to Array
    $arrayOutput = array(
        'curlStatus' => 1,
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
        ],
        'timeFetch' => date("Y/m/d")
    );
    // End Collect Data to Array
    
    echo json_encode($arrayOutput);
}
