<?php

require __DIR__ . '/vendor/autoload.php';

use KVSDK\KVClient;
use KVSDK\Config;
use GuzzleHttp\Client;

if (file_exists('example_private.php')) {
    include 'example_private.php';

} else {
    define('ID', '');
    define('SECRET', '');
    define('RETAILER', '');
    
}

$config =  new Config(ID,SECRET,RETAILER,'https://id.kiotviet.vn','/connect/token');
$client = new KVClient($config);
$token =  $client->getAccessToken();
echo $token;
