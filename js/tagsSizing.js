$(function(){
	var nchars, li,
	tagSize = $('#nav ul li').width(), tags = $('#nav ul li a');
	$(tags).each(function(){
		nchars = $(this).text().length;
		li = $(this).parents()[0];
		while($(this).width()+nchars < tagSize && parseInt($(this).css('letter-spacing')) < 15){
			$(this).css('letter-spacing', parseInt($(this).css('letter-spacing'))+1);
		}
		while($(this).width() > tagSize){
			$(this).css('font-size', parseInt($(this).css('font-size'))-1);
			$(li).css('margin-top', (parseFloat($(li).css('margin-top'))+0.5)+'px');
		}
	});
});