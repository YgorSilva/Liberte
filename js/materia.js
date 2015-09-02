$(function(){
	var matId = window.location.href.split('matId=')[1];
	$('.btnAprovar').prop({'isUndoing': false, 'isPositive': true})
	$('.btnAprovado').prop({'isUndoing': true, 'isPositive': true});
	$('.btnDesaprovar').prop({'isUndoing': false, 'isPositive': false});
	$('.btnDesaprovado').prop({'isUndoing': true, 'isPositive': false});
	$('.btnVote').each(function(){
		$(this).click(function(){
			setVote(this, matId, $(this).prop('isPositive'), $(this).prop('isUndoing'));
		});
	});
	$('#cover').error(function(){
		$(this).attr('src', 'images/capa_default.png');
	});
	authorNameEffect('body');
	$('div', '.authorDiv', 'body').hide();
});

var authorNameEffect = function(parentDiv){
	$('.authorDiv', parentDiv).mouseenter(function(){
		$(this).width(30+$('div', this).width()+6)
		.css('transition', '0.5s');
		$('div', this).css('transition', '1s').show();
	})
	.mouseleave(function(){
		$(this).width(30);
		$('div', this).hide();
	});
}

var setComment = function(setter, replyOf){
	var matId = window.location.href.split('matId=')[1];
	replyOf = replyOf || 0;
	parentDiv = $(setter).parents()[2];
	var comment = $('.commentInput', parentDiv).val();
	$.ajax({
		url: 'PHP/setComments.php',
		method: 'POST',
		data: {'id': matId, 'content': comment, 'replyOf': replyOf}
	})
	.success(function(xml){
		if(xml){
			var div = constructCommentBox(xml);
			
			if(!replyOf){
				var id = $(xml).attr('id');
				var replyInput = $('<input/>').attr('placeholder', 'Comente sobre isso!')
				.addClass('commentInput').addClass('rpComment');
				var replyBtn = $('<button/>').text('Comentar').addClass('rpComment')
				.attr('onclick', 'setComment(this, '+id+')');
				var replyDiv = $('<div/>').append(replyInput, replyBtn);

				var showInputBtn = $('<button/>').text('Responder').addClass('rpComment')
				.click(function(){
					$(this).hide();
					$(replyDiv).show();
				});

				var repliesDiv = $('<div/>').addClass('comments');
				console.log($('.interactDiv', div));
				$('.interactDiv', div).append(showInputBtn, replyDiv);
				$(replyDiv).hide();
				$(div).append(repliesDiv);
			}
			else $(div).addClass('replyComment');

			commentInput = $('.commentInput', parentDiv)[0];
			comments = $('.comments', parentDiv)[0];
			$(commentInput).val('');
			$(comments).prepend(div);

		}else{
			$('.commentInput', parentDiv).val('');
			$('.commentInput', parentDiv).attr('placeholder' ,'Falha ao enviar comentário.');
		}
	});
}

var constructCommentBox = function(elmt, isReply){
	var r = isReply? 'reply_' : '';
	var id = $(elmt).attr('id');
	var div = $('<div/>');
	if(isReply) $(div).addClass('replyComment')

	var authorName = $(r+'author', elmt).text();
	var authorEmail = $(r+'author', elmt).attr('email');
	var authorLink = $('<a/>').attr('href' ,'user.php?e='+authorEmail).append(
		$('<div/>').addClass('authorDiv').append(
			$('<img/>')
			.attr({'src': 'layoutImages/PHFeh.jpg', 
					'width': '30px', 'height': '30px'}).addClass('authorImg'),
			$('<div/>').text($(r+'author', elmt).text()).hide()
		)
	);
	
	var content = $('<p/>').text($(r+'content', elmt).text()).addClass('commentContent');
	
	var aproved = parseInt($(elmt).find(r+'positive').attr('already'));
	var aproveDiv = $('<div/>').addClass('voteDiv').addClass((aproved?'aproved':'aprove')+'Div').append(
		$('<button/>').addClass('btnVote').addClass('btn'+(aproved?'Aprovado':'Aprovar'))
		.attr('onclick', 'setCommentVote(1, this, '+aproved+')'),
		$('<span/>').text($(elmt).find(r+'positive').text()).addClass('n').addClass('Aprovar')
	);

	var desaproved = parseInt($(elmt).find(r+'negative').attr('already'));
	var desaproveDiv = $('<div/>').addClass('voteDiv').addClass((desaproved?'desaproved':'desaprove')+'Div').append(
		$('<button/>').addClass('btnVote').addClass('btn'+(desaproved?'Desaprovado':'Desaprovar'))
		.attr('onclick', 'setCommentVote(0, this, '+desaproved+')'),
		$('<span/>').text($(elmt).find(r+'negative').text()).addClass('n').addClass('Desaprovar')					
	);

	var date = $('<h5/>').text($(r+'date', elmt).text()).addClass('commentDate');
	var interactDiv = $('<div/>').addClass('interactDiv').append(aproveDiv, desaproveDiv, date);
	
	$(div).append(authorLink, content, interactDiv)
	.prop('commentId', id).addClass('commentBox');
	authorNameEffect(div);

	return div;
}

var getComments = function(replyOf, setter){
	var replyOf = replyOf || 0;
	var targetDiv = setter? $('.comments', $(setter).parents[0]) : 0;
	var matId = window.location.href.split('matId=')[1];
	$.ajax({
		url: 'PHP/getComments.php',
		method: 'POST',
		data: {'matId': matId, 'replyOf' : replyOf}
	})
	.success(function(xml){	
		var comments = $(xml).find('comment');
		$(comments).each(function(){	
			var div = constructCommentBox(this);

			if(!targetDiv){
				var replyInput = $('<input/>').attr({'placeholder': 'Comente sobre isso!', 'type': 'text'}).addClass('commentInput').addClass('rpComment');
				var replyBtn = $('<button/>').text('Comentar').addClass('rpComment')
				.attr('onclick', 'setComment(this, '+$(div).prop('commentId')+')');
				var replyDiv = $('<div/>').append(replyInput, replyBtn);

				var showInputBtn = $('<button/>').text('Responder').addClass('rpComment')
				.click(function(){
					$(this).hide();
					$(replyDiv).show();
				});

				var repliesDiv = $('<div/>').addClass('comments');

				var replies = $(this).find('replies');
				$(replies).find('reply').each(function(){
					var rDiv = constructCommentBox(this, 1);
					$(repliesDiv).append(rDiv);
				});
				$('.interactDiv', div).append(showInputBtn, replyDiv);
				$(div).append(repliesDiv);
				$(replyDiv).hide();
			}
			$(targetDiv? targetDiv:'#comments').append(div);

		})
	});
}

var setCommentVote = function(isPositive, btn, undo){
	var undo = undo || 0;
	var div = $(btn).parents()[2];
	var commentId = $(div).prop('commentId');

	$.ajax({
		url: 'PHP/setCommentVote.php',
		method: 'POST',
		data: {'isPositive': isPositive, 'commentId': commentId, 'undo': undo}
	})
	.success(function(xml){
		if(xml){
			var count = $(btn).siblings()[0];
			$(count).text(parseInt($(count).text())+(undo?-1:1));
			var btnClass = undo?(isPositive?'Aprovar':'Desaprovar'):(isPositive?'Aprovado':'Desaprovado');
			$(btn).attr('class', 'btnVote btn'+btnClass)
			.attr('onclick', 'setCommentVote('+isPositive+', this, '+((undo-1)*-1)+')');
			$($(btn).parents()[0]).attr('class', 'voteDiv '+(undo?(isPositive?'aprove':'desaprove'):(isPositive?'aproved':'desaproved'))+'Div')
		} 
	});
}

var setDenuncia = function(btn){
	var matId = window.location.href.split('matId=')[1];
	$.ajax({
		url: 'PHP/setDenuncia.php',
		method: 'POST',
		data: {'matId': matId}
	})
	.success(function(xml){
		if(xml){
			$(btn).text('Denunciado');
		}
		console.log(xml);
	})
}

var title = $('h1')[0];
$('title', 'head').text($(title).text()+' | Liberte');

getComments();