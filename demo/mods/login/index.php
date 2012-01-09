<?php
if($myid)echo"<script type=\"text/javascript\">document.location.href = \"".$r."perfil\";</script>";
else{
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
	function checkmail(){
		$("img#email-loading").show();
		$.ajax({
			url: "https://<?php echo$domain.$r;?>mods/login/checkmail.php",
			type: "GET",
			data: {email : $("input#email").val(), domain : "<?php echo $domain; ?>", r : "<?php echo $r; ?>"},
			success: function(ret){
				if(ret){
					$("div#blocker").hide();
					image(ret);
				}else $("div#blocker").show();
				$("img#email-loading").hide();
			}
		});
	}
	function image(myid){
		$.ajax({
			url: "https://<?php echo$domain.$r;?>mods/login/image.php",
			type: "GET",
			data: {code : myid, domain : "<?php echo $domain; ?>", r : "<?php echo $r; ?>"},
			success: function(ret){
				$("figure#sec").html(ret);
				$("figure#sec").show();
			}
		});
	}
</script>
<span id="top">¿Todavía no eres miembro? <a href="https://<?php echo$domain.$r; ?>signup">Regístrate</a></span>
<form action="https://<?php echo$domain.$r; ?>mods/login/login.php" id="login" method="POST">
	<h1>INICIAR SESIÓN</h1>
	<p id="desc">Introduce tu email y PIN</p>
	<hr />
	<label for="email">Email</label>
	<input type="email" name="email" id="email" onchange="checkmail();" />
	<img src="<?php echo$r; ?>aux/img/ajax-loader.gif" id="email-loading" class="hidden"/>
	<hr />
	<div id="blocker"></div>
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
		<input type="submit" id="submit" value="Siguiente >" class="r button hidden" />
	</section>
</form>
<?php
}
?>
