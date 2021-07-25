<?php
include "bootstrap/init.php";
$result = null;
if ($_SERVER['REQUEST_METHOD'] == "POST"){
    $action = $_GET['action'];
    $params = $_POST;

    if ($action == "register"){
        $result = register($params);
        if (!$result){
            message('error to register');
        }else{
            message('registration is successful');
        }
    }elseif ($action == "login"){
        $result = login($params['email'],$params['password']);
        if (!$result){
            message('email or password is incorrect!');
        }else{
            redirect(site_url());
        }
    }

}


include "tpl/tpl-auth.php";