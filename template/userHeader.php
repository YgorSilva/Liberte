<?php 
	include '/PHPClasses/userClass.php';
	$user = unserialize($_SESSION['user']);
	$userData = $user->getData();
?>
<link rel="stylesheet" type="text/css" href="style/userHeader.css"/>
<div id='perfilDiv'>
	<center><a href='user.php?e=<?=$userData['email']?>'><img class='perfilImg' src="images/<?=$userData['imgPerfil']?>"></a></center>
	<a class='username' href='user.php?e=<?=$userData['email']?>'><?=$userData['nome'].' '.$userData['sobrenome']?></a>
	<a class='logout' href='#'>Sair</a>
</div>
<script type="text/javascript">
	$(function(){
		$('.logout').click(function(){
			$.ajax({
				url: 'PHP/logout.php',
			})
			.success(function(){
				if(window.location.pathname == '/Liberte/index.php') window.location.reload();
				else window.location = 'index.php';
			})
		});
	})
</script>