<?php
	Class mySql{
		private $connection;
		private $dataBase;
	
		public function connect($addres, $user, $pw){
			$this->connection = mysql_connect($addres, $user, $pw) or die ("Erro de conexão</br>".mysql_error());
			mysql_set_charset('utf-8', $this->connection);
			session_start();
			return $this->connection;
		}

		public function selectDb($db){
			$this->dataBase = mysql_select_db($db, $this->connection) or die ("Erro de conexão</br>".mysql_error());
			return $this->dataBase;
		}

		public function insert($tb, $vals, $fields){
			$sql = 'insert '.$tb;
			if(is_array($fields)){
				$sql .= ' ('.$fields[0];
				for($field in $fields){
					
				}
			}
		}
	}
?>