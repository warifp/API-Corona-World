<?php
error_reporting(0);
header('Content-Type: application/json');
require __DIR__ . '/vendor/autoload.php';
include "modules/moduleAPI.php";

use \Curl\Curl;
$curl = new Curl();

$errorProvinsi[]['error'] = array(
    'curlStatus' => 0,
    'code' => '404',
    'message' => 'provinsi error, not defined in request parameter.'
);

$input = $_GET['lokasi'] or die (json_encode($errorProvinsi));
$search = strtoupper($input);

$data = fetchDetail($curl, 'https://indonesia-covid-19.mathdro.id/api/kasus');

for ($x = 0; $x < count($data->data->nodes); $x++) {
    $dataCorona = $data->data->nodes[$x];
    if (strpos($dataCorona->klaster, $search) !== false) {
        $arrayOutput[]['attributes'] = array(
            'curlStatus' => 1,
            'klaster' => $dataCorona->klaster,
            'jenisKelamin' => $dataCorona->gender,
            'umur' => $dataCorona->umur,
            'keterangan' => $dataCorona->status,
            'wargaNegara' => $dataCorona->wn,
            'time' => date("Y/m/d"),
        );
    } 
}
echo json_encode($arrayOutput);