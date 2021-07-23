<?php
defined('BASE_PATH') or die("Permission Denied!");

function getFolders(){
    global $pdo;
    //in lib-auth
    $currentUser = GetCurrentUserId();
    $sql = "select * from folders where user_id=$currentUser";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $records = $stmt->fetchAll(PDO::FETCH_OBJ);
    return $records;
}
function addFolder($data){
    global $pdo;
    $sql = "INSERT INTO folders (name,user_id) VALUES (:folder_name,:user_id);";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':folder_name'=>$data['name'],':user_id'=>$data['user_id']]);
    return $stmt->rowCount();
}
function deleteFolder($folderId){
    global $pdo;
    $sql = "delete from folders where id=$folderId";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    return $stmt->rowCount();
}