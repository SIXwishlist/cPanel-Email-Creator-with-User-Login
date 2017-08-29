<?php
require_once 'inc/config.php';
session_start();
$uname = $_POST['username'];
$pass = $_POST['password'];

$sql = "select username,password from users where username='$uname' and password='$pass'";
$result = mysql_query($sql) or die("Query Failed");

$nfrows = mysql_num_rows($result);

if ($nfrows == 1) {
   $_SESSION['login_user']=$uname;
   header("location: cemail.php");
   
} else {
    header("location: index.php");
}
mysql_close($con);
?>