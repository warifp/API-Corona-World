<?php
include 'config/config.php';
header('Content-Type: application/json');
$arr = array(
    'search' =>
    [
        'pattern' => $baseURL . '/corona/search.php?country={country}',
        'example' => $baseURL . '/search.php?country=indonesia'
    ],
    'daily' =>
    [
        'pattern' => 'https://api.coronaworld.asia/corona/api-daily.php?date={date}',
        'example' => 'https://api.coronaworld.asia/corona/api-daily.php?date=3-17-2020'
    ],
    'area' =>
    [
        'diy' => 
        [
            'all' => 
            [
                'pattern' => 'https://api.coronaworld.asia/corona/api-diy.php'
            ],
            'search' => 
            [
                'pattern' => 'https://api.coronaworld.asia/corona/api-diy-search.php?status={status}',
                'example pdp' => 'https://api.coronaworld.asia/corona/api-diy-search.php?status=pdp',
                'example odp' => 'https://api.coronaworld.asia/corona/api-diy-search.php?status=odp',
                'example positif' => 'https://api.coronaworld.asia/corona/api-diy-search.php?status=positif'
            ]
        ]

    ],
    'details' =>
    [
        'positif' => 'https://api.coronaworld.asia/corona/api-details.php?get=positif',
        'recovered' => 'https://api.coronaworld.asia/corona/api-details.php?get=recovered',
        'deaths' => 'https://api.coronaworld.asia/corona/api-details.php?get=deaths',
        'all' => 'https://api.coronaworld.asia/corona/api-details.php?get=all'
    ],
    'me' =>
    [
        'author' => 'Wahyu Arif Purnomo',
        'name' => 'Corona World API',
        'version' => '1.2',
        'lastUpdate' => '20 March 2020',
    ],
    'time' => date('d-m-Y H:i:s')
);
echo json_encode($arr);