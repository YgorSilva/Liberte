var set  = function(){
	var errors = getErrors(), email = $('input[name="email"]').val(), img = $('#perfilImg').attr('src'), 
	senha = $('input[name="senha"').val(), nome = $('input[name="nome"]').val(),
	sNome = $('input[name="sobrenome"]').val(), genero = $('input[name="genero"]:checked').val(),
	dia = $('select[name="dia"]').val(), mes = $('select[name="mes"]').val(), ano = $('select[name="ano"]').val();
	if(!errors.length){
		$.ajax({
			url: '/PHP/setUser.php',
			method: 'POST',
			data: {'email': email, 'senha': senha, 'nome': nome, 'sNome': sNome, 
				'genero': genero, 'dia': dia, 'mes': mes, 'ano': ano, 'perfilImg': img
			}
		})
		.success(function(rs){
			window.location.pathname = 'index.php';
		});
	}
},
getErrors = function(){
	var illegal = ['"', "'", '/', ' '], email = $('input[name="email"]'), 
	senha = $('input[name="senha"'), confSenha = $('input[name="conf-senha"'), nome = $('input[name="nome"]'),
	sNome = $('input[name="sobrenome"]'), gender = $('input[name="genero"]:checked'), err = [],
	errMss = [[$('.errMss')[0], 'Email inválido', 'Campo obrigatório'],
		[$('.errMss')[1], 'Sua senha pode incluir apenas caracteres alfanuméricos, maiúsculos e minúsculos',
		'Campo obrigatório', 'Senhas não correspondem'],
		[$('.errMss')[2], 'Seu nome pode conter apenas letras, maiúsculas e minúsculas', 'Campo obrigatório'],
		[$('.errMss')[3], 'Seu sobrenome pode conter apenas letras, maiúsculas e minúsculas', 'Campo obrigatório'],
		[$('.errMss')[4], null, 'Campo obrigatório']],
	fields = [email, senha, nome, sNome, gender];	
	for (var i = 0; i < illegal.length; i++){
		if($(senha).val().search(illegal[i])+1) err[err.length] = [1,1];
		if($(email).val().search(illegal[i])+1) err[err.length] = [0,1];
		if($(nome).val().search(illegal[i])+1 && i != 3) err[err.length] = [2,1];
		if($(sNome).val().search(illegal[i])+1 && i != 3) err[err.length] = [3,1];
	};

	if($(senha).val() !== $(confSenha).val()) err[err.length] = [1, 3];
	for (var i = 0; i < fields.length; i++) {
		if($(fields[i]).val() == undefined || !$(fields[i]).val().length) err[err.length] = [i, 2];
		console.log(err[err.length-1]);
	};
	for(i = 0; i < $('.errMss').length; i++){
		var p = $('.errMss')[i];
		$(p).text(' ');
	}
	
	for(i = 0; i < err.length; i++){
		console.log(err[i]);
		$(errMss[err[i][0]][0]).text(errMss[err[i][0]][err[i][1]]);
	}

	return err.length?true:false;
},
changePerfilImg = function(){
	$('.fileBtn').click()
	.change(function(){
		$('body').append(
			$('<iframe/>')
			.attr({'id': 'coverFrame', 'name': 'coverFrame', 'width': '0', 'height': '0', 'frameborder': '0'})
			.css('display', 'none'));
			$('#img-form').prop('action', 'PHP/setPerfilImg.php').prop('target', 'coverFrame').submit();
			$('#coverFrame').load(getPerfilImg);
	});
},
getPerfilImg = (function(){
	var i = 0;
	var returnedFunction = function(){
		$.ajax({
			url: '/PHP/setPerfilImg.php',
			method: 'GET',
			data: {'getLastImg': '1'}
		})
		.complete(function(img){
			img = img.responseText;
			console.log(img);
			i++;
			if(img !== '' && img){
				$('img').attr('src', img);
				$('#coverFrame').remove();
				$('#img-form').prop('action', false).prop('target', false);
			}
			else if(img == 'teste.jpg'){
				$('#img-form').append(
					$('<span/>').text('Erro ao enviar mensagem').addClass('error')
				);	
			}
			else if(i < 10) var timeout = setTimeout(function(){returnedFunction();}, 500);
			else clearTimeout(timeout);
		});
	};
	return returnedFunction;
})();
$(function(){
	$('button').click(set);
});