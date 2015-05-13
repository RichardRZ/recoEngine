var MIN_LENGTH = 3;


$( document ).ready(function() {
    $("#keyword1").keyup(function() {
        console.log('first test')
        var keyword = $("#keyword1").val();
        if (keyword.length >= MIN_LENGTH) {
            $.get( "./auto-complete.php", { keyword: keyword } )
            .done(function( data ) {
                $('#results1').html('');
                var results = jQuery.parseJSON(data);
                console.log(results);
                if (jQuery.isEmptyObject(results)) {};// add warning!;
                $(results).each(function(key, value) {
                    $('#results1').append('<a href="#" class="item list-group-item">' + value + '</a>');
                })
                $('.item').click(function() {
                    var text = $(this).html();
                    $('#keyword1').val(text);
                })
            });
        } else {
            $('#results1').html('');
        }
    });

    $("#keyword1").blur(function(){
            $("#results1").fadeOut(500);
        })
        .focus(function() {     
            $("#results1").show();
        });

});

$( document ).ready(function() {
    $("#keyword2").keyup(function() {
        console.log('first test')
        var keyword = $("#keyword2").val();
        if (keyword.length >= MIN_LENGTH) {
            $.get( "./auto-complete.php", { keyword: keyword } )
            .done(function( data ) {
                $('#results2').html('');
                var results = jQuery.parseJSON(data);
                console.log(results);
                if (jQuery.isEmptyObject(results)) {};// add warning!;
                $(results).each(function(key, value) {
                    $('#results2').append('<a href="#" class="item list-group-item">' + value + '</a>');
                })
                $('.item').click(function() {
                    var text = $(this).html();
                    $('#keyword2').val(text);
                })
            });
        } else {
            $('#results2').html('');
        }
    });

    $("#keyword2").blur(function(){
            $("#results2").fadeOut(500);
        })
        .focus(function() {     
            $("#results2").show();
        });

});

$( document ).ready(function() {
    $("#keyword3").keyup(function() {
        console.log('first test')
        var keyword = $("#keyword3").val();
        if (keyword.length >= MIN_LENGTH) {
            $.get( "./auto-complete.php", { keyword: keyword } )
            .done(function( data ) {
                $('#results3').html('');
                var results = jQuery.parseJSON(data);
                console.log(results);
                if (jQuery.isEmptyObject(results)) {};// add warning!;
                $(results).each(function(key, value) {
                    $('#results3').append('<a href="#" class="item list-group-item">' + value + '</a>');
                })
                $('.item').click(function() {
                    var text = $(this).html();
                    $('#keyword3').val(text);
                })
            });
        } else {
            $('#results3').html('');
        }
    });

    $("#keyword3").blur(function(){
            $("#results3").fadeOut(500);
        })
        .focus(function() {     
            $("#results3").show();
        });

});

$( document ).ready(function() {
    $("#keyword4").keyup(function() {
        console.log('first test')
        var keyword = $("#keyword4").val();
        if (keyword.length >= MIN_LENGTH) {
            $.get( "./auto-complete.php", { keyword: keyword } )
            .done(function( data ) {
                $('#results4').html('');
                var results = jQuery.parseJSON(data);
                console.log(results);
                if (jQuery.isEmptyObject(results)) {};// add warning!;
                $(results).each(function(key, value) {
                    $('#results4').append('<a href="#" class="item list-group-item">' + value + '</a>');
                })
                $('.item').click(function() {
                    var text = $(this).html();
                    $('#keyword4').val(text);
                })
            });
        } else {
            $('#results4').html('');
        }
    });

    $("#keyword4").blur(function(){
            $("#results4").fadeOut(500);
        })
        .focus(function() {     
            $("#results4").show();
        });

});

$( document ).ready(function() {
    $("#keyword5").keyup(function() {
        console.log('first test')
        var keyword = $("#keyword5").val();
        if (keyword.length >= MIN_LENGTH) {
            $.get( "./auto-complete.php", { keyword: keyword } )
            .done(function( data ) {
                $('#results5').html('');
                var results = jQuery.parseJSON(data);
                console.log(results);
                if (jQuery.isEmptyObject(results)) {};// add warning!;
                $(results).each(function(key, value) {
                    $('#results5').append('<a href="#" class="item list-group-item">' + value + '</a>');
                })
                $('.item').click(function() {
                    var text = $(this).html();
                    $('#keyword5').val(text);
                })
            });
        } else {
            $('#results5').html('');
        }
    });

    $("#keyword5").blur(function(){
            $("#results5").fadeOut(500);
        })
        .focus(function() {     
            $("#results5").show();
        });

});