var poll = function(){
	var time = 5000;

	$.ajax({
		url: 'PHP/verifNotification.php',
	})
	.success(function(rs){
		if(rs){
			$('.notifCount').text(rs);
			time = 30000;
		}
		setTimeout(poll, time);
	})
}
poll();