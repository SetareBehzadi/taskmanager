<?php
include "bootstrap/init.php";
if (isset($_GET['logout']) ){
   logout();
}

if(!isLoggedIn()){
    // redirect to aut form
    header("Location: " . site_url('auth.php'));
}
$user = getLoggInUser();
if (isset($_GET['delete_folder']) && is_numeric($_GET['delete_folder'])){
    deleteFolder($_GET['delete_folder']);
}
if (isset($_GET['delete_task']) && is_numeric($_GET['delete_task'])){
    deleteTask($_GET['delete_task']);
}

$folders = getFolders();
$tasks = getTasks();

include "tpl/tpl-index.php";
