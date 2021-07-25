<?php
function GetCurrentUserId(){
    if ($_SESSION['login']){
        $id = getLoggInUser()->id;
        return $id;
    }return false;
}

function isLoggedIn(){
    return isset($_SESSION['login'])?true:false;
}

function getLoggInUser(){
    return ($_SESSION['login'])?$_SESSION['login']:null;
}
function logout(){
    unset($_SESSION['login']);
}
function register($data){
        global $pdo;
        $password = password_hash($data['password'],PASSWORD_BCRYPT);
        $sql = "INSERT INTO users (name,email,password) VALUES (:name,:email,:password);";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':name'=>$data['name'],':email'=>$data['email'],':password'=>$password]);
        return $stmt->rowCount()?true:false;
}

function getUserByEmail($email){

    global $pdo;
    $sql = "SELECT * FROM users WHERE email = :email;";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':email'=>$email]);
    $records = $stmt->fetchAll(PDO::FETCH_OBJ);
  /*  dd($records[0]);*/
    return (isset($records[0]))?$records[0]:null;

}
function login($email,$password){
    $user = getUserByEmail($email);
   if (is_null($user)){
       return false;
   }
   if (password_verify($password,$user->password)){
       $_SESSION['login'] = $user;

       return true;
   }
    return false;
}