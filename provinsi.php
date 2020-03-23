<?php
error_reporting(0);
header('Content-Type: application/json');
require __DIR__ . '/vendor/autoload.php';
use \Curl\Curl;
$curl = new Curl();
include "modules/moduleAPI.php";

$errorCountry[]['error'] = array(
    'code' => '404',
    'message' => 'country error, not defined in request parameter.'
);

$errorNotFound[]['error'] = array(
    'code' => '404',
    'message' => 'data not found.'
);

$input = $_GET['lokasi'] or die (json_encode($errorCountry));

$search = ucwords($input);

$data = fetchDetail($curl, 'https://indonesia-covid-19.mathdro.id/api/provinsi');

for ($x = 0; $x < count($data->data); $x++) {
    $dataCorona = $data->data[$x];
    if (strpos($dataCorona->provinsi, $search) !== false) {
        $arrayOutput = array(
            'provinsi' => $dataCorona->provinsi,
            'positif' => $dataCorona->kasusPosi,
            'sembuh' => $dataCorona->kasusSemb,
            'meninggal' => $dataCorona->kasusMeni,
            'update' => $dataCorona->pembaruan,
            'time' => date("Y/m/d")
        );
        header('Content-Type: application/json');
        echo json_encode($arrayOutput);
        exit;
    }
}
echo json_encode($errorNotFound);