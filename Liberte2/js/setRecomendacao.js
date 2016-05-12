var setRecomendacao = function(btn, matId , isUndoing){
	isUndoing = isUndoing || 0;
	$.ajax({
		url: 'PHP/setRecomendacao.php',
		method: 'POST',
		data: {'matId': matId, 'isUndoing': isUndoing}
	})
	.success(function(rs){
		if(rs){
			var action = isUndoing? -1:1;

			$('.nRecomendar', $(btn).parents()[0])
			.text(parseInt($('.nRecomendar', $(btn).parents()[0]).text())+action);

			$(btn).attr({'class': 'btnRecomenda'+(isUndoing?'r':'do'),
			'title': 'Recomenda'+(isUndoing?'r':'do')})
			.prop('isUndoing', !$(btn).prop('isUndoing'));
		}
	})
}