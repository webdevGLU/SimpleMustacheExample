<?php
require __DIR__ . '/vendor/autoload.php';
$rawJSONData = file_get_contents('https://annexbios.nickvz.nl/api/');
$jsonData = json_decode($rawJSONData, true);
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
  $template = '<div class="grid_item">
<img src="{{film_photo}}" width="100">
<h4>{{film_title}}</h4>
<ion-icon name="star"></ion-icon>
<ion-icon name="star"></ion-icon>
<ion-icon name="star"></ion-icon>
<ion-icon name="star-half"></ion-icon>
<ion-icon name="star-outline"></ion-icon><br>
<h5>Release {{film_releasedate}}</h5><br>
{{film_shortinfo}}
<br>
  <button>button</button>
</div>';

  for ($i = 0; $i < count($jsonData["filmdata"]); $i++) {
    //echo($jsonData["filmdata"][$i]["film_title"]);
    $m = new Mustache_Engine(array('entity_flags' => ENT_QUOTES));
    echo $m->render($template, $jsonData["filmdata"][$i]);
  }
  ?>
</body>
</html>