<?php if(!$myid){
	echo"<script type=\"text/javascript\">document.location.href = \"".$r."login\";</script>";
}else{
$id = $b;
if(!$id)$id=$myid;
$data = mysql_query("SELECT * FROM `members` WHERE `id` = '".$id."' LIMIT 1", $db);
if(!mysql_num_rows($data)){
	echo"<section id=\"usercard\">¡No existe tal usuario!</section>";
}else{
	$data = mysql_fetch_assoc($data);
	$region = mysql_fetch_assoc(mysql_query("SELECT * FROM `regions` WHERE `id` = '".substr($data['zip'], 0, 2)."' LIMIT 1", $db));
	$candidatures = mysql_query("SELECT * FROM `candidatures` WHERE `member` = '".$id."'", $db);
	$questions = mysql_query("SELECT * FROM `questions` WHERE `from` = '".$id."'", $db);
	$answers = mysql_query("SELECT * FROM `answers` WHERE `from` = '".$id."'", $db);
	$votes = mysql_query("SELECT * FROM `votes` WHERE `from` = '".$id."'", $db);
	?>
	<section id="usercard">
		<header>
			<h1><?php echo utf8_encode($data['name']." ".$data['surname']); ?></h1>
		</header>
		<section id="images">
			<?php if($id==$myid){ ?>
			 <figure id="sec">
			 	<img src="<?php echo$r ?>aux/img/sec/<?php echo$mydata['secret'] ?>.jpg" alt="Imagen de seguridad" />
			 	<figcaption>Esta es tu imagen de seguridad, nunca inicies sesión en <?php echo$sitename; ?> si no aparece o es otra distinta.</figcaption>
			 </figure>
			 <?php } ?>
		</section>
		<section id="data">
			<article id="region">
				<header>Circunscripción</header>
				<small><?php echo$data['zip']; ?></small><a href="<?php echo$r.'region/'.strtolower(utf8_encode($region['name'])); ?>"><?php echo utf8_encode($region['name']); ?></a><?php if(!$region['enabled'])echo" (Esta circunscripción no participa en el proceso actual)"; ?>
			</article>
			<article id="candidature">
				<header>Candidaturas</header>
				<?php
					if(mysql_num_rows($candidatures)){
						while($candidature = mysql_fetch_assoc($candidatures)){
							$process = mysql_fetch_assoc(mysql_query("SELECT * FROM `processes` WHERE `id` = '".$candidature['process']."'", $db));
							$region = mysql_fetch_assoc(mysql_query("SELECT * FROM `regions` WHERE `id` = '".$candidature['region']."'", $db));
							echo"<small>".date("d-m-Y", $candidature['time'])."</small><a href=\"".$r."candidatos\">".utf8_encode($process['name'])."</a> en <a href=\"".$r."region/".strtolower(utf8_encode($region['name']))."\">".utf8_encode($region['name'])."</a><br />";
						}
					}else echo"Aún no ha presentado ninguna candidatura";
				?>
			</article>
			<article id="questions">
				<header>Preguntas</header>
				<?php
					if(mysql_num_rows($questions)){
						while($question = mysql_fetch_assoc($questions)){
							if(strlen($question['text'])>50)$question['text'] = substr($question['text'], 0, 50)."...";
							echo"<small>".date("d-m-Y H:i", $question['time'])."</small>«<a href=\"".$r."pregunta/".$question['id']."\">".utf8_encode($question['text'])."</a>»";
							if($question['to']){
								$to = mysql_fetch_assoc(mysql_query("SELECT * FROM `candidatures` WHERE `id` = '".$question['to']."'", $db));
								$to = mysql_fetch_assoc(mysql_query("SELECT * FROM `members` WHERE `id` = '".$to['member']."'", $db));
								echo" a <a href=\"".$r."perfil/".$to['id']."\">".utf8_encode($to['name']." ".$to['surname'])."</a>";
							}else if($question['region']){
								$region = mysql_fetch_assoc(mysql_query("SELECT * FROM `regions` WHERE `id` = '".$question['region']."'", $db));
								echo" a todo <a href=\"".$r."region/".strtolower(utf8_encode($region['name']))."\">".utf8_encode($region['name'])."</a>";
							}
							echo"<br />";
						}
					}else echo"Aún no ha realizado ninguna pregunta";
				?>
			</article>
			<article id="answers">
				<header>Respuestas</header>
				<?php
					if(mysql_num_rows($candidatures)){
						if(mysql_num_rows($answers)){
							while($answer = mysql_fetch_assoc($answers)){
								echo"<small>".date("d-m-Y H:i", $answer['time'])."</small>";
								$question = mysql_fetch_assoc(mysql_query("SELECT * FROM `questions` WHERE `id` = '".$answer['question']."'", $db));
								if(strlen($question['text'])>50)$question['text'] = substr($question['text'], 0, 50)."...";
								$to = mysql_fetch_assoc(mysql_query("SELECT * FROM `members` WHERE `id` = '".$question['from']."'", $db));
								echo"a «<a href=\"".$r."pregunta/".$question['id']."#r".$answer['id']."\">".utf8_encode($question['text'])."</a>» de <a href=\"".$r."perfil/".$to['id']."\">".utf8_encode($to['name']." ".$to['surname'])."</a>";
								echo"<br />";
							}
						}else echo"Aún no ha respondido ninguna pregunta";
					}else echo"Sólo los candidatos pueden responder preguntas";
				?>
			</article>
			<article id="votings">
				<header>Votaciones</header>
				<?php
					if(mysql_num_rows($votes)){
						while($vote = mysql_fetch_assoc($votes)){
							echo"<small>".date("d-m-Y", $vote['time'])."</small>";
						}
					}else echo"Aún no ha apoyado ninguna candidatura";
				?>
			</article>
		</section>
		<footer></footer>
	</section>
	<?php
	}
}
?>
