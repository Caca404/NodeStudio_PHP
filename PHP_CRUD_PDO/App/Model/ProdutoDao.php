<?php

namespace App\Model;

	class ProdutoDao{
		public function create(){
			if(isset($_POST['btn-cadastrar'])){
				$p = new Produto;
				$p->setNome(filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS));
				$p->setSobrenome(filter_input(INPUT_POST, 'sobrenome', FILTER_SANITIZE_SPECIAL_CHARS));
				$p->setIdade(filter_input(INPUT_POST, 'idade', FILTER_SANITIZE_NUMBER_INT));
				$p->setEmail(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL));

				$sql = 'INSERT INTO clientes (nome, sobrenome, email, idade) VALUES (?,?,?,?)';
				$stmt = Conexão::getConn()->prepare($sql);
				$stmt->bindValue(1, $p->getNome());
				$stmt->bindValue(2, $p->getSobrenome());
				$stmt->bindValue(3, $p->getEmail());
				$stmt->bindValue(4, $p->getIdade());
				$stmt->execute();
				header('Location: ../index.php');
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
				$p = new Produto;
				$p->setId($_GET['id']);
				$p->setNome(filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS));
				$p->setSobrenome(filter_input(INPUT_POST, 'sobrenome', FILTER_SANITIZE_SPECIAL_CHARS));
				$p->setIdade(filter_input(INPUT_POST, 'idade', FILTER_SANITIZE_NUMBER_INT));
				$p->setEmail(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL));


				$sql = 'UPDATE clientes SET nome = ?, sobrenome = ?, email = ?, idade = ? WHERE id = ?';
				$stmt = Conexão::getConn()->prepare($sql);
				$stmt->bindValue(1, $p->getNome());
				$stmt->bindValue(2, $p->getSobrenome());
				$stmt->bindValue(3, $p->getEmail());
				$stmt->bindValue(4, $p->getIdade());
				$stmt->bindValue(5, $p->getId());

				$stmt->execute();
				header('Location: ../index.php');
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