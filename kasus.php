<?php
error_reporting(0);
header('Content-Type: application/json');
require __DIR__ . '/vendor/autoload.php';
include "modules/moduleAPI.php";

use \Curl\Curl;
$curl = new Curl();

$errorProvinsi = array(
    'curlStatus' => 0,
    'data' =>
    [
        'code' => '404',
        'message' => 'provinsi error, not defined in request parameter.'
    ]  
);

$maintenance = array(
    'curlStatus' => 1,
    'data' =>
    [
        'code' => '503',
        'message' => 'api maintenance.'
    ]  
);

$input = $_GET['lokasi'] or die (json_encode($errorProvinsi));
$search = strtoupper($input);

// Maintenance
echo json_encode($maintenance);
exit;
// End Maintenance

$data = fetchDetail($curl, 'https://indonesia-covid-19.mathdro.id/api/kasus/old');

for ($x = 0; $x < count($data->data->nodes); $x++) {
    $dataCorona = $data->data->nodes[$x];
    if (strpos($dataCorona->klaster, $search) !== false) {
        $arrayOutput = array(
            'curlStatus' => 1,
            'data' =>
            [
                'klaster' => $dataCorona->klaster,
                'jenisKelamin' => $dataCorona->gender,
                'umur' => $dataCorona->umur,
                'keterangan' => $dataCorona->status,
                'wargaNegara' => $dataCorona->wn,
                'time' => date("Y/m/d"),
            ]
        );
    } 
}
echo json_encode($arrayOutput);