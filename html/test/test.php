<?php

require 'vendor/autoload.php';
$client = Elasticsearch\ClientBuilder::create()->build();

$params = [
    'index' => 'spells',
    'type' => 'spells',
    'body' => [
        'query' => [
            'match' => [
                'wiz' => '9'
            ]
        ]
    ]
];

$response = $client->search($params);

echo $response['hits']['hits'][0]['_source']['full_text'];

?>
