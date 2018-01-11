var ElasticsearchCSV = require('elasticsearch-csv');
 
// create an instance of the importer with options 
var esCSV = new ElasticsearchCSV({
    es: { index: 'spells', type: 'spell', host: 'elasticsearch' },
    csv: { filePath: './spells.csv', headers: true }
});
 
esCSV.import()
    .then(function (response) {
        // Elasticsearch response for the bulk insert 
        console.log(response);
    }, function (err) {
        // throw error 
        throw err;
    });
