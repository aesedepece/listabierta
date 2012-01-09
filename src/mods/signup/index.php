<?php
$email = mysql_real_escape_string($_POST['email']);
$name = mysql_real_escape_string($_POST['name']);
$surname = mysql_real_escape_string($_POST['surname']);
$zip = mysql_real_escape_string($_POST['zip']);
if($_POST['news'])$news=1;

//SI SE DESEA ESTABLECER EL PIN
if($b=="pinset"){
$acode = mysql_real_escape_string($_POST['acode']);
$pin = mysql_real_escape_string($_POST['pin']);
	//SI SE PROPORCIONA TODO
	if($acode&&$pin){
		$code = base64_decode($acode);
		$code = explode("|", $code);
		//SI ES EL CORRECTO
		if(mysql_num_rows(mysql_query("SELECT * FROM `members` WHERE `email` = '".$code[1]."' AND `secret` = '".$code[0]."' AND `pin` IS NULL LIMIT 1", $db))){
			mysql_query("UPDATE `members` set `pin` = '".$pin."' WHERE `email` = '".$code[1]."' AND `secret` = '".$code[0]."' LIMIT 1", $db);
			?>
			<script type="text/javascript">
				$(document).ready(function(){
					setTimeout(function(){
						document.location.href = "<?php echo$r; ?>perfil";
					}, 4000);
				});
			</script>
			<form id="signup">
				<h1>¡Bienvenido!</h1>
				<p id="desc">Tu cuenta ha sido activada.</p>
				<p id="desc">La sesión se iniciará y serás remitido a tu página principal en unos segundos. Por si algo va mal <a href="<?php echo$r; ?>perfil">aquí</a> tienes un enlace manual.</p>
			</form>
			<?php
			$_SESSION['myid'] = mysql_result(mysql_query("SELECT `id` FROM `members` WHERE `email` = '".$code[1]."' AND `secret` = '".$code[0]."' AND `pin` IS NOT NULL LIMIT 1", $db), 0);
		}else{
			echo "<h1>Ocurrió un error</h1><h2>El código de activación es incorrecto o la cuenta ya está activada";
		}
	}else{
		echo "<h1>Ocurrió un error</h1><h2>El código de activación es incorrecto o la cuenta ya está activada";
	}
//SI SE DESEA ACTIVAR LA CUENTA
}elseif($b=="activate"){
	$acode = mysql_real_escape_string($_POST['acode']);
	//SI SE PROPORCIONA EL CÓDIGO DE ACTIVACIÓN
	if($c||$acode){
		if($c)$acode = $c; //UNIFICA C Y ACODE
		$code = base64_decode($acode);
		$code = explode("|", $code);
		//SI ES EL CORRECTO
		if(mysql_num_rows(mysql_query("SELECT * FROM `members` WHERE `email` = '".$code[1]."' AND `secret` = '".$code[0]."' AND `pin` IS NULL LIMIT 1", $db))){
		?>
		<script type="text/javascript">
			function pad(n){
				if($("input#pin").val().length<8)$("input#pin").val($("input#pin").val()+n);
				if($("input#pin").val().length>3)$("input#submit").show();
			}
			function clear(){
				$("input#pin").val("");
				$("input#submit").hide();
			}
			$(document).ready(function(){
				$.ajax({
					url: "https://<?php echo$domain.$r;?>mods/signup/image.php",
					type: "GET",
					data: {code : "<?php echo $code[0]; ?>", domain : "<?php echo $domain; ?>", r : "<?php echo $r; ?>"},
					success: function(ret){
						$("figure#sec").html(ret);
						$("span#wait").hide();
					}
				});
			});
		</script>
		<form action="https://<?php echo$domain.$r; ?>signup/pinset" method="POST" id="signup">
			<h1>ESTABLECER MI PIN</h1>
			<p id="desc">Es importante que establezcas un código PIN para proteger tu cuenta</p>
			<hr />
			<table id="pad">
			<tr>
			<?php
			for($i=0;$i<10;$i++)$n[$i]=$i;
			shuffle($n);
			for($i=0;$i<10;$i++){
				echo"<td><a class=\"button\" href=\"javascript:pad(".$n[$i].");\">".$n[$i]."</a></td>";
				if($i==4)echo"</tr><tr>";
			}
			?>
			</tr>
			</table>
			<section id="pin">
				<input type="hidden" value="<?php echo $acode; ?>" name="acode" />
				<input type="password" name="pin" id="pin" readonly="readonly" />
				<a href="javascript:clear();" id="clear"><img src="<?php echo$r; ?>mods/signup/img/delete.png" alt="borrar" /></a>
				<br/><br/>El PIN debe tener entre 4 y 8 cifras
			</section>
			<figure id="sec"></figure>
			<hr />
			<section id="buttons">
				<span id="wait" class="r">Espera mientras se genera tu imagen de seguridad <img src="<?php echo$r; ?>aux/img/ajax-loader.gif" /></span>
				<input type="submit" id="submit" value="Siguiente >" class="r button hidden" />
			</section>
		</form>
		<?php
		//SI NO ES EL CORRECTO
		}else{
			echo "<h1>Ocurrió un error</h1><h2>El código de activación es incorrecto o la cuenta ya está activa</h2>";
		}
	//SI NO SE PROPORCIONA EL CÓDIGO DE ACTIVACIÓN
	}else{
?>
	<form action="https://<?php echo$domain.$r; ?>signup/activate" method="POST" id="signup">
		<h1>ACTIVAR MI CUENTA</h1>
		<p id="desc">Introduce el código de activación que encontrarás el email que te hemos enviado.</p>
		<hr />
		<table id="fields">
			<tr>
				<td>Código de activación:</td>
				<td><input type="text" name="acode" id="acode" required /></td>
			</tr>
		</table>
		<hr />
		<section id="buttons">
			<button onclick="history.back();" class="l button">Cancelar</button>
			<input type="submit" value="Siguiente >" class="r button" />
		</section>
	</form>
<?php
	}
}else if($email&&$name&&$surname&&$zip){
	if(mysql_num_rows(mysql_query("SELECT * FROM `members` WHERE `email` = '".$email."'"))){
		echo"mail ya registrado";
	}else{
		$secret = rand(0, 99999);
		$acode = str_replace("=", "", base64_encode($secret."|".$email));
		mysql_query("INSERT INTO `members` (`email`, `secret`, `name`, `surname`, `zip`, `news`, `time`) VALUES ('".$email."', '".$secret."','".utf8_decode($name)."', '".utf8_decode($surname)."', '".$zip."', '".$news."', '".time()."')");
		$msg = "<html>
		<body>
		<h1>¡Bienvenido ".$name."!</h1><br />
		<p>Para completar tu registro tienes que confirmar tu email y activar el código PIN para tu cuenta.</p>
		<p>El código de activación de tu cuenta es el siguiente:<br /><strong>".$acode."</strong></p>
		<p>También puedes activar la cuenta directamente pulsando <a href=\"https://".$domain.$r."signup/activate/".$acode."\">aquí</a>.</p>
		</body>
		</html>";
		mail($email, "[".$sitename."] Confirma tu email", $msg, "Content-type: text/html\r\nFrom: webmaster@".$domain);
		echo"<script type=\"text/javascript\">document.location.href = \"https://".$domain.$r."signup/activate\"</script>";
	}
}else{
?>
	<span id="top">¿Tienes ya una cuenta? <a href="https://<?php echo$domain.$r; ?>login">Inicia sesión</a></span>
	<form action="https://<?php echo$domain.$r; ?>signup" method="POST" id="signup">
		<h1>ÚNETE EN UN MINUTO</h1>
		<p id="desc">Podrás elegir candidato e incluso presentar tu propia candidatura. ¡Por supuesto es gratis y no te obliga a votarnos en las elecciones!</p>
		<hr />
		<table id="fields">
			<tr>
				<td>Email:</td>
				<td><input type="email" name="email" id="email" value="<?php echo$_POST['email'];?>" placeholder="Email" required /></td>
			</tr>
			<tr>
				<td>Nombre:</td>
				<td><input type="text" name="name" id="name" placeholder="Nombre" required /></td>
			</tr>
			<tr>
				<td>Apellidos:</td>
				<td><input type="text" name="surname" id="surname" placeholder="Apellidos" required /></td>
			</tr>
			<tr>
				<td>Código Postal:</td>
				<td><input type="text" name="zip" id="zip" placeholder="C.P." required /></td>
			</tr>
		</table>
		<table id="checks">
			<tr><td><input type="checkbox" name="terms" id="terms" required /><label for="terms"><small>Acepto los <a href="<?php echo$r; ?>mods/signup/terms.htm" target="_blank">Términos de Uso</a> y la <a href="<?php echo$r; ?>mods/signup/privacity.htm" target="_blank">Política de Privacidad</a>.</small></label></td></tr>
			<tr><td><input type="checkbox" name="news" id="news" checked /><label for="news"><small>Deseo recibir noticias sobre <?php echo $sitename; ?> en mi email.</small></label></td></tr>
		</table>
		<hr />
		<section id="buttons">
			<button onclick="history.back();" class="l button">Cancelar</button>
			<input type="submit" value="Siguiente >" class="r button" />
		</section>
	</form>
<?php } ?>
