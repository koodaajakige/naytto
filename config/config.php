<?php

/* Tämä esittelee $config-nimisen taulukon ja antaa arvoksi projektissa
 käytettävät arvot. Todellisuudessa se on moniulotteinen taulukko,
 mutta riittää tietää, että sen arvoja kutsutaan alkion nimillä, kuten esimerkiksi:
$config['urls']['baseUrl']  */

 /* $config = array(
    "urls" => array(
      "baseUrl" => "/~jniemine/naytto"
    )
  );
  */

$config = array(
    "db" => array(
        "dbname" => $_SERVER["DB_DATABASE"],
        "username" => $_SERVER["DB_USERNAME"],
        "password" => $_SERVER["DB_PASSWORD"],
        "host" => "localhost"
    ),
    "urls" => array(
        "baseUrl" => "/~jniemine/naytto"
    )
);

define("PROJECT_ROOT", dirname(__DIR__) . "/");
define("HELPERS_DIR", PROJECT_ROOT . "src/helpers/");
define("TEMPLATE_DIR", PROJECT_ROOT . "src/view/");
define("MODEL_DIR", PROJECT_ROOT . "src/model/");
define("CONTROLLER_DIR", PROJECT_ROOT . "src/controller/");
define("BASEURL", $config['urls']['baseUrl']);

#Tämä koodi määrittelee joukon vakioita, joissa määritellään hakemistopolut sovelluksen eri palikoille.
?>