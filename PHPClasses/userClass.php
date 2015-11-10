<?php
	Class User{
		private $id;
		private $email;
		private $senha;
		private $nome;
		private $sobrenome;
		private $genero;
		private $dtNasc;
		private $imgPerfil;

		public function feedData($id){
			$sql = 'select * from usuarios where userid = '.$id;
			$rs = mysql_query($sql);
			if($rs){
				$reg = mysql_fetch_array($rs);
				$this->id = $reg['userid'];
				$this->email = $reg['email'];
				$this->senha = $reg['senha'];
				$this->nome = $reg['nome'];
				$this->sobrenome = $reg['sobrenome'];
				$this->genero = $reg['genero'];
				$this->dtNasc = $reg['dtNasc'];
				$this->imgPerfil = $reg['imgPerfil'];
				return $this->getData();
			}
			else return mysql_error();
		}

		public function getData(){
			$dataArray = ['id' => $this->id, 
						'email' => $this->email, 
						'senha' => $this->senha, 
						'nome' => $this->nome, 
						'sobrenome' => $this->sobrenome, 
						'genero' => $this->genero, 
						'dtNasc' => $this->dtNasc, 
						'imgPerfil' => $this->imgPerfil];
			return $dataArray;
		}

		public function insertData(){			
			global $_POST;

			$dtD = $_POST['dia'];
			$dtM = $_POST['mes'];
			$dtA = $_POST['ano'];
			$dtNasc = $dtA.'-'.$dtM.'-'.$dtD;
			$sql = 'insert usuarios(email, senha, nome, sobrenome, genero, dtNasc, imgPerfil) 
			value("'.$_POST["email"].'","'.$_POST["senha"].'","'.$_POST["nome"].'","'.$_POST["sNome"].'","'.$_POST["genero"].'",'.
				'"'.$dtNasc.'","'.$_POST['perfilImg'].'")';
			$rs = mysql_query($sql);
			return $rs;
		}

		public function login($email, $senha){
			$sql = 'select userid from usuarios where email = "'.$email.'" and senha = "'.$senha.'"';
			$rs = mysql_query($sql);
			$reg = mysql_fetch_array($rs)[0];
			if(!is_null($reg)){
				$this->feedData($reg);
				return true;
			}
			else return false;
		}

		public function checkEmail($email){
			$sql = 'select * from usuarios where email = "'.$email.'"';
			$rs = mysql_query($sql);
			$reg = mysql_fetch_array($rs)[0];
			return !is_null($reg)? true : false;
		}
	}
?>