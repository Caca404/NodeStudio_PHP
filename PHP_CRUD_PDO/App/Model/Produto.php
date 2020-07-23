<?php

namespace App\Model;

	class Produto{
		private $id, $nome, $sobrenome, $email, $idade;

		public function getNome(){
			return $this->nome;
		}
		public function setNome($n){
			$this->nome = $n;
		}

		public function getSobrenome(){
			return $this->sobrenome;
		}
		public function setSobrenome($sn){
			$this->sobrenome = $sn;
		}

		public function getEmail(){
			return $this->email;
		}
		public function setEmail($e){
			$this->email = $e;
		}

		public function getIdade(){
			return $this->idade;
		}
		public function setIdade($i){
			$this->idade = $i;
		}

		public function setId($i){
			$this->id = $i;
		}
		public function getId(){
			return $this->id;
		}
	}