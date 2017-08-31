<?php

require_once 'inc/config.php';

session_start();
$user_check = $_SESSION['login_user'];
echo $user_check;

$stmt=$conn->prepare("select username from users where username='$user_check'");
$stmt->execute();
$result=$stmt->fetchColumn();


$login_session=$result;



if(!isset($login_session)){
    $conn = null;
    header('location: index.php');
}
?>