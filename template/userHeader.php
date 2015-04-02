<header>
<?php 
	include 'PHPClasses/userClass.php';
	$user = new user();
	$user->feedData($_SESSION['user']);
	$userData = $user->getData();
?>
<link rel="stylesheet" type="text/css" href="style/userHeader.css"/>
<div id="user-top">
	<div class="content">
		<div class="escrever"><a href="index.php?logout=1" onclick='logout();'>Sair</a></div>
		<div class="escrever"><a href="escrever_materia.php">Nova matéria</a></div>
		<div class="perfil">
			<div class="perfil img" style="background: url('images/<?php echo $userData['imgPerfil']; ?>');background-size: 100% 100%;"></div>
			<div class="perfil nome"><a href="perfil.php?>"><?php echo $userData['nome'] ?></a></div>
		</div>
		<center><div class="homelink"><a href="index.php"><img src="images/home.gif" style="width: 30px; height: 30px;"/></a></div></center>
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
</header>