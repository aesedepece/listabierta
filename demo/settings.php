<?php
if ( eregi("MSIE", getenv( "HTTP_USER_AGENT" ) ) || eregi("Internet Explorer", getenv("HTTP_USER_AGENT" ) ) ) {
	header("location: fallback.htm");
}
session_start();
$db = mysql_connect("localhost","la-demo","demo");
mysql_select_db("la-demo", $db);

$myid = $_SESSION['myid'];
if($myid)$mydata = mysql_fetch_assoc(mysql_query("SELECT * FROM `members` WHERE `id` = '".$myid."' LIMIT 1", $db));

$sitename = "listabierta-demo";
$domain = "localhost";
$r = "/la-demo/";

$description = "Descripción";
$keywords = "listabierta, demo, software, listas abiertas, elecciones primarias, democracia";

$titles = array(
		"main" => "Software para elecciones primarias abiertas",
		"signup" => "Unirse",
		"login" => "Iniciar sesión",
		"perfil" => "Perfil del usuario",
		"candidatos" => "Candidatos"
	);
	
$a = $_GET['a'];
$b = $_GET['b'];
$c = $_GET['c'];

switch($a){
	case "signup":
		$mod = "signup";
		break;
	case "login":
		$mod = "login";
		break;
	case "perfil":
		$mod = "perfil";
		break;
	case "candidatos":
		$mod = "candidatos";
		break;
	default:
		$mod = "main";
		break;
}

?>
