<?php
//use composer packages
require __DIR__ . '/vendor/autoload.php';
//load jsonData
$rawJSONData = file_get_contents('data.json'); //data.json from https://annexbios.nickvz.nl/api/
$jsonData = json_decode($rawJSONData, true);
//instance mustache
$mustache = new Mustache_Engine(array('entity_flags' => ENT_QUOTES, 'loader' => new Mustache_Loader_FilesystemLoader(dirname(__FILE__) . '/templates')));
//load mustache templates
$movieBlockTemplate = $mustache->loadTemplate('movieBlock');
$htmlTemplate = $mustache->loadTemplate('html');
//create $htmlData
$htmlData["body"] = "";
//loop $jsonData["filmdata"] to get all movies
for ($i = 0; $i < count($jsonData["filmdata"]); $i++) {
  //add render data to $htmlData using $movieBlockTemplate and $jsonData["filmdata"]
  $htmlData["body"] = $htmlData["body"] . $movieBlockTemplate->render($jsonData["filmdata"][$i]);
}
//render $htmlData in $htmlTemplate
echo $htmlTemplate->render($htmlData);