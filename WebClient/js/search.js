$(document).ready(function() {
    $("#search-box").keyup(function() {
    $.ajax({
        type : "GET",
        url : "./search.php",
        data : 'keyword=' + $(this).val(),
        success : function(data) {

            $("#suggestion-box").html(data);
            $("#suggestion-box").show();
            
            

        }
    });
    
});
});