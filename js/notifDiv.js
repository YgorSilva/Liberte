$(function(){
	$('.notifContent').hide();
	$('.notifBtn').prop('showing', false).click(function(){
		if(!$(this).prop('showing')){
			$(this).attr('src', 'http://localhost/Liberte/layoutImages/notifBtnS.png')
			.prop('showing', true).css(
				{'border': '1px solid rgba(50, 50, 50, 0.4)',
				'border-bottom': '0px'});
			$('.notifContent').show();
			$('.notifCount').text('');
		}
		else{
			$(this).attr('src', 'http://localhost/Liberte/layoutImages/notifBtn.png')
			.prop('showing', false).css('border', '1px solid rgba(50, 50, 50, 0)');
			$('.notifContent').hide();
		}
	})
})