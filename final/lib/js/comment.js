$(".comment_form").submit(function(event) {

    event.preventDefault();

    var form = $( this );
    var url = form.attr( 'action' );

    var data = form.serialize();

    $.ajax({
        type: "POST",
        url: url,
        data: data,
        success: function(data){
            location.reload();
        },
        error: function(xhr){
            alert("An error occured: " + xhr.status + " " + xhr.statusText);
        }
    });

});
