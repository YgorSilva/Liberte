<html>
	<head>
		<?php include "PHP/connect.php"; ?>
		<title>Cadastrar - Liberté</title>
		<meta charset="utf-8"/>
		<link rel="stylesheet" type="text/css" href="style/liberte.css"/>
		<link rel="stylesheet" type="text/css" href="style/cadastro.css"/>
		<script src="https://code.jquery.com/jquery-1.11.2.min.js" type="text/javascript"></script>
		<script src="js/cadastro.js" type="text/javascript"></script>
	</head>
	<body>
		<div id="inner-content">
			<div id="form-content">
				<form id='img-form' method="POST" enctype='multipart/form-data'>
					<p style='text-align: center; margin-bottom: 5px;'>Foto de perfil</p>
					<img id='perfilImg' onclick='changePerfilImg()' src='http://localhost/Liberte/images/perfil_img_default.png'/>
					<input class='fileBtn' type='file' name='perfilImg'/>
				</form>
				<input type="email" size="20" maxlength="30" name="email" placeholder="E-mail"/></br> 
				<p class='errMss'></p>
				<input type="password" size="16" maxlength="16" name="senha" placeholder="Senha"/></br> 
				<input type="password" size="16" maxlength="16" name="conf-senha" placeholder="Confirmar senha"/></br>
				<p class='errMss'></p>
				<input type="text" size="20" maxlength="20" name="nome" placeholder="Nome"/></br> 
				<p class='errMss'></p>
				<input type="text" size="30" maxlength="30" name="sobrenome" placeholder="Sobrenome"/></br>
				<p class='errMss'></p>
				<center>Data de nascimento</center>
				<center>
					Dia: 
					<select name='dia'><?php 
						for($i = 1; $i <= 31; $i++){
							echo '<option value="'.$i.'">'.$i.'</option>';
						}
					?></select> 
					Mês: 
					<select name='mes'><?php 
						for($i = 1; $i <= 12; $i++){
							echo '<option vfprintf(handle, format, args)alue="'.$i.'">'.$i.'</option>';
						}
					?></select> 
					Ano: 
					<select name='ano'><?php 
						for($i = 1950; $i <= 2010; $i++){
							echo '<option '.($i == 1998?'selected':'').' value="'.$i.'">'.$i.'</option>';
						}
					?></select>
				</center>
				<label>Sexo:</label>
				<input type="radio" name="genero" id="masc" value="m"/>
				Masculino
				<input type="radio" name="genero" id="fem" value="f"/>
				Feminino</br>
				<p class='errMss'></p>
				<button>Cadastrar-se</button>
			</div>
		</div>
	</body>
</html>