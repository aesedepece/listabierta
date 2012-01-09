<?php
if($myid){
	echo"<a href=\"https://".$domain.$r."perfil\">¡Hola ".utf8_encode($mydata['name'])."!</a>";
	echo"<a href=\"https://".$domain.$r."mods/login/logout.php\" id=\"logout\">salir</a>";
}else echo"<a href=\"https://".$domain.$r."login\">Inicia sesión</a>";
?>
