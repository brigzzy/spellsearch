<?php
require 'vendor/autoload.php';
use Elasticsearch\ClientBuilder;
$hosts = [
    'http://elasticsearch:9200',
    'http://elasticsearch2:9200'
];
$client = ClientBuilder::create()->setHosts($hosts)->build();

$params['index'] = 'pokemon';
$params['type'] = 'pokemon_trainer';
$params['body']['query']['match']['age'] = 15;

$result = $client->search($params);

var_export($result);

?>

