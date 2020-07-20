<?php

namespace App\Model;

	class Produto{
		private $id, $nome, $descricao;

		public function getNome(){
			return $this->nome;
		}
		public function setNome($n){
			$this->nome = $n;
		}
		public function getDescr(){
			return $this->descricao;
		}
		public function setDescr($descr){
			$this->descricao = $descr;
		}
		public function setId($id){
			$this->id = $id;
		}
		public function getId(){
			return $this->id;
		}
	}