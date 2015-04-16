var MIN_LENGTH = 3;


$( document ).ready(function() {
    $("#keyword").keyup(function() {
        var keyword = $("#keyword").val();
        if (keyword.length >= MIN_LENGTH) {
            $.get( "./auto-complete.php", { keyword: keyword } )
            .done(function( data ) {
                $('#results').html('');
                var results = jQuery.parseJSON(data);
                console.log(results);
                if (jQuery.isEmptyObject(results)) {};// add warning!;
                $(results).each(function(key, value) {
                    $('#results').append('<a href="#" class="item list-group-item">' + value + '</a>');
                })
                $('.item').click(function() {
                    var text = $(this).html();
                    $('#keyword').val(text);
                })
            });
        } else {
            $('#results').html('');
        }
    });

    $("#keyword").blur(function(){
            $("#results").fadeOut(500);
        })
        .focus(function() {     
            $("#results").show();
        });

});