$(function(){
	$.ajax({
		url: 'PHP/getRascunhos.php',
	})
	.success(function(xml){
		var posts = $(xml).find('rascunho'), i = 0, post,
		getSmallestGrid = function(){
			var smallest = $('#grid1');
			for(var i = 2; i <= 3; i++){
				smallest = $('#grid'+i).height() < $(smallest).height()? $('#grid'+i): smallest;
			}
			return $(smallest);
		},
		constructPostBox = function(posts, i){
			post = $(posts)[i];
			var id = $(post).attr('id');
			var url = 'editar.php?matId='+$(post).attr('id');
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
				title
			);

			var btnDiv = $('<div/>').addClass('postBtns')
			.append($('<span/>').addClass('postDate').text($('date', post).text()));

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