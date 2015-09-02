var assinar = function(signed, isSigning){
	var	isSigning = isSigning === undefined? 1: isSigning;

	$.ajax({
		url: 'PHP/assinar.php', 
		method: 'POST', 
		data: {signed: signed, isSigning: isSigning}
	})
	.success(function(response){
		console.log(response);
		if(response && isSigning){
			console.log($("#btnAssinar").val());
			$("#btnAssinar").val('Assinado');
			btnAssinar.onclick = function(){
				assinar(signed, 0);
			}
		}
		else if(response){
			$("#btnAssinar").val('Assinar');
			btnAssinar.onclick = function(){
				assinar(signed);
			}	
		}
	})	
}