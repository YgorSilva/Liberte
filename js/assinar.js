function follow(subscriber, signed, isSigning){
	var xmlhttp = new XMLHttpRequest();

	xmlhttp.onreadystatechange = function(){
		if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
			if(xmlhttp.responseText && isPositive){
				btnAssinar.innerHTML='Assinado';
				btnAssinar.onclick = function(){follow(subscriber, signed, 0);};
			} 
			else if(xmlhttp.responseText){
				btnAssinar.innerHTML='Assinar';
				btnAssinar.onclick = function(){follow(subscriber, signed, 1);};
			} 
		}
	}
	xmlhttp.open("GET", 'PHP/assinar.php?subscriber='+subscriber+'&signed='+signed+'&isSigning='+isSigning, true);
	xmlhttp.send();
}