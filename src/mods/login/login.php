<?php
include("../../settings.php");
$email = mysql_real_escape_string($_POST['email']);
$pin = mysql_real_escape_string($_POST['pin']);
$sql = mysql_query("SELECT `id` FROM `members` WHERE `email` = '".$email."' AND `pin` = '".$pin."' LIMIT 1");
if(mysql_num_rows($sql))$myid = mysql_result($sql, 0);
if($myid){
	$_SESSION['myid'] = $myid;
	header("location: ../../perfil");
}else header("location: ../../login");
?>
