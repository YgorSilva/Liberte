<header>
	<link rel="stylesheet" type="text/css" href="style/index.css"/>
	<div id="top">
		<div class="content">
			<div class="logo" style="background: url('images/logo.jpg'); background-size: 100% 100%;">
			</div>
			<div class="login">
				<form method="POST" action="login.php">
					<input id="email" type="text" size="20" placeholder="E-mail" name="email"></br>
					<input id="pw" type="password" size="20" placeholder="Senha" name="senha"></br>
					<a href="cadastro.php"><input type="button" class="login_btn" value="Cadastrar-se"/></a>
					<input type="button" onclick="login();" class="login_btn" value="Entrar"></br>
					<span id='login_msg' style="color: red; font-size: 10pt"></span>
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
	<script src="js/login.js" type="text/javascript"></script>
</header>