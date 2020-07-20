<?php

	session_start();
	require_once 'db_connect.php';
	$erros = 0;

	if(isset($_POST['btn-editar'])){
		$nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);
		$sobrenome = filter_input(INPUT_POST, 'sobrenome', FILTER_SANITIZE_SPECIAL_CHARS);

		$idade = filter_input(INPUT_POST, 'idade', FILTER_SANITIZE_NUMBER_INT);
				if(!filter_var($idade, FILTER_VALIDATE_INT)):
					$erros++;
				endif;
		$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
				if(!filter_var($email, FILTER_VALIDATE_EMAIL)):
					$erros++;
				endif;
		$id = mysqli_escape_string($connect, $_POST['id']);

		if($erros == 0){
			$nome = mysqli_escape_string($connect, $nome);
			$sobrenome = mysqli_escape_string($connect, $sobrenome);
			$email = mysqli_escape_string($connect, $email);
			$idade = mysqli_escape_string($connect, $idade);
			
			

			$sql = "UPDATE clientes SET nome = '$nome', sobrenome = '$sobrenome', email = '$email', idade = '$idade' WHERE id = '$id'";
			
				if(mysqli_query($connect, $sql)){
					$_SESSION['mensagem'] = "Atualizado com sucesso";
					header('Location: ../index.php');
				}
				else{
					$_SESSION['mensagem'] = "Erro ao atualizar";
					header('Location: ../index.php');
				}
		}
		else{
			$_SESSION['mensagem'] = "Erro ao atualizar";
			header("Location: ../editar.php?id=$id");
		}
	}