<?php

namespace App\Model;

	class Conexão{

		private static $instance;

		public static function getConn(){
		    if(!isset(self::$instance)){
			    try
			    {
			        self::$instance = new \PDO("mysql:host=localhost;dbname=crud;charset=utf8","root", "");
			        self::$instance->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
			    }
			    catch(PDOException $exception)
			    {
			        throw $exception;
			    }
			}
		    return self::$instance;
		}
	}