<?php
	include_once 'database/classes/Crud.php';
	$crud = new Crud();

	include 'database/server.php';
	include 'database/var.php';
	include 'includes/header.php';
	include 'pages/home.php';
	include 'includes/footer.php';

?>
