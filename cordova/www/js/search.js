$(document).ready(function() {
    $("#search-box").keyup(function() {
    $.ajax({
        type : "GET",
        url : "http://eris.ad.murdoch.edu.au/~33970651/Assignment2/Server/search.php",
        data : 'keyword=' + $(this).val(),
        success : function(data) {

            $("#suggestion-box").html(data);
            $("#suggestion-box").show();
            
            

        }
    });
    
});
});