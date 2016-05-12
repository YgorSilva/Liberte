var assinar = function(signed){
	var user = window.location.search.split('e=')[1], 
	nspan = $('span.userData')[1];
	$.ajax({
		url: '/PHP/assinar.php', 
		method: 'POST',
		data: {'signed': signed, 'user': user}
	})
	.success(function(rs){
		$(".signingBtn").text(signed?'Assinar':'Assinado')
		.attr({'class': 'signingBtn '+(signed?'':'already'),
			'onclick': 'assinar('+(!signed)+');'
		});
		$(nspan).text(parseInt($(nspan).text())+(signed?-1:1));
	})	
}