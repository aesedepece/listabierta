<div id="banner">
	<img src="<?php echo$r; ?>mods/main/img/banner.jpg" alt="" />
	<div id="text">
		<br /><br />
		<h1>Proyecto de Democracia Participativa</h1>
		<h2>Soberanía del pueblo para el pueblo</h2>
	</div>
</div>
<?php if(!$myid){ ?>
<form action="https://<?php echo$domain.$r; ?>signup" id="join" method="POST">
	<span>
		Apúntate ya como votante o candidato >
		<input type="email" name="email" id="email" placeholder="Para empezar, déjanos un email de contacto" />
		<input type="submit" value="Continuar" id="continue" />
	</span>
</form>
<?php } ?>
<section id="content"><section id="blocks">
	<article class="w300 rborder">
		<h2 class="magenta">
			TÍTULO PRIMERO
		</h2>
		<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>
	</article>
	<article class="w300 rborder">
		<h2 class="cyan">
			TÍTULO SEGUNDO
		</h2>
		<p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
	</article>
	<article class="w300">
		<h2 class="orange">
			TÍTULO TERCERO
		</h2>
		<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>
	</article>
	<hr class="clear" />
</section></section>
<footer><hr />© <?php echo$sitename;?>. Algunos derechos reservados.<br />Powered by listabierta [kddCMS+minshu].</footer>
