<?php
session_start();
$_SESSION['myid'] = NULL;
session_destroy();
header("Location: {$_SERVER['HTTP_REFERER']}");
?>
