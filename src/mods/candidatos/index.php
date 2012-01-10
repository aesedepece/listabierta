<?php if($b): //SI SE ELIJE UNA CIRCUNSCRIPCIÓN
	if($c): //SI SE ELIJE UN CANDIDATO
		include("candidature.php");
	else:
		include("region.php");
	endif;
else:
	include("list.php");
endif; ?>
