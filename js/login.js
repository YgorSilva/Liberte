function login(){
	var xmlhttp = new XMLHttpRequest();

	xmlhttp.onreadystatechange = function(){
		if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
			if(xmlhttp.responseText == 1) login_msg.innerHTML = 'Senha inválida.';
			else if(xmlhttp.responseText == 2) login_msg.innerHTML = 'Usuário não cadastrado.';
			else document.body.innerHTML += xmlhttp.responseText;
		}
	}

	xmlhttp.open('GET', 'PHP/login.php?email='+email.value+'&pw='+pw.value, true);
	xmlhttp.send();
}