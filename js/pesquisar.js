$(function(){
	var enterTrigger = function(evt){
		if(evt.keyCode == 13 && $('.searchBar').val().length > 0)
		window.location.href = 'pesquisa.php?s='+$('.searchBar').val().split(' ').join('%20');;
	}
	
	$(searchBtn).click(function(){
		if($('.searchBar').val().length > 0)
		window.location.href = 'pesquisa.php?s='+$('.searchBar').val().split(' ').join('%20');
	});

	$('.searchBar').focus(function(){
		document.addEventListener('keydown', enterTrigger);
	})
	.blur(function(){
		document.removeEventListener('keydown', enterTrigger);
	});
});