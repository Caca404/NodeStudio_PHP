<?php

	require_once 'vendor/autoload.php';

	$prod = new \App\Model\Produto();
	$prod->setId(1);
	$prod->setNome('Cadeira');
	$prod->setDescr('Gamer');

	$prodDao = new \App\Model\ProdutoDao();
	$prodDao->delete(2);
	$prodDao->read();

	foreach ($prodDao->read() as $pr) {
		echo $pr['nome']."<br>".$pr['descricao'].'<hr>';
	}