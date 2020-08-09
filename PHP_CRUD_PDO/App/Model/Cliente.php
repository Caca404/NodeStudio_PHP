<?php

namespace App\Model;

	class Cliente{
		private $id, $nome, $sobrenome, $email, $nascimento;

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

		public function getNascimento(){
			return $this->nascimento;
		}
		public function setNascimento($i){
			$this->nascimento = $i;
		}

		public function setId($i){
			$this->id = $i;
		}
		public function getId(){
			return $this->id;
		}
	}