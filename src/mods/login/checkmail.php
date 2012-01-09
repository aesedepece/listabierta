<?php
$r = $_GET['r']."settings.php";
include("../../settings.php");
$email = $_GET['email'];
$res = mysql_result(mysql_query("SELECT `secret` FROM `members` WHERE `email` = '".$email."' AND `pin` IS NOT NULL", $db), 0);
if(!$res)$res = rand(0, 99999);
echo $res;
?>
