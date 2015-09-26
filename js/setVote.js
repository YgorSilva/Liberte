var setVote = function(btn, matId, isPositive, isUndoing){
	var isPositive = isPositive === undefined? 1 : isPositive;
	var isUndoing = isUndoing || 0;
	var parentDiv = $(btn).parents()[0]
	$.ajax({
		url: 'PHP/setVote.php',
		method: 'POST',
		data: {'matId': matId, 'isPositive': isPositive, 'isUndoing': isUndoing}
	})
	.success(function(rs){
		if(rs){
			var type = (isPositive?'Aprovar':'Desaprovar');
			var action = (isUndoing?-1:1)
			
			$('.n'+type, parentDiv).text(parseInt($('.n'+type, parentDiv).text())+action);
			var prefix = (isPositive?'Aprova':'Desaprova');
			var sufix = (isUndoing?'r':'do');
			$(btn).attr('class', 'btnVote btn'+prefix+sufix)
			.prop('isUndoing', !$(btn).prop('isUndoing'))
			.attr('title', prefix+sufix);
		}
	})
}