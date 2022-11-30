$(document).ready(function() {
		$.ajax({
			type : "GET",
			url : "../Server/gall.php",
			data : 'html',
			success : function(data) {

				$("#product-grid").html(data);
			

			}
		});
	});


