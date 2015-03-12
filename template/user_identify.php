	<?php
		$con = mysql_connect("localhost", "root", "") or die ("Erro de conexão</br>".mysql_error());
		$db = mysql_select_db("liberte", $con) or die ("Erro de conexão</br>".mysql_error());
		if($con){
			if(isset($_GET['cadastro'])){
				if(isset($_FILES["perfil_img"])){
					if($_FILES["perfil_img"]['error']==0){
						$ext = substr($_FILES["perfil_img"]["name"], strpos(strrev($_FILES["perfil_img"]["name"]),".")*-1);
						$perfil_img = md5(time().$_FILES["perfil_img"]["name"]).".".$ext;
						move_uploaded_file($_FILES["perfil_img"]["tmp_name"], "images/".$perfil_img);
					}
					else{
						$_FILES["perfil_img"] = 'perfil_img_default.png';
					}
				}
				else{
					$_FILES["perfil_img"] = 'perfil_img_default.png';
				}
				$dt = $_POST['dt_nasc'];
				$dtD = substr($dt, 0, 2);
				$dtM = substr($dt, 3, 2);
				$dtA = substr($dt, 6, 4);
				$dt_nasc = $dtA.'-'.$dtM.'-'.$dtD;
				$sql = 'insert usuario (cpf, nome, sobrenome, sexo, dt_nasc, cep, endereco, complemento, num, cidade, estado, email, senha, perfil_img)'.
				 'value("'.$_POST["cpf"].'","'.$_POST["nome"].'","'.$_POST["sobrenome"].'","'.$_POST["sexo"].'","'.$dt_nasc.'","'.$_POST["cep"].'",'.
				 	'"'.$_POST["end"].'","'.$_POST["comp"].'","'.$_POST["num"].'","'.$_POST["cidade"].'",'.
				 	'"'.$_POST["estado"].'","'.$_POST["email"].'","'.$_POST["senha"].'","'.$perfil_img.'")';
				$rs = mysql_query($sql, $con);
				if($rs){
					include 'userread.php';
				}
				else{
					echo "Erro ao cadastrar".mysql_error();
				}
			}
			else if((isset($_POST['email'])) or (isset($_GET['id']))){
				include 'userread.php';
			}
			else{
				include 'header.php';
			}
		}

	?>