<header>
	<link rel="stylesheet" type="text/css" href="style/index.css"/>
	<?php
		$con = mysql_connect('localhost', 'root', '');
		$db = mysql_select_db('liberte', $con);
	?>
	<div id="top">
		<div class="content">
			<div class="logo" style="background: url('images/logo.jpg'); background-size: 100% 100%;">
			</div>
			<div class="login">
				<form method="POST" action="liberte.php">
					<input type="text" size="20" placeholder="E-mail" name="email"></br>
					<input type="password" size="20" placeholder="Senha" name="senha"></br>
					<a href="cadastro.php"><input type="button" class="login_btn" value="Cadastrar-se"/></a>
					<input type="submit" class="login_btn" value="Entrar">
				</form>
			</div>
		</div>
	</div>
	<div id="nav">
		<div class="content">
		<div id="bar"></div>
			<ul>
				<li><a class="menun" onmouseover="move(0);" href="index.php">Início</a></li>
				<li><a class="menun" onmouseover="move(1);" href="#">Mundo</a></li>
				<li><a class="menun" onmouseover="move(2);" href="#">Ciência</a></li>
				<li><a class="menun" onmouseover="move(3);" href="#">Tecnologia</a></li>
				<li><a class="menun" onmouseover="move(4);" href="#">Arte</a></li>
				<li><a class="menun" onmouseover="move(5);" href="#">Entretenimento</a></li>
				<li><a class="menun" onmouseover="move(6);" href="#">Política</a></li>
			</ul>
		</div>
	</div>
</header>