function insert(isPositive, matId){
	var xmlhttp = new XMLHttpRequest();

	xmlhttp.onreadystatechange = function(){
		if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
			if(xmlhttp.responseText) aprovar.innerHTML = xmlhttp.responseText;
		}
	}
	xmlhttp.open("GET", 'PHP/aprovar.php?matId='+matId+'&type='+isPositive, true);
	xmlhttp.send();
}