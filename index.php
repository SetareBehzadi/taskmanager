<?php
include "bootstrap/init.php";
use Hekmatinasser\Verta\Verta;
$v = Verta::now();
echo $v;
include "tpl/tpl-index.php";
