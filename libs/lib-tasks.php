<?php

function getTasks(){
    global $pdo;
    $folder = isset($_GET['folder_id']) ? $_GET['folder_id'] : null;
    $folderCondition = '';
    if($folder){
        $folderCondition = " and folder_id = $folder";
    }

    //in lib-auth
    $currentUser = GetCurrentUserId();
    $sql = "select * from tasks where user_id=$currentUser".$folderCondition;
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $records = $stmt->fetchAll(PDO::FETCH_OBJ);
    return $records;
}
function deleteTask($taskId){
    global $pdo;
    $sql = "delete from tasks where id=$taskId";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    return $stmt->rowCount();
}
function addTask($data){
    global $pdo;
    $sql = "INSERT INTO tasks (title,user_id,folder_id) VALUES (:title,:user_id,:folder_id);";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':title'=>$data['title'],':user_id'=>$data['user_id'],':folder_id'=>$data['folder_id']]);
    return $stmt->rowCount();
}
