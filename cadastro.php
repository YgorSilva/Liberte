<html>
	<head>
		<title>Cadastrar - Liberté</title>
		<meta charset="utf-8"/>
		<link rel="stylesheet" type="text/css" href="style/index.css"/>
		<link rel="stylesheet" type="text/css" href="style/cadastro.css"/>
	</head>
	<body>
		<header>
			<div id="top">
				<div class="content">
					<div class="logo" style="background: url('images/logo.jpg'); background-size: 100% 100%;">
					</div>
					<div class="login">
						<form method="POST" action="liberte.php?cadastro=true">
							<input type="text" size="20" placeholder="E-mail" name="email"></br>
							<input type="password" size="20" placeholder="Senha" name="senha"></br>
							<a href="cadastro.php"><input type="button" class="login_btn" value="Cadastrar-se"/></a>
							<input type="submit" class="login_btn" value="Entrar">
						</form>
					</div>
				</div>
			</div><!-- end-header -->
			<div id="nav">
				<div class="content">
				<div id="bar"></div>
					<ul>
						<li><a class="menun" onmouseover="move(0);" href="#">Início</a></li>
						<li><a class="menun" onmouseover="move(1);" href="#">Mundo</a></li>
						<li><a class="menun" onmouseover="move(2);" href="#">Ciência</a></li>
						<li><a class="menun" onmouseover="move(3);" href="#">Tecnologia</a></li>
						<li><a class="menun" onmouseover="move(4);" href="#">Arte</a></li>
						<li><a class="menun" onmouseover="move(5);" href="#">Entretenimento</a></li>
						<li><a class="menun" onmouseover="move(6);" href="#">Política</a></li>
					</ul>
				</div>
			</div><!-- end-nav -->
		</header>
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
							<div>
								<label for="cpf">CPF:</label>
								<input type="text" size="11" maxlength="11" placeholder="Apenas números" name="cpf"/>
							</div>
							<div>
								<label for="tel">Telefone:</label>
								<input type="text" size="2" maxlength="2" name="ddd" placeholder="(DDD)"/>
								<input type="text" size="9" maxlength="9" name="tel"/>
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
							<div>
								<label for="cep">CEP:</label>
								<input type="text" size="11" maxlength="8" placeholder="Apenas números" name="cep"/>
							</div>
							<div class="clear"></div>
						</li>
						<li>
							<div>
								<label for="end">Endereço:</label>
								<input type="text" size="20" maxlength="40" name="end"/>
							</div>
							<div>
								<label for="num">Número:</label>
								<input type="text" size="4" maxlength="8" name="num"/>
							</div>
							<div class="clear"></div>
						</li>
						<li>
							<div>
								<label for="comp">Complemento(ex: referência, casa, ap, etc.):</label>
								<input type="text" size="20" maxlength="50" name="comp"/>
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