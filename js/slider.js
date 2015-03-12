var atual, i = 0, player;
var img = [img_1.src, img_2.src, img_3.src];
var href = [link_1.href, link_2.href, link_3.href];
document.getElementById("img_slider").style.transition = "1.5s";

function slider(){
	document.getElementById("img_slider").style.background = 'url('+img[i%img.length]+')';
	slide_link.href = href[i%img.length];
	console.log('url('+href[i%img.length]+')');
	document.getElementById("img_slider").style.backgroundRepeat = "no-repeat";
	document.getElementById("img_slider").style.backgroundSize = "100% 100%";
	indicate();
	i++;
}

function indicate(){
	var slideBar = document.getElementById("slide_bar");
	var top = (i%img.length)*100;
	slideBar.style.top = top;
	divs = document.getElementsByClassName("img_list");
	for(var j = 0; j < divs.length; j++){
		divs[j].style.background = "#df0010";
	}
	divs = document.getElementsByClassName("img_list "+((i%img.length)+1));	
	divs[0].style.background = "#fd1020";
}

function stoper(x){
	clearInterval(player);
	i = x;
	slider();
}

slider();

var autop = function (){ player = setInterval(slider, 3000);}
autop();