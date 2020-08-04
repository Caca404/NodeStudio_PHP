<?php
	require_once 'vendor/autoload.php';
	$phpe = new \App\Model\Email();
	$phpe->add("Teste", "<h1>Denovo</h1>", "Ricardo Silva", "jrbaixaverde2014@gmail.com");
	$phpe->send("PHP test", "php.teste10kk@gmail.com");
	header('Location: ../index.php');