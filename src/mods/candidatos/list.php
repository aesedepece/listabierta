<?php
$regions = mysql_query("SELECT * FROM `regions` WHERE `enabled` = '1' ORDER BY `name` ASC", $db);
?>
<section id="main">
	<header>
		<h1>CANDIDATOS</h1>
	</header>
	<section id="regions">
		<?php while($region = mysql_fetch_assoc($regions)): ?>
		<article class="region">
			<header>
				<a href="candidatos/<?php echo strtolower(utf8_encode($region['name'])); ?>"><?php echo ucfirst(utf8_encode($region['name'])); ?></a>
			</header>
			<?php 
			$candidatures = mysql_query("SELECT * FROM `candidatures` WHERE `region` = '".$region['id']."' AND `process` = '1' ORDER BY RAND() LIMIT 3");
			if(mysql_num_rows($candidatures)):
				while($candidature = mysql_fetch_assoc($candidatures)):
				$candidate = mysql_fetch_assoc(mysql_query("SELECT * FROM `members` WHERE `id` = '".$candidature['member']."'", $db));
				?>
				<figure class="candidatecard">
					<img src="" />
					<figcaption>
						<?php echo "<a href=\"candidatos/".strtolower(utf8_encode($region['name']))."/".$candidature['id']."\">".utf8_encode($candidate['name']." ".$candidate['surname'])."</a>"; ?>
					</figcaption>
				</figure>
				<?php endwhile; ?>
				<figure class="morecandidates"></figure>
			<?php else:
				echo"No hay candidaturas en esta circunscripción.";
			endif;
			?>
		</article>
		<?php endwhile; ?>
	</section>
	<aside id="joinus">
		<a href="candidatos/presentarme"><img src="<?php echo$r; ?>mods/candidatos/img/banner240x275.png" alt="Buscamos candidatos como TÚ. Apúntate >" /></a>
	</aside>
	<footer></footer>
</section>
