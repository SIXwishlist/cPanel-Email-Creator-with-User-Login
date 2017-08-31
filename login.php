<?php

require_once 'inc/config.php';
session_start();
$uname = $_POST['username'];
$pass = $_POST['password'];

$stmt = $conn->prepare("select username,password from users where username='$uname' and password='$pass'");

$stmt->execute();

$nfrows = $stmt->rowCount();
echo $nfrows;



if ($nfrows==1) {
    echo "working";
    $_SESSION['login_user']=$uname;
    header("Location: cemail.php");
}
else {
   header("location: index.php");
}

$conn = null;
?>