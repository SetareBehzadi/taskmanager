<?php
include "constants.php";
include BASE_PATH."bootstrap/config.php";


include BASE_PATH."vendor/autoload.php";
include BASE_PATH."libs/helpers.php";

/*$dsn = "mysql:dbname=$database_config->db;host=$database_config->host"; */
//$pdo = new PDO("mysql:dbname=$database_config->db;host={$database_config->host}",$database_config->user,$database_config->pass);
/*die(new PDO("127.0.0.1:8080"));*/
$dsn = "mysql:host=$database_config->host;dbname=$database_config->db;charset=UTF8";
try {
  $pdo = new PDO($dsn,$database_config->user,$database_config->pass);
}catch (PDOException $e){
    diePage($e->getMessage());
}


include BASE_PATH."libs/lib-auth.php";
include BASE_PATH."libs/lib-tasks.php";
include BASE_PATH."libs/lib-folders.php";
