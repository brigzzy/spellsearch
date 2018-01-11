<?php
session_start();
?>

<html>
<head>
	<link rel="icon" type="image/x-icon" href="/Icon.ico" />
	<link rel="stylesheet" href="PF.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-81858197-1', 'auto');
  ga('send', 'pageview');

</script>


<div id="page-wrapper">
	<label for="ajax">Type in a Spell, Feat, Magic Item, or Monster</label>
<form method="get" action="search.php">
	<input type="text" id="ajax" name="search" list="json-datalist" >
	<datalist id="json-datalist" />
</form>
</div>

<script type="text/javascript">

(function(){
// Get the <datalist> and <input> elements.
var dataList = document.getElementById('json-datalist');
var input = document.getElementById('ajax');

// Create a new XMLHttpRequest.
var request = new XMLHttpRequest();

// Handle state changes for the request.
request.onreadystatechange = function(response) {
  if (request.readyState === 4) {
    if (request.status === 200) {
      // Parse the JSON
      var jsonOptions = JSON.parse(request.responseText);

      // Loop over the JSON array.
      jsonOptions.forEach(function(item) {
        // Create a new <option> element.
        var option = document.createElement('option');
        // Set the value using the item in the JSON array.
        option.value = item;
        // Add the <option> element to the <datalist>.
        dataList.appendChild(option);
      });

      // Update the placeholder text.
      input.placeholder = "e.g. Fireball, Message, etc.";
    } else {
      // An error occured :(
      input.placeholder = "Couldn't load datalist options :(";
    }
  }
};

// Update the placeholder text.
input.placeholder = "Loading options...";

// Set up and make the request.
request.open('GET', 'test.json', true);
request.send();

})();

</script>

	</br>
	</br>

<?php
// If the search variable is undefined (IE when you load the site for the first time
// Then don't search.
if (isset($_GET['search'])) {
require 'vendor/autoload.php';
$hosts = [
    'http://elasticsearch:9200',
    'http://elasticsearch2:9200'
];
$client = ClientBuilder::create()->setHosts($hosts)->build();

# $client = Elasticsearch\ClientBuilder::create()->build();

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
}

?>
</body>
<footer>
	<b>-------------------</b>
	<font size="1">
		<p>Site created by Danny Briggs</p>
		<p>Data courtesy of <a href="http://www.d20pfsrd.com/">http://www.d20pfsrd.com</a>.</p>
		<p>Please send any bugs to: <a href="mailto:helpdesk@brigzzy.net">helpdesk@brigzzy.net</a>.</p>
	</font>
</footer>
</html>


