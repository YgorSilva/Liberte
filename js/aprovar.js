function insert(isPositive, matId, user){
	var xmlhttp = new XMLHttpRequest();

	xmlhttp.onreadystatechange = function(){
		if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
			if(xmlhttp.responseText && isPositive){
				aprovar.innerHTML = ' '+(parseInt(aprovar.innerHTML)+1);
				btnAprovar.innerHTML = 'Aprovado';	
				btnAprovar.onclick = function(){undo(isPositive, matId, user);};
			} 
			else if(xmlhttp.responseText){
				desaprovar.innerHTML = ' '+(parseInt(desaprovar.innerHTML)+1);
				btnDesaprovar.innerHTML = 'Desaprovado';
				btnDesaprovar.onclick = function(){undo(isPositive, matId, user);};
			} 
		}
	}
	xmlhttp.open("GET", 'PHP/aprovar.php?matId='+matId+'&user='+user+'&type='+isPositive+'&function=insert', true);
	xmlhttp.send();
}

function undo(isPositive, matId, user){
	var xmlhttp = new XMLHttpRequest();

	xmlhttp.onreadystatechange = function(){
		if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
			if(xmlhttp.responseText && isPositive){ 
				aprovar.innerHTML = ' '+(parseInt(aprovar.innerHTML)-1);
				btnAprovar.innerHTML = 'Aprovar';
				btnAprovar.onclick = function(){insert(isPositive, matId, user);};
			}
			else if(xmlhttp.responseText){
				desaprovar.innerHTML = ' '+(parseInt(desaprovar.innerHTML)-1);
				btnDesaprovar.innerHTML = 'Desaprovar';
				btnDesaprovar.onclick = function(){insert(isPositive, matId, user);};
			}
		}
	}
	xmlhttp.open("GET", 'PHP/aprovar.php?matId='+matId+'&user='+user+'&function=undo', true);
	xmlhttp.send();	
}