var editH = function(elmt){
	if(!($(elmt).prop('already'))){
		var input, btn;	
		
		input = $('<input/>').attr({'type': 'text', 'maxLength': '140'}).val($(elmt).text())
		.css('text-align', 'center');
		$(elmt).text('');
		
		btn = $('<input/>').attr({'type':'button', 'value':'pronto'}).addClass('readyBtn')
		.css({'font-size':'14px', 'font-weight':'initial'}).click(function(){changeValue(elmt);});
		
		$(elmt).append(btn, input).prop('already', true);
		$(input).focus();
		$(elmt).hover('background', 'initial');
	}
},

changeCover = function(){
	var files;

	$('.fileBtn').click()
	.change(function(){
		$('body').append(
			$('<iframe/>')
			.attr({'id': 'coverFrame', 'name': 'coverFrame', 'width': '0', 'height': '0', 'frameborder': '0'})
			.css('display', 'none'));
			$('#cover-form').prop('action', 'PHP/setCover.php').prop('target', 'coverFrame').submit();
			$('#coverFrame').load(getCover);
	});
},

changeValue = function(div){
	var children = $(div).children()[1];
	$(div).text($(children).val());
	
	setTimeout(function(){$(div).prop('already', false);}, 500);
	
	if($(children).val() == ''){
		$(div).text('Campo obrigatório');
	}
},

choseTags = function(){
	var div = $('<div/>').attr('id', 'prePublish');
},

enviar = function(rascunho, update, id){
	var divs = $('.materia'), form = $('#materia-form'), r, u, 
	titleInput, subtitleInput, submit, cover, coverName;
	
	id = id || 0;
	
	r = rascunho? '?r=1':'?r=0';
	u = update? '&u=1':'&u=0';
	
	titleInput = $('<input/>').attr({'type': 'hidden', 'name': 'titulo'}).val($(divs[1]).text());
	subtitleInput = $('<input/>').attr({'type': 'hidden', 'name': 'subtitulo'}).val($(divs[2]).text());	
	coverName = $('img', '#cover-form').attr('src').split('/');
	coverName = coverName[coverName.length-1];
	cover = $('<input/>').attr({'type': 'hidden', 'name': 'cover'})
	.val(coverName);	
	
	$('.done').each(function(){
		$(this).removeAttr('disabled');
	});

	submit = $('<input/>').attr('type', 'submit');
	$(form).attr('action', 'PHP/setMateria.php'+r+u+'&id='+id).append(titleInput, subtitleInput, cover, submit);
	$(submit).hide().click();
},

getCover = (function(){
	var i = 0;
	var returnedFunction = function(){
		$.ajax({
			url: 'PHP/setCover.php',
			method: 'GET',
			data: {'getLastCover': '1'}
		})
		.complete(function(cover){
			cover = cover.responseText;
			i++;
			if(cover !== '' && cover){
				$('.capa').attr('src', cover);
				$('#coverFrame').remove();
				$('#cover-form').prop('action', false).prop('target', false);
			}
			else if(cover = 'teste.jpg'){
				$('#cover-form').append(
					$('<span/>').text('Erro ao enviar mensagem').addClass('error')
				);	
			}
			else if(i < 10) var timeout = setTimeout(function(){returnedFunction();}, 500);
			else clearTimeout(timeout);
		});
	};
	return returnedFunction;
})();

$(function(){
	var keyDownListener;

	var createTagInput = function(index){
		suplier = tagAdd;
		$(tagAdd).remove();
		$('#tagInputDiv').append(
			$('<input/>').attr({'type': 'text', 'name': 'tagInput['+index+']', 'placeholder': 'Adcione uma tag'})
			.addClass('materia').addClass('tagInput')
			.focus(function(){
				keyDownListener = document.addEventListener('keydown', function(evt){
					if(evt.keyCode == 13) tagAddFunction();
				})
				console.log(keyDownListener);
			}).blur(function(){
				document.removeEventListener('keydown', keyDownListener);
			}),
			$(suplier).click(function(){tagAddFunction();})
		)
	}

	tagAddFunction = function(){
		var ind = $('.tagInput').length;
		var lastTag = $('.tagInput')[ind-1];
		console.log(lastTag);
		if(ind < 5){
			$(lastTag).addClass('done');
			createTagInput(ind);
		}
	}
	$(tagAdd).click(function(){
		tagAddFunction();
	});
})