$(document).ready(function() {
	$('form').submit(function(event) {
		event.preventDefault();
		
		var idName= "#" + $(this).attr('id');
		//alert(idName);
		var msg   = $(idName).serialize();
		//alert(msg);
		if ($(this).attr('id') != "payFormMy") {
		$.ajax({
			type: 'POST',
			url: 'send1.php',
			data: msg,
			success: function(data) {
				console.log(data);
				alert(data);
				return data;
			},
			error:  function(xhr, str){
				alert('Возникла ошибка: ' + xhr.responseCode);
			}
        });
		} else {
			var req = new XMLHttpRequest();
			req.onreadystatechange = function() { 
			var a;
			if (req.readyState === 4 && req.status === 200) {
				console.log(req);
				a = document.createElement('a');
				a.href = window.URL.createObjectURL(req.response);
				a.download = "lala.pdf";
				a.style.display = 'none';
				document.body.appendChild(a);
				a.click();
				alert (req.responseText);
				}	
			}
		
			req.open('POST', 'download.php', true); 
			req.setRequestHeader("Content-Type","application/x-www-form-urlencoded; charset=utf-8");
			req.responseType = 'blob';
			req.send(msg);
		}
	});
});

