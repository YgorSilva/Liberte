var setVote = function(btn, matId, isPositive, isUndoing, isUpdating){
	var isPositive = isPositive === undefined? 1 : isPositive,
	isUndoing = isUndoing || 0,
	parentDiv = $(btn).parents()[0],
	siblingDiv = $(parentDiv).siblings()[2];

	$.ajax({
		url: 'PHP/setVote.php',
		method: 'POST',
		data: {'matId': matId, 'isPositive': isPositive, 'isUndoing': isUndoing, 'isUpdating': isUpdating}
	})
	.success(function(rs){
		console.log($(btn).prop('isUpdating'));
		if(rs){
			var type = (isPositive?'Aprovar':'Desaprovar'),
			siblingType = (!isPositive?'Aprovar':'Desaprovar'),
			action = (isUndoing?-1:1),
			sibling = $('button', $(siblingDiv));

			$('.n'+type, parentDiv).text(parseInt($('.n'+type, parentDiv).text())+action);
			var prefix = (isPositive?'Aprova':'Desaprova');
			var siblingPrefix = (!isPositive?'Aprova':'Desaprova');

			var sufix = (isUndoing?'r':'do');
			$(btn).attr('class', 'btn'+prefix+sufix)
			.prop('isUndoing', !$(btn).prop('isUndoing'))
			.attr('title', prefix+sufix).prop('isUpdating', 0);

			if(isUndoing) $(sibling).prop('isUpdating', 0);
			else if(isUpdating){
				$(sibling).attr('class', 'btn'+siblingPrefix+'r')
				.prop({'isUndoing': 0, 'isUpdating': 1})
				.attr('title', prefix+'r');
				$('.n'+siblingType, siblingDiv).text(parseInt($('.n'+siblingType, siblingDiv).text())-1);
			}
			else $(sibling).prop('isUpdating', 1);
		}
	})
}