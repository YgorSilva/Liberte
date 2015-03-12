<html>
	<head>
		<title>Cadastrar - Liberté</title>
		<meta charset="utf-8"/>
		<link rel="stylesheet" type="text/css" href="style/index.css"/>
		<link rel="stylesheet" type="text/css" href="style/cadastro.css"/>
	</head>
	<body>
		<?php include "template/header.php"; ?>
		<div id="inner-content">
			<div class="form-content header">
				<h2>Cadastro</h2>
			</div>
			<div class="form-content">
				<form method="POST" action="liberte.php?cadastro=true" enctype='multipart/form-data'>
					<ul>
						<li>
							<div>
								<label for="foto">Foto de perfil:</label>
								<input type="file" accept="image/*" name="perfil_img"/>
							</div>
							<div class="clear"></div>
						</li>
						<li>
							<div>
								<label for="email">E-mail:</label>
								<input type="text" size="20" maxlength="30" name="email"/> 
							</div>
							<div class="clear"></div>
						</li>
						<li>
							<div>
								<label for="senha">Senha:</label>
								<input type="password" size="16" maxlength="16" name="senha"/> 
							</div>
							<div>	
								<label for="conf-senha">Confirma senha:</label>
								<input type="password" size="16" maxlength="16" name="conf-senha"/>
							</div>
							<div class="clear"></div>
						</li>
						<li>
							<div>
								<label for="nome">Nome:</label>
								<input type="text" size="20" maxlength="20" name="nome"/> 
							</div>
							<div>
								<label for="sobrenome">Sobrenome:</label>
								<input type="text" size="30" maxlength="30" name="sobrenome"/>
							</div>
							<div class="clear"></div>
						</li>
						<li>
							<label>Sexo:</label>
							<div>
								<label for="masc">
									<input type="radio" name="sexo" id="masc" value="m"/>
									Masculino
								</label>
							</div>
							<div>
								<label for="fem">
									<input type="radio" name="sexo" id="fem" value="f"/>
									Feminino
								</label>
							</div>
							<div class="clear"></div>
						</li>
						<li>
							<div>
								<label for="dt_nasc">Data de nascimento:</label>
								<input type="text" size="11" maxlength="12" placeholder="DD/MM/AAAA" name="dt_nasc"/>
							</div>
							<div class="clear"></div>
						</li>
						<li>
							<div>
								<label for="cidade">Cidade:</label>
								<input type="text" size="20" maxlength="40" name="cidade"/>
							</div>
							<div>
								<label for="estado">Estado:</label>
								<select name="estado">
									<option>Selecionar estado</option>
								    <option value="AC">Acre</option>
								    <option value="AL">Alagoas</option>
								    <option value="AM">Amazonas</option>
								    <option value="AP">Amapá</option>
								    <option value="BA">Bahia</option>
								    <option value="CE">Ceará</option>
								    <option value="DF">Distrito Federal</option>
								    <option value="ES">Espirito Santo</option>
								    <option value="GO">Goiás</option>
								    <option value="MA">Maranhão</option>
								    <option value="MG">Minas Gerais</option>
								    <option value="MS">Mato Grosso do Sul</option>
								    <option value="MT">Mato Grosso</option>
								    <option value="PA">Pará</option>
								    <option value="PB">Paraíba</option>
								    <option value="PE">Pernambuco</option>
								    <option value="PI">Piauí</option>
								    <option value="PR">Paraná</option>
								    <option value="RJ">Rio de Janeiro</option>
								    <option value="RN">Rio Grande do Norte</option>
								    <option value="RO">Rondônia</option>
								    <option value="RR">Roraima</option>
								    <option value="RS">Rio Grande do Sul</option>
								    <option value="SC">Santa Catarina</option>
								    <option value="SE">Sergipe</option>
								    <option value="SP">São Paulo</option>
								    <option value="TO">Tocantins</option>
								</select>
							</div>
							<div class="clear"></div>
						</li>
					</ul>
					<input type="submit" value="Cadastrar-se">
				</form>
			</div>
		</div>
		<footer>
			<div class="content">
				<center><img src="images\logo3.png" width="800px" height="150px" /></center>
			</div>
			<div class="copy">
				<div class="content">
					Copyright © Liberté 2014. Todos os direitos reservados.
				</div>
			</div>
		</footer>
		<script src="js/slider.js" type="text/javascript"></script>
		<script src="js/menu-bar.js" type="text/javascript"></script>
	</body>
</html>