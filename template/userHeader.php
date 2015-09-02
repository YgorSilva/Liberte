<link rel="stylesheet" type="text/css" href="style/userHeader.css"/>
<div id='perfilDiv'>
	<center><a href='user.php?e="<?=$userData['email']?>"'><img class='perfilImg' src="layoutImages/PHFeh.jpg"></a></center>
	<a class='username' href='user.php?e="<?=$userData['email']?>"'><?=$userData['nome'].' '.$userData['sobrenome']?></a>
	<a class='logout' href='#'>Sair</a>
</div>