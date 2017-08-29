<?php
define("DB_USER", "u9797763_root");
define("DB_HOST","localhost");
define("DB_PASS", "R#SVGn90EXBq");
define("DB_NAME", "u9797763_u0785463_u5545333_email");

$connection=  mysql_connect(DB_HOST,DB_USER,DB_PASS);
if(!$connection){
    die("Error Connection to the database host" . mysql_error());
}
$db_select=  mysql_select_db(DB_NAME, $connection );
if(!$db_select){
   die("No Database found " . mysql_error());
}?>
