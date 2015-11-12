$(function(){
	var GET =  decodeURIComponent(decodeURI(window.location.search.split('s=')[1])),
	getSmallestGrid = function(){
		var smallest = $('#grid1');
		for(var i = 2; i <= 3; i++){
			smallest = $('#grid'+i).height() < $(smallest).height()? $('#grid'+i): smallest;
		}
		return $(smallest);
	},
	getWord = function(str, ind){
		var i = ind;
		while(str[i] != ' ' && i < str.length) i++;
		return str.substring(ind, i);
	},
	eraseWord = function(fStr, subStr){
		var i = fStr.search(subStr);
		fStr = fStr.replace(subStr, '');
		return fStr.replace('  ', ' ');
	},
	toBLOB = function(str){
		var utf8Chars = ['á','à','ã','â','é','è','ê','í','ì','î','ó','ò','ô','õ','ú','ù'],
		blobChars =  ['&aacute;','&agrave;','&atilde;','&acirc;','&eacute;','&egrave;','&ecirc;','&iacute;','&igrave;','&icirc;','&oacute;','&ograve;','&ocirc;','&otilde;','&uacute;','&ugrave;'],
		defaultLength = utf8Chars.length, arr = [];

		for(i = 0; i < defaultLength; i++){
			utf8Chars[utf8Chars.length] = utf8Chars[i].toUpperCase();
			blobChars[blobChars.length] = blobChars[i].replace(blobChars[i][1], blobChars[i][1].toUpperCase());
		}
		utf8Chars = utf8Chars.concat(['ç', '<', '>', '&']);
		blobChars = blobChars.concat(['&ccedil;', '&lt;', '&gt;', '&amp;']);
		if(typeof str == 'string'){
			var i = 0;
			while(i < str.length){
				if(utf8Chars.indexOf(str[i])+1){
					ind = utf8Chars.indexOf(str[i]);
					str = str.replace(utf8Chars[ind], blobChars[ind]);
					i += blobChars[ind].length;
				} 
				else i++;
			}
		}
		else if(typeof str == 'object'){
			str.forEach(function(self){ arr[arr.length] = toBLOB(self);})
			str = arr;
		}
		return str;
	},
	followTag = function(btn){
		var span = $('span', 'div.tagData', $('.tagInfo', $(btn).parents()))[1], 
		isUndoing = $(btn).attr('class') == 'unfollowTag'?1:0, 
		tag = $(btn).siblings().text();
		$.ajax({
			url: 'PHP/followTag.php',
			method: 'POST',
			data: {'tag': tag, 'isUndoing': isUndoing}
		})
		.success(function(rs){
			if(rs){
				$(btn).text(isUndoing?'Assinar':'Assinado')
				.attr('class', isUndoing? 'followTag':'unfollowTag');
				$(span).text(parseInt($(span).text())+(isUndoing?-1:1));
			}
		});
	},
	showTags = function(tags){
		$.ajax({
			url: '/PHP/getTags.php',
			method: 'POST',
			data: {'tags': tags}
		})
		.success(function(xml){
			console.log(xml);
			$(xml).find('tag').each(function(){
				$('#tagDiv').append(
					$('<div/>').addClass('tagInfo').append(
						$('<div/>').addClass('tagCell').append(
							$('<a/>').addClass('tag').text($('text', this).text())
							.attr('href', 'pesquisa.php?s=%2523'+$('text', this).text()),
							$('<button/>').addClass(parseInt($(this).attr('followed'))?'unfollowTag':'followTag')
							.text(parseInt($(this).attr('followed'))?'Assinado':'Assinar')
							.click(function(){
								followTag(this);
							})
						),
						$('<div/>').addClass('tagCell').append(
							$('<div/>').addClass('tagData').append(
								$('<span/>').addClass('tagData').text($('assinantesAss', this).text()),
								$('<br/>'),
								$('<button/>').addClass('tagData').text('Pessoas que você assina')
							),
							$('<div/>').addClass('tagData').append(
								$('<span/>').addClass('tagData').text($('assinantes', this).text()),
								$('<br/>'),
								$('<button/>').addClass('tagData').text('Assinantes')
							),
							$('<div/>').addClass('tagData').append(
								$('<span/>').addClass('tagData').text($('publicacoes', this).text()),
								$('<br/>'),
								$('<button/>').addClass('tagData').text('Publicações')
							)
						)
					)
				);
			})
		});
	},
	getSearchData = function(str){
		var tags = [], tag, 
		strSplit = [], strSplitL = [], strSplitUp = [];
		while(str.search('#') >= 0){		
			tag = getWord(str, str.search('#')+1);
			str = eraseWord(str, '#'+tag);
			tags[tags.length] = tag;
		}
		showTags(tags);
		str.split(' ').forEach(function(self){
			if(self != '' && self != ' '){
				strSplit[strSplit.length] = self;
			} 
		});

		return [str, strSplit, tags, toBLOB(str), toBLOB(strSplit)];
	},
	searchData = getSearchData(GET);

	$('.searchBar').val(GET);
	$.ajax({
		url: '/PHP/getSearchResult.php',
		method: 'POST',
		data: {
			'fullText': searchData[0] != ' '? searchData[0]:'', 
			'words': searchData[1].length > 0?searchData[1]:0, 
			'tags': searchData[2].length > 0?searchData[2]:0,
			'blobText': searchData[3] != ' '?searchData[3]:'',
			'blobWords': searchData[4] !== undefined?searchData[4]:0
		}
	})
	.success(function(xml){
		var posts = $(xml).find('post'), i = 0, index = [-1], post;
		var constructPostBox = function(posts, i){
			post = $(posts)[i];
			var id = $(post).attr('id');
			var url = 'materia.php?matId='+$(post).attr('id');
			var img = $('<img/>').attr('src', 'images/'+$('cover', post).text())
			.addClass('postCover').prop('mousein', false);
			
			var title = $('<div/>').addClass('postTitle').append(
				$('<a/>').attr('href', url).text($('title', post).text()),
				$('<div/>').addClass('postSubtitle')
				.append($('<p/>').text($('subtitle', post).text())).hide()
			).prop({'mousein': false, 'visible': false});
			

			var imgDiv = $('<div/>').addClass('postInfo')
			.append(
				$('<a/>').attr('href', url).append(img), 
				$('<a/>').append(
					$('<div/>').addClass('authorDiv').append(
						$('<img/>')
						.attr({'src': 'layoutImages/PHFeh.jpg', 
								'width': '30px', 'height': '30px'}).addClass('authorImg'),
						$('<div/>').text($('author', post).text()).hide()
					)
				).attr('href', 'user.php?id='+$('author', post).attr('id')),
				title
			);
			
			var aprovarAlready = parseInt($('aprovar', post).attr('already'));
			var desaprovarAlready = parseInt($('desaprovar', post).attr('already'));
			var recomendarAlready = parseInt($('recomendar', post).attr('already'));
			var file = aprovarAlready?'aprovado.png': 'aprovar.png';
			var aprovarBG = 'url("http://localhost/Liberte/layoutImages/'+file+'")';
			file = desaprovarAlready?'desaprovado.png': 'desaprovar.png';
			var desaprovarBG = 'url("http://localhost/Liberte/layoutImages/'+file+'")';

			var btnDiv = $('<div/>').addClass('postBtns')
			.append(
				$('<span/>').addClass('postDate').text($('date', post).text()),
				$('<div/>').append(
					$('<button/>').addClass('btnRecomenda'+(recomendarAlready?'do':'r'))
					.attr('title', 'Recomendar')
					.click(function(){
						setRecomendacao(this, id, $(this).prop('isUndoing'));
					}).prop('isUndoing', recomendarAlready),
					$('<span/>').addClass('nRecomendar').text($('recomendar', post).text())
				),
				$('<div/>').append(
					$('<button/>').addClass('btnDesaprova'+(desaprovarAlready?'do':'r'))
					.attr('title', 'Desaprova'+(desaprovarAlready?'do':'r'))
					.click(function(){
						setVote(this, id, 0, $(this).prop('isUndoing'), $(this).prop('isUpdating'));
					}).prop({'isUndoing': desaprovarAlready, 'isUpdating': aprovarAlready}),
					$('<span/>').addClass('nDesaprovar').text($('desaprovar', post).text())
				),
				$('<div/>').append(
					$('<button/>').addClass('btnAprova'+(aprovarAlready?'do':'r'))
					.attr('title', 'Aprova'+(aprovarAlready?'do':'r'))
					.click(function(){
						setVote(this, id, 1, $(this).prop('isUndoing'), $(this).prop('isUpdating'));
					}).prop({'isUndoing': aprovarAlready, 'isUpdating': desaprovarAlready}),
					$('<span/>').addClass('nAprovar').text($('aprovar', post).text())
				)
			);

			getSmallestGrid().append(
				$('<div/>').addClass('postBox').append(imgDiv, btnDiv).prop('matId', $(this).attr('id'))
			);

			$(img).load(function(){
				$(imgDiv).height($(img).height());
				$('.authorDiv', imgDiv).css('margin-top', '-'+($(imgDiv).height()-5)+'px');
				$(title).css('margin-top', '-'+$(title).height()+'px')
				var showSubtitle = function(imgDiv, title){
					var subT = $('.postSubtitle', imgDiv);
					$('.postTitle').css('transition', '0.3s');
					$(subT).show();
					$(title).css('margin-top', '-'+($(title).height())+'px')
					.prop('visible', true);
					if($(title).height()-$(imgDiv).height() > -7.5){
						$(title).css('border-radius', '15px 15px 0 0');
						if($(title).height()-$(imgDiv).height() > 0){
							var margin = $(title).height()-($(title).height()-$('img', imgDiv).height());
							$(title).css('margin-top', '-'+(margin)+'px');
							$(imgDiv).height($(title).height());
							$(imgDiv).css('transition', '0.3s')
						}
					}
				};

				var hideSubtitle = function(imgDiv, title){
					setTimeout(function(){
						if(!$(title).prop('mousein') && !$('.postCover', imgDiv).prop('mousein')){
							var subT = $('.postSubtitle', imgDiv);
							var pMargin = parseInt($('p', subT).css('margin-top').split('px')[0])*2;
							var totalHeight = ($(title).height()-$(subT).height()-pMargin);
				
							$(title).css({'margin-top': '-'+totalHeight+'px', 'border-radius': '0'})
							.prop('visible', false);
							$(imgDiv).height($(img).height());
						}
					}, 10);
				};

				$('.postCover', imgDiv).mouseenter(function(){
					$(this).prop('mousein', true)
					if(!$(title).prop('visible')) showSubtitle(imgDiv, title);
				})
				.mouseleave(function(){
					$(this).prop('mousein', false)
					hideSubtitle(imgDiv, title);
				});
				
				$(title)
				.mouseenter(function(){
					$(this).prop('mousein', true);
					if(!$(title).prop('visible')) showSubtitle(imgDiv, title);
				})
				.mouseleave(function(){
					$(this).prop('mousein', false);
					hideSubtitle(imgDiv, this);
				});
				
				$('.authorDiv', imgDiv).mouseenter(function(){
					$(this).width(30+$('div', this).width()+6)
					.css('transition', '0.5s');
					$('div', this).css('transition', '1s').show();
				})
				.mouseleave(function(){
					$(this).width(30);
					$('div', this).hide();
				});
				i++;
				if(i < $(posts).length) constructPostBox(posts, i);
			}).error(function(){
				$(this).attr('src', 'images/capa_default.png');
			});
		};
		constructPostBox(posts, i);
	});
});