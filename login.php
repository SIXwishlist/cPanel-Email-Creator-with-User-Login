<?php

require_once 'inc/config.php';
session_start();
$uname = $_POST['username'];
$pass = $_POST['password'];

$stmt = $conn->prepare("select username,password from users where username='$uname' and password='$pass'");

$stmt->execute();

$nfrows = $stmt->rowCount();




if ($nfrows==1) {
   
    $_SESSION['login_user']=$uname;
    header("location: cemail.php");
}
else {
   header("location: index.php");
}

$conn = null;
?>