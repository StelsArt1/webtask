$(document).ready(function() {
	$('form').submit(function(event) {
		event.preventDefault();
		
		var idName= "#" + $(this).attr('id');
		//alert(idName);
		var msg   = $(idName).serialize();
		//alert(msg);
		$.ajax({
			type: 'POST',
			url: 'login.php',
			data: msg,
			success: function(data) {
				alert(data);
				return data;
			},
			error:  function(xhr, str){
				alert('Возникла ошибка: ' + xhr.responseCode);
			}
        });
	});
});
