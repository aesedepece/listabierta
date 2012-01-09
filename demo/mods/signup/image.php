<?php
$code = $_GET['code'];
$domain = $_GET['domain'];
$r = $_GET['r'];
$phpdir = "../../aux/img/sec/".$code.".jpg";
$dir = "https://".$domain.$r."aux/img/sec/".$code.".jpg";
if(!file_exists($dir)){
	$string = file_get_contents("https://ajax.googleapis.com/ajax/services/search/images?v=1.0&q=".$code);
	$match = explode("\"", $string);
	$filename = $match[19];
	$url = "http://t0.gstatic.com/images?q=tbn:".$filename;
	file_put_contents($phpdir, file_get_contents($url));
}
echo "<img src=\"".$dir."\" alt=\"Imagen de seguridad\" />";
?>
<figcaption>Esta es tu imagen de seguridad, nunca inicies sesión si no ves esta imagen.</figcaption>

