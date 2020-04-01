<?php
include 'config/config.php';
header('Content-Type: application/json');
$arr = array(
    'country' =>
    [
        'pattern' => $baseURL . '/search.php?country={country}',
        'example' => $baseURL . '/search.php?country=indonesia'
    ],
    'provinsi' =>
    [
        
        'pattern' => $baseURL . '/provinsi.php?lokasi={provinsi}',
        'example' => $baseURL . '/provinsi.php?lokasi=yogyakarta'

    ],
    'details' =>
    [
        'positif' => $baseURL . '/details.php?get=positif',
        'recovered' => $baseURL . '/details.php?get=recovered',
        'deaths' => $baseURL . '/details.php?get=deaths',
        'all' => $baseURL . '/details.php?get=all'
    ],
    'kasus' =>
    [
        'status' => 'maintenance',
    ],
    'me' =>
    [
        'author' => 'Wahyu Arif Purnomo',
        'name' => 'Corona World API',
        'version' => '2.3',
        'lastUpdate' => '01 April 2020',
    ],
    'time' => date('d-m-Y H:i:s')
);
echo json_encode($arr);