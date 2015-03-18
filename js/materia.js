var idN = 3, func;

function editH(elmt){
	if(!(elmt.already)){
		var cont = elmt.innerHTML;
		var input = document.createElement('input');
		var btn = document.createElement('input');
		elmt.innerHTML = "";
		input.type = 'text';
		input.maxLength = '140';
		input.size = 60;
		input.value = cont;
		input.style.textAlign = 'center';
		btn.type = "button";
		btn.value = "Pronto";
		btn.style.fontSize = "14px";
		btn.style.fontWeight = "initial";
		btn.onclick = function(){changeValue(elmt);};
		elmt.appendChild(input);
		elmt.appendChild(btn); 
		elmt.already = true;
	}
}

function changeValue(div){
	var value = div.children[0].value;
	div.innerHTML = value;
	setTimeout(function(){div.already = false;}, 500);
	if(value == ""){
		div.innerHTML = "Campo obrigatório";
	}
}

function enviar(){
	var divs = document.getElementsByClassName('materia'), ps = new Array();
	var input = document.createElement("input");
	input.type = "hidden";
	input.name = "titulo";
	input.value = divs[0].innerHTML;
	document.getElementById("materia-form").appendChild(input);
	input.type = "hidden";
	input.name = "subtitulo";
	input.value = divs[1].innerHTML;
	document.getElementById("materia-form").appendChild(input);
	var input = document.createElement("input");
	input.type = "submit";
	document.getElementById("materia-form").appendChild(input);
	input.click();
}
