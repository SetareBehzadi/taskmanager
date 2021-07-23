<?php

function getTasks(){
    global $pdo;
    //in lib-auth
    $currentUser = GetCurrentUserId();
    $sql = "select * from tasks where user_id=$currentUser";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $records = $stmt->fetchAll(PDO::FETCH_OBJ);
    return $records;
}

