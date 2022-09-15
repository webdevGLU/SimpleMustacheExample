<?php
//use composer packages
require __DIR__ . '/vendor/autoload.php';

//load jsonData
$rawJSONData = file_get_contents('data.json');//https://annexbios.nickvz.nl/api/
$jsonData = json_decode($rawJSONData, true);

//instance mustache
$mustache = new Mustache_Engine(array('entity_flags' => ENT_QUOTES, 'loader' => new Mustache_Loader_FilesystemLoader(dirname(__FILE__) . '/templates')));
//load mustache template
$movieBlockTemplate = $mustache->loadTemplate('movieBlock');
$htmlTemplate = $mustache->loadTemplate('html');
?>

  <?php
  $htmlData["body"] = "";
  for ($i = 0; $i < count($jsonData["filmdata"]); $i++) {
    //render mustache template and insert data from jsonData
    $htmlData["body"] = $htmlData["body"].$movieBlockTemplate->render($jsonData["filmdata"][$i]);
  } 
  echo $htmlTemplate->render($htmlData);


  ?>
