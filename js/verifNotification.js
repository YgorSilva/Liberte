var poll = function(){
	var time = 5000;

	$.ajax({
		url: 'PHP/verifNotification.php',
	})
	.success(function(response){
		if(response){
			console.log(response);
			$(notif).text('Notificações '+response);
			time = 30000;
		}
		else{
			console.log('false');
			$(notif).text('Notificações');
		}
		setTimeout(poll, time);
	})
}
poll();