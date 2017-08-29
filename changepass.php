<?php

require 'inc/config.php';
include('session.php');
$curp = $_POST['curp'];
$newp = $_POST['npass'];
$npassre = $_POST['npassre'];
if (empty($curp) && empty($newp) && empty($npassre)) {
    echo "Fill all the fields!";
} else {
    $checkcp = mysql_query("select password from users where password='$curp' AND username='admin'");
    $currentp = "";
    while ($row = mysql_fetch_array($checkcp)) {
        $currentp = $row[0];
    }    
    if ($currentp == $curp) {
            if ($newp == $npassre) {
                $cpass = mysql_query("update users set password='$newp' where password='$curp' AND username='admin'");
                if ($cpass == 1) {
                    echo "Password Changed!";
                } else {
                    echo "Error, Please try again!";
                }
            }else{
                echo "New Passwords didn't match!";
            }
        }else{
            echo "Current password did not match!";
        }
}
?>

