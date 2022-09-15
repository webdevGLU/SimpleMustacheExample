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
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <?php
  for ($i = 0; $i < count($jsonData["filmdata"]); $i++) {
    //render mustache template and insert data from jsonData
    echo $movieBlockTemplate->render($jsonData["filmdata"][$i]);
  }
  ?>
</body>

</html>