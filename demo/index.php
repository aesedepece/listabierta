<?php
require_once("settings.php");
?>
<!DOCTYPE HTML>
<html lang="es-ES">
<head>
	<meta charset="UTF-8">
	<title><?php echo $sitename." :: ".$titles[$mod]; ?></title>
	<link rel="stylesheet" href="<?php echo$r; ?>aux/style.css" />
	<link rel="stylesheet" href="<?php echo$r; ?>mods/<?php echo $mod ;?>/style.css" />
	<link rel="shortcut icon" href="<?php echo$r; ?>aux/img/favicon.png" />
	<meta name="keywords" content="<?php echo$keywords; ?>" />
	<meta name="description" content="<?php echo$description; ?>" />
	<script type="text/javascript" src="<?php echo $r; ?>aux/jquery.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$("a#<?php echo $mod; ?>").addClass("selected");
		});
	</script>
</head>
<body>
	<header>
		<h1 id="logo"><a href="<?php echo $r; ?>"><img src="<?php echo $r; ?>aux/img/logo.png" alt="<?php echo $sitename; ?>" /></a></h1>
		<section id="sharebox">
			<div id="addthis" class="addthis_toolbox addthis_default_style">
				<a class="addthis_button_preferred_1"></a>
				<a class="addthis_button_preferred_2"></a>
				<a class="addthis_button_preferred_3"></a>
				<a class="addthis_button_preferred_4"></a>
				<a class="addthis_button_compact"></a>
				<a class="addthis_counter addthis_bubble_style"></a>
			</div>
			<span id="share">COMPARTIR</span>
			<script type="text/javascript" src="https://s7.addthis.com/js/300/addthis_widget.js#pubid=xa-4ef8d9c447cbe45e"></script>
		</section>
		<section id="userbox">
			<?php include("mods/perfil/userbox.php"); ?>
		</section>
		<nav id="bar">
			<ul>
				<li><a id="proyecto" href="<?php echo$r ?>proyecto">PROYECTO</a></li>
				<li><a id="debate" href="<?php echo$r ?>debate">DEBATE</a></li>
				<li><a id="candidatos" href="<?php echo$r ?>candidatos">CANDIDATOS</a></li>
				<li><a id="votaciones" href="<?php echo$r ?>votaciones">VOTACIONES</a></li>
			</ul>
		</nav>
	</header>
	<section id="<?php echo$mod; ?>"><?php include("mods/".$mod."/index.php"); ?></section>
</body>
</html>
