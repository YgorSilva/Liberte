function insert(isPositive, matId){
	var xmlhttp = new XMLHttpRequest();

	xmlhttp.onreadystatechange = function(){
		if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
			if(xmlhttp.responseText && isPositive) aprovar.innerHTML = ' '+(parseInt(aprovar.innerHTML)+1);
			else if(xmlhttp.responseText) desaprovar.innerHTML = ' '+(parseInt(desaprovar.innerHTML)+1);
		}
	}
	xmlhttp.open("GET", 'PHP/aprovar.php?matId='+matId+'&type='+isPositive, true);
	xmlhttp.send();
}