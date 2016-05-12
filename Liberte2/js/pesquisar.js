$(function(){
	$('#searchBtn').click(function(){
		$('.searchBar').css({'width': '220px', 'padding': '5px 5px 5px 10px', 'border-color': '#777'});
		$('#searchBtn').css({'border-left': 0, 'border-radius': '0 20px 20px 0'});
		$('.searchBar').focus();
	});

	var enterTrigger = function(evt){
		if(evt.keyCode == 13 && $('.searchBar').val().length > 0){
			if(getDocumentName() != 'pesquisa.php')
				window.location.href = 'pesquisa.php?s='+encodeURI(encodeURIComponent($('.searchBar').val()));
			else{
				window.location.href = 'pesquisa.php?s='+encodeURI(encodeURIComponent($('.searchBar').val()));
				window.location.reload();
			}
		}
	},
	getDocumentName = function(){
		var doc = window.location.pathname;
		return doc;
	};
	
	$(searchBtn).click(function(){
		if($('.searchBar').val().length && $('.searchBar').width() > 0){
			if(getDocumentName() != 'Liberte/pesquisa.php')
				window.location.pathname = 'pesquisa.php?s='+encodeURI(encodeURIComponent($('.searchBar').val()));
			else{
				window.location.pathname = 'pesquisa.php?s='+encodeURI(encodeURIComponent($('.searchBar').val()));
				window.location.reload();
			}
		}
	});

	$('.searchBar').focus(function(){
		document.addEventListener('keydown', enterTrigger);
	})
	.blur(function(){
		document.removeEventListener('keydown', enterTrigger);
		$('.searchBar').css({'width': '0', 'padding': '0', 'border-color': '#efefef'});
		setTimeout(function(){
			$('#searchBtn').css({'border-left': '1px solid #777', 'border-radius': '20px'});
		},250);
	});
});