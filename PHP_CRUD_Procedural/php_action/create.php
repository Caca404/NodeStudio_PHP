<?php

	session_start();
	require_once 'db_connect.php';
	$erros = array();

	if(isset($_POST['btn-cadastrar'])){
		$nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);
		$sobrenome = filter_input(INPUT_POST, 'sobrenome', FILTER_SANITIZE_SPECIAL_CHARS);

		$idade = filter_input(INPUT_POST, 'idade', FILTER_SANITIZE_NUMBER_INT);
				if(!filter_var($idade, FILTER_VALIDATE_INT)):
					$erros[] = "Idade precisa ser um inteiro";
				endif;
		$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
				if(!filter_var($email, FILTER_VALIDATE_EMAIL)):
					$erros[] = "Email Invalido";
				endif;
		
		if(count($erros) == 0){
			$nome = mysqli_escape_string($connect, $nome);
			$sobrenome = mysqli_escape_string($connect, $sobrenome);
			$email = mysqli_escape_string($connect, $email);
			$idade = mysqli_escape_string($connect, $idade);

			$sql = "INSERT INTO clientes(nome, sobrenome, email, idade) VALUES ('$nome','$sobrenome','$email','$idade')";
			if(mysqli_query($connect, $sql)){
				$_SESSION['mensagem'] = "Cadastrado com sucesso";
				$_SESSION['idade'] = $idade;
				header('Location: ../index.php');
			}
			else{
				$_SESSION['mensagem'] = "Erro ao cadastrar";
				$_SESSION['idade'] = $idade;
				header('Location: ../index.php');
			}
		}
		else{
			$_SESSION['mensagem'] = "Erro ao cadastrar";
			header('Location: ../adicionar.php');
		}
	}