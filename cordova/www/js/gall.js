
$(document).ready(function() {
		$.ajax({
			type : "GET",
			url : "http://eris.ad.murdoch.edu.au/~33970651/Assignment2/Server/gall.php",
			data : 'html',
			success : function(data) {

				$("#product-grid").html(data);
			

			}
		});
	});


