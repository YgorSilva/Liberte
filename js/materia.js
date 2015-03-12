var idN = 3, func;

function editH(elmt){
	if(!(elmt.already)){
		var cont = elmt.innerHTML;
		elmt.innerHTML = "<input type='text' maxlenght='140' size='20' value='"+cont+"'></input><button onclick='changeValue("+elmt.id+")'>Pronto</button>";
		elmt.already = true;
	}
}

function editP(elmt){
	if(!(elmt.already)){
		var cont = elmt.innerHTML;
		elmt.innerHTML = "<textarea rows='10' cols='80'>"+cont+"</textarea><button onclick='changeValue("+elmt.id+")'>Pronto</button><button onclick='remover("+elmt.id+");'>Remover</button>";
		elmt.already = true;
	}
}

function remover(div){
	div.parentNode.removeChild(div);
}

function changeValue(div){
	var value = div.children[0].value;
	div.innerHTML = value;
	setTimeout(function(){div.already = false;}, 500);
	if(value == ""){
		if(div.className != "materia titulo" && div.className != "materia subtitulo"){
			remover(div);
		}
		else{
			div.innerHTML = "Campo obrigatório";
		}
	}
}

function addP(){
	var div = document.createElement("div");
	div.className = "materia paragrafo";
	div.id="elmt"+idN;
	idN++;
	div.already = false;
	div.onclick = function onclick(event){editP(div);};
	div.innerHTML = "Parágrafo";
	document.getElementById("elmt-content").appendChild(div);
}

function enviar(){
	var divs = document.getElementsByClassName('materia'), ps = new Array();
	ps[0] = divs[0].innerHTML;
	ps[1] = divs[1].innerHTML;
	for(var i = 2; i < divs.length; i++){
		ps.push("<p>"+divs[i].innerHTML+"</p>");
	}
	for(var i = 2; i < ps.length; i++){
		if(ps[i].length > 240){
			var tmp = ps.splice(i+1);
			var p = ps[ps.length-1];
			var pn = p.substr(240, p.length-240);
			p = p.substr(0, 240);
			ps[i] = p;
			ps.push(pn);
			for(var j = 0; j < tmp.length; j++){
				ps.push(tmp[j]);
			}
		}
	}
	for(var i = 0; i < ps.length; i++){
		var input = document.createElement("input");
		input.type = "hidden";
		input.name = "elmt["+i+"]";
		input.value = ps[i];
		document.getElementById("materia-form").appendChild(input);
	}
	var input = document.createElement("input");
	input.type = "submit";
	document.getElementById("materia-form").appendChild(input);
	input.click();
}
