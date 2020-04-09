<?php
include "bootstrap/init.php";
// use Hekmatinasser\Verta\Verta;
// var_dump(Verta::now());

# connect to db and get tasks
$tasks = getTasks();
 
include "tpl/tpl-index.php";