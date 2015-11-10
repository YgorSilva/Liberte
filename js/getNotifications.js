$(function(){
	var dataParser = function(sqlDateStr){
		sqlDateStr = sqlDateStr.replace(/:| /g,"-");
		var YMDhms = sqlDateStr.split("-");
		var date = new Date(YMDhms[0], YMDhms[1], YMDhms[2], YMDhms[3], YMDhms[4], YMDhms[5], 0);
		return date;
	}
	$.ajax({
		url: 'PHP/getNotifications.php',
		method: 'POST',
		data: {x: 0}
	})
	.success(function(xml){
		var notifs = $(xml).find('notification');
		for(var i = 0; i < notifs.length; i++){
			for(var j = 0; j < notifs.length; j++){
				if(dataParser($('date', notifs[i]).text()) > dataParser($('date', notifs[j]).text())){
					change = notifs[i];
					notifs[i] = notifs[j];
					notifs[j] = change;
				}
			}
		}

		$(notifs).each(function(){
			if($(this).attr('type') == 'aprove' || $(this).attr('type') == 'desaprove'){	
				var userid = $('sender', this).attr('id');
				var name = $('<a/>').attr('href', 'user.php?id='+userid).text($('sender', this).text());
				
				var matId = $('materia', this).attr('id');
				var materia = $('<a/>').attr('href', 'materia.php?matId='+matId).text($('materia', this).text());
				
				var action = $(this).attr('type') == 'aprove'?'aprovou':'desaprovou';
				var text = $('<p/>').append(name, ' ', action+' sua materia: ', materia);
			}
			else if($(this).attr('type') == 'subscription'){	
				var userid = $('subscriber', this).attr('id');
				var name = $('<a/>').attr('href', 'user.php?id='+userid).text($('subscriber', this).text());
				
				var text = $('<p/>').append(name, ' assinou você');
			}
			else if($(this).attr('type') == 'comment'){
				var userid = $('sender', this).attr('id');
				var name = $('<a/>').attr('href', 'user.php?id='+userid).text($('sender', this).text());
				
				var matId = $('materia', this).attr('id');
				var materia = $('<a/>').attr('href', 'materia.php?matId='+matId).text($('materia', this).text());
				
				var conteudo =  $('<p/>').text(' '+$('content', this).text());
				var text = $('<p/>').append(name, ' comentou tua matéria ', materia, conteudo);
			}
			else if($(this).attr('type') == 'commentAprove' || $(this).attr('type') == 'commentDesaprove'){
				var userid = $('sender', this).attr('id');
				var name = $('<a/>').attr('href', 'user.php?id='+userid).text($('sender', this).text());
				
				var commentId = $('materia', this).attr('id');
				var comment = $('<a/>').attr('href', 'materia.php?matId='+commentId).text($('materia', this).text());
				
				var action = $(this).attr('type') == 'commentAprove'?'aprovou':'desaprovou';
				var text = $('<p/>').append(name, ' '+action+' teu comentário: ', comment);	
			}
			else if($(this).attr('type') == 'reply'){
				var userid = $('sender', this).attr('id');
				var name = $('<a/>').attr('href', 'user.php?id='+userid).text($('sender', this).text());
				
				var matId = $('comment', this).attr('matId');
				var materia = $('<a/>').attr('href', 'materia.php?matId='+matId).text($('comment', this).text());
				
				var conteudo =  $('<p/>').text(' '+$('content', this).text());
				var text = $('<p/>').append(name, ' respondeu teu comentário: ', materia, conteudo);
			}
			else if($(this).attr('type') == 'denuncia'){
				var matId = $('materia', this).attr('id');
				var materia = $('<a/>').attr('href', 'materia.php?matId='+matId).text($('materia', this).text());
				
				var btnAccept = $('<button/>').text('Aceitar').attr('onclick', 'setJurado(this, 1)');
				var btnDecline = $('<button/>').text('Rejeitar').attr('onclick', 'setJurado(this, 0)');

				var p = $('<p/>').append('Você foi selecionado pra julgar a máteria: ', materia);
				var text = $('<div/>').append(p, btnAccept, btnDecline)
				.prop('denuncia', $('denuncia', this).text()).prop('matId', matId);
			}
			var date = $('<h5/>').text($('date', this).text()).addClass('date');
			var div = $('<div/>').append(text, date).addClass('notificationBox');
			if(!parseInt($(this).attr('visualized'))) $(div).css('background', 'rgba(100, 100, 100, 0.5)');
			$('.notifContent').append(div);
		})
	})
})

var setJurado = function(btn, answer){
	var div = $(btn).parents()[0];
	var denuncia = $(div).prop('denuncia');
	var matId = $(div).prop('matId');
	$.ajax({
		url: 'PHP/setJurado.php',
		method: 'POST',
		data: {'denuncia': denuncia, 'answer': answer, 'matId': matId}
	})
	.success(function(xml){
		if(xml){
			console.log(xml);
			if(answer) window.location.assign('materia.php?matId='+matId);
			else $(div).remove();
		}
	})
}