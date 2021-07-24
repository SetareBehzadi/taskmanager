<?php
function diePage($msg){
    echo "<div style='border-radius:5px; width: 80%;margin: 50px auto;background: crimson'>$msg</div>";
    die();
}

function isAjaxRequest(){
    if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' ) {
        return true;
    }
    return false;
}

function dd($variable){
    echo "<pre style='color: chocolate'>";
    var_dump($variable);
    echo "</pre>";
}