<?php
	Class User{
		private $email;
		private $senha;
		private $nome;
		private $sobrenome;
		private $genero;
		private $dtNasc;
		private $imgPerfil;

		public function feedData($email){
			$sql = 'select * from usuarios where email = "'.$email.'"';
			$rs = mysql_query($sql);
			$reg = mysql_fetch_array($rs);
			$this->email = $reg['email'];
			$this->senha = $reg['senha'];
			$this->nome = $reg['nome'];
			$this->sobrenome = $reg['sobrenome'];
			$this->genero = $reg['genero'];
			$this->dtNasc = $reg['dtNasc'];
			$this->imgPerfil = $reg['imgPerfil'];
			return $rs;
		}

		public function getData(){
			$dataArray = ['email' => $this->email, 
						'senha' => $this->senha, 
						'nome' => $this->nome, 
						'sobrenome' => $this->sobrenome, 
						'genero' => $this->genero, 
						'dtNasc' => $this->dtNasc, 
						'imgPerfil' => $this->imgPerfil];
			return $dataArray;
		}

		public function insertData(){			
			global $_POST, $_FILES;
			if(isset($_FILES["imgPerfil"])){
				if($_FILES["imgPerfil"]['error']==0){
					$ext = substr($_FILES["imgPerfil"]["name"], strpos(strrev($_FILES["imgPerfil"]["name"]),".")*-1);
					$imgPerfil = md5(time().$_FILES["imgPerfil"]["name"]).".".$ext;
					move_uploaded_file($_FILES["imgPerfil"]["tmp_name"], "images/".$imgPerfil);
				}
				else{
					$_FILES["imgPerfil"] = 'imgPerfil_default.png';
				}
			}
			else{
				$_FILES["imgPerfil"] = 'imgPerfil_default.png';
			}
			$dt = $_POST['dt_nasc'];
			$dtD = substr($dt, 0, 2);
			$dtM = substr($dt, 3, 2);
			$dtA = substr($dt, 6, 4);
			$dtNasc = $dtA.'-'.$dtM.'-'.$dtD;
			$sql = 'insert usuario value("'.$_POST["email"].'","'.$_POST["senha"].'","'.$_POST["nome"].'","'.$_POST["sobrenome"].'","'.$_POST["genero"].'",'.
				'"'.$dtNasc.'","'.$imgPerfil.'")';
			$rs = mysql_query($sql);
			return $rs;
		}

		public function login($email, $senha){
			$sql = 'select * from usuarios where email = "'.$email.'" and senha = "'.$senha.'"';
			$rs = mysql_query($sql);
			$reg = mysql_fetch_array($rs)[0];
			if(!is_null($reg)){
				$this->feedData($email);
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