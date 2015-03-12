function move(elmt){
	var left = 0;
	var bar = document.getElementById("bar");
	bar.style.position = "relative";
	bar.style.transition = "1.5s";
	menus = document.getElementsByClassName("menun");
	for(var k = 0; k < elmt; k++){
		left += menus[k].clientWidth - 0.1;
	} 
	bar.style.left = left;
	bar.style.width = menus[elmt].clientWidth;
}

move(0);