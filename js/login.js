$(function(){
	var hasError = function(){
		var email = $('input[name="email"]'), senha = $('input[name="senha"]'), err = 0,
		illegal = [' ', '/', '"', "'"];

		for (var i = 0; i < illegal.length; i++) {
			if($(email).val().search(illegal[i])+1 || $(senha).val().search(illegal[i])+1) err++;
		};

		if($(email).val().length == 0 || $(senha).val().length == 0) err++;
		return err;
	};

	document.addEventListener('keydown', function(evt){
		if(evt.keyCode == 13) $('button').click();
	})

	$('button').click(function(){
		if(!hasError()){
			$.ajax({
				url: '/PHP/login.php',
				method: 'POST',
				data: {'email': $('input[name="email"]').val(), 'senha': $('input[name="senha"]').val()}
			})
			.success(function(rs){
				if(rs == 1) window.location.reload();
				else $('.messenge').text('Usuário e/ou senha inválidos');
				console.log(rs);
			});
		}
		else $('.messenge').text('Usuário e/ou senha inválidos');
	})
});