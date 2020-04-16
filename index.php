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
        'version' => '3.2',
        'lastUpdate' => '17 April 2020',
    ],
    'resource' =>
    [
        '1' => 'Kawal Corona',
        '2' => 'LMAO',
        '3' => 'MathDroid', 
        '4' => 'Salma Yarista',
        '5' => 'Johns Hopkins University',
        '6' => 'https://docs.google.com/spreadsheets/d/1ma1T9hWbec1pXlwZ89WakRk-OfVUQZsOCFl4FwZxzVw/',
        '7' => 'https://www.covid19.go.id/',
    ],
    'time' => date('d-m-Y H:i:s')
);
echo json_encode($arr);