<?php

namespace App\Model;

	class NCliente{
		public function create(){
			if(isset($_POST['btn-cadastrar'])){
				$padrao = "/^[0-9]{2}\/[0-9]{2}\/[0-9]{4}$/";
				date_default_timezone_set('America/Sao_Paulo');

				$erros = array();
				$p = new Cliente();
				$p->setNome(filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS));
				$p->setSobrenome(filter_input(INPUT_POST, 'sobrenome', FILTER_SANITIZE_SPECIAL_CHARS));


				
					if(!checkdate(date('m', strtotime($_POST['nascimento'])), date('d', strtotime($_POST['nascimento'])),date('y', strtotime($_POST['nascimento']))) && !preg_match($padrao, strtotime($_POST['nascimento'])) && date('d/m/y') < date('d/m/y',strtotime($_POST['nascimento']))){
						$erros[] = "Idade precisa ser um inteiro";
					}
					else{
						$p->setNascimento(date('y-m-d',strtotime($_POST['nascimento'])));
					}


				$p->setEmail(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL));
					if(!filter_var($p->getEmail(), FILTER_VALIDATE_EMAIL)):
						$erros[] = "Email Invalido";
					endif;

				if(count($erros) == 0){

					$sql = 'INSERT INTO clientes (nome, sobrenome, email, nascimento) VALUES (?,?,?,?)';
					try{
						$stmt = Conexão::getConn()->prepare($sql);
						$stmt->bindValue(1, $p->getNome());
						$stmt->bindValue(2, $p->getSobrenome());
						$stmt->bindValue(3, $p->getEmail());
						$stmt->bindValue(4, $p->getNascimento());
						$stmt->execute();
						$_SESSION['mensagem'] = "Atualizado com sucesso";
						header('Location: ../index.php');
					}
					catch(Exception $e){
						header('Location: ../error.php');
					}
				}
				else{
					$_SESSION['mensagem'] = "Erro ao cadastrar";
					header('Location: ../adicionar.php');
				}
			}
		}
		public function read(){
			$sql = 'SELECT * FROM clientes';
			$stmt = Conexão::getConn()->prepare($sql);
			$stmt->execute();

			if($stmt->rowCount() > 0){
				$resultado = $stmt->fetchAll(\PDO::FETCH_ASSOC);
				return $resultado;
			}
			else{
				return [];
			}
		}
		public function readi($id){
			$sql = "SELECT * FROM clientes WHERE id = '$id' ";
			$stmt = Conexão::getConn()->prepare($sql);
			$stmt->execute();
			$resultado = $stmt->fetchAll(\PDO::FETCH_ASSOC);
			return $resultado;
		}
		public function update(){
			if(isset($_POST['btn-editar'])){
				date_default_timezone_set('America/Sao_Paulo');
				$erros = array();
				$p = new Cliente();
				$p->setId($_GET['id']);
				$p->setNome(filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS));
				$p->setSobrenome(filter_input(INPUT_POST, 'sobrenome', FILTER_SANITIZE_SPECIAL_CHARS));
				if(!checkdate(date('m', strtotime($_POST['nascimento'])), date('d', strtotime($_POST['nascimento'])),date('y', strtotime($_POST['nascimento']))) && !preg_match($padrao, strtotime($_POST['nascimento'])) && date('d/m/y') < strtotime($_POST['nascimento'])){
						$erros[] = "Idade precisa ser um inteiro";
					}
					else{
						$p->setNascimento(date('y-m-d',strtotime($_POST['nascimento'])));
					}
				$p->setEmail(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL));
					if(!filter_var($p->getEmail(), FILTER_VALIDATE_EMAIL)):
						$erros[] = "Email Invalido";
					endif;

				if(count($erros) == 0){

					$sql = 'UPDATE clientes SET nome = ?, sobrenome = ?, email = ?, nascimento = ? WHERE id = ?';
					$stmt = Conexão::getConn()->prepare($sql);
					$stmt->bindValue(1, $p->getNome());
					$stmt->bindValue(2, $p->getSobrenome());
					$stmt->bindValue(3, $p->getEmail());
					$stmt->bindValue(4, $p->getNascimento());
					$stmt->bindValue(5, $p->getId());

					$stmt->execute();
					$_SESSION['mensagem'] = "Atualizado com sucesso";
					header('Location: ../index.php');
				}
				else{
					$_SESSION['mensagem'] = "Erro ao atualizar";
					header("Location: ../editar.php?id=".$p->getId());
				}
			}
		}
		public function deletar(){
			if(isset($_POST['btn-deletar'])){
				$id = $_POST['id'];
				$sql = 'DELETE FROM clientes WHERE id = ?';
				$stmt = Conexão::getConn()->prepare($sql);
				$stmt->bindValue(1, $id);
				$stmt->execute();
				header('Location: ../index.php');
			}
		}
	}