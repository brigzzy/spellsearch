<?php
require 'vendor/autoload.php';
use Elasticsearch\ClientBuilder;
$hosts = [
    'http://elasticsearch:9200',
    'http://elasticsearch2:9200'
];
$client = ClientBuilder::create()->setHosts($hosts)->build();

$params = array();
$params['body']  = array(
  'name' => 'Ash Ketchum',
  'age' => 10,
  'badges' => 8
);

$params['index'] = 'pokemon';
$params['type']  = 'pokemon_trainer';

$result = $client->index($params);

$params = array();
$params['body']  = array(
  'name' => 'Brock',
  'age' => 15,
  'badges' => 0
);

$params['index'] = 'pokemon';
$params['type']  = 'pokemon_trainer';
$params['id'] = '1A-000';

$result = $client->index($params);

echo "Hello World!";
var_export($result);
?>

