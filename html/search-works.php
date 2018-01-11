<html>
<head>
</head>
</html>
<?php
require 'vendor/autoload.php';
session_start();
$client = Elasticsearch\ClientBuilder::create()->build();

$params = [
    'index' => '_all',
//    'type' => 'spells',
    'body' => [
        'query' => [
            'match' => [
                'name' => $_GET['search']
            ]
        ]
    ]
];

$response = $client->search($params);

echo $response['hits']['hits'][0]['_source']['fulltext'];

?>

<p><a href="/">Back to the search page</a>
