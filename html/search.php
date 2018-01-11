<?php
require 'vendor/autoload.php';
use Elasticsearch\ClientBuilder;
$client = ClientBuilder::create()->build();

$params['index'] = 'pokemon';
$params['type'] = 'pokemon_trainer';
$params['body']['query']['match']['age'] = 15;

$result = $client->search($params);

echo $result;

?>
