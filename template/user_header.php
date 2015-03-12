<header>
<?php
	session_start();
	$sql = (isset($_GET['id'])?'select * from usuario where id = "'.$_GET["id"].'"':'select * from usuario where email = "'.$_POST["email"].'" and senha = "'.$_POST["senha"].'"');
	$rs = mysql_query($sql, $con);
	if($rs){
		$reg = mysql_fetch_array($rs);
		$id = $reg['id'];
		$_SESSION['user_id'] = $id;
		$nome = $reg['nome'];
		$sobrenome = $reg['sobrenome'];
		$perfil_img = $reg['perfil_img'];
		$sexo = $reg['sexo'];
		$cep = $reg['cep'];
		$endereco = $reg['endereco'];
		$complemento = $reg['complemento'];
		$num = $reg['num'];
		$cidade = $reg['sexo'];
		$estado = $reg['estado'];
?>
<link rel="stylesheet" type="text/css" href="style/liberte.css"/>
<div id="user-top">
	<div class="content">
		<div class="escrever"><a href="index.php">Sair</a></div>
		<div class="escrever"><a href="escrever_materia.php?id=<?php echo $id; ?>">Nova matéria</a></div>
		<div class="perfil">
			<div class="perfil img" style="background: url('images/<?php echo $perfil_img; ?>');background-size: 100% 100%;"></div>
			<div class="perfil nome"><a href="perfil.php?id=<?php echo $id; ?>"><?php echo $nome ?></a></div>
		</div>
		<center><div class="homelink"><a href="liberte.php?id=<?php echo $id; ?>"><img src="images/home.gif" style="width: 30px; height: 30px;"/></a></div></center>
	</div>
</div>
<div id="nav">
	<div class="content">
	<div id="bar"></div>
		<ul>
			<li><a class="menun" onmouseover="move(0);" href="#">Mundo</a></li>
			<li><a class="menun" onmouseover="move(1);" href="#">Ciência</a></li>
			<li><a class="menun" onmouseover="move(2);" href="#">Tecnologia</a></li>
			<li><a class="menun" onmouseover="move(3);" href="#">Arte</a></li>
			<li><a class="menun" onmouseover="move(4);" href="#">Entretenimento</a></li>
			<li><a class="menun" onmouseover="move(5);" href="#">Política</a></li>
		</ul>
	</div>
</div>
<?php 
	}
	else{
		echo 'Erro no servidor</br>'.mysql_error(); 
	}
?>
</header>