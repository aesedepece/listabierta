<?php if($b): //SI SE ELIJE UNA CIRCUNSCRIPCIÓN
	if($c): //SI SE ELIJE UN CANDIDATO
	
	endif;

else:
$regions = mysql_query("SELECT * FROM `regions` WHERE `enabled` = '1' ORDER BY `name` ASC", $db);
?>
<section id="main">
	<header>
		<h1>CANDIDATOS</h1>
	</header>
	<section id="regions">
		<?php while($region = mysql_fetch_assoc($regions))echo"<article class=\"region\"><header><a href=\"candidatos/".strtolower(utf8_encode($region['name']))."\">".ucfirst(utf8_encode($region['name']))."</a></header></article>"; ?>	
	</section>
	<aside id="joinus">
		<a href="candidatos/presentarme"><img src="<?php echo$r; ?>mods/candidatos/img/banner240x275.png" alt="Buscamos candidatos como TÚ. Apúntate >" /></a>
	</aside>
	<footer></footer>
</section>
<?php endif; ?>
