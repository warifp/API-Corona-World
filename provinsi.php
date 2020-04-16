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

$input = $_GET['lokasi'] or die (json_encode($errorCountry));

$search = ucwords($input);

$data = fetchDetail($curl, 'https://api.covid19bot.xyz/local');

for ($x = 0; $x < count($data->data->all); $x++) {
    $dataCorona = $data->data->all[$x];
    if (strpos($dataCorona->province, $search) !== false) {
        
        $positif = number_format($dataCorona->confirmed, 0, ".", ".");
        $sembuh = number_format($dataCorona->recovered, 0, ".", ".");
        $meninggal = number_format($dataCorona->deaths, 0, ".", ".");

        $arrayOutput = array(
            'curlStatus' => 1,
            'data' =>
            [
                'ranks' => $dataCorona->ranks,
                'provinsi' => $dataCorona->province,
                'positif' => $positif,
                'sembuh' => $sembuh,
                'meninggal' => $meninggal,
            ],
            'time' => date("Y/m/d")
        );
        
        echo json_encode($arrayOutput);
        exit;
    }
}
echo json_encode($errorNotFound);