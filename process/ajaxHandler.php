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
        case "addTask":
            $folderId = $_POST['folder_id'];
            $task= $_POST['taskName'];
           if (!isset($folderId) || empty($folderId)){
               echo "فولدری را انتخاب کنید.";
               die();
           }  if (!isset($task) || strlen($task) <=3){
               echo "تعداد تسک بزرگتر از سه باشد.";
               die();
           }

        $folder = [];
        $folder['title'] = $task;
        $folder['user_id'] = GetCurrentUserId();
        $folder['folder_id'] = $folderId;
            echo addtask($folder);
        break;
    default:
        diePage("invalid action");
}