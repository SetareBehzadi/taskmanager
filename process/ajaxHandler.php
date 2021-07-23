<?php
include_once "../bootstrap/init.php";

if (!isAjaxRequest()){
    diePage("it is not ajax request");
}

if (!isset($_POST['action']) || empty($_POST['action'])){
    diePage("invalid action");
}

switch ($_POST['action']){
    case "addFolder":
        $folder = [];
        $folder['name'] = $_POST['folderName'];
        $folder['user_id'] = GetCurrentUserId();
        echo addFolder($folder);
        break;
    default:
        diePage("invalid action");
}