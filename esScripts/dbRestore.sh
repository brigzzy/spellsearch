#!/bin/bash
wget -O spells.csv "https://docs.google.com/spreadsheets/d/1cuwb3QSvWDD7GG5McdvyyRBpqycYuKMRsXgyrvxvLFI/export?format=csv&id=1cuwb3QSvWDD7GG5McdvyyRBpqycYuKMRsXgyrvxvLFI&gid=1744959972"
echo "Sleeping for 60 seconds, waiting for ElasticSearch"
node import.js
#csv2es --delimiter , --index-name spells --doc-type spells --import-file spells.csv --delete-index
