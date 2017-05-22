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

$(".comment_edit_button").click(function(event) {

    event.preventDefault();

    var comment = $( this ).parent().parent().parent();
    var id = $( this ).attr("href");
    var text = comment.children(".comment_text").text();


    var modal = $("#comment_edit_modal");
    modal.find("textarea").text(text);
    modal.find("input").val(id);
    modal.modal("show");

});


$(".comment_edit_form").submit(function(event) {

    event.preventDefault();

    var form = $( this );
    var url = form.attr( 'action' );

    var data = {
        id : form.find("input").val(),
        text : form.find("textarea").val()
    };

    $.ajax({
        type: "POST",
        url: url,
        data: data,
        success: function(){
            var comment = $('.comment[data-comment-id="' + data.id + '"]');
            comment.find("p").html(data.text);
            var modal = $("#comment_edit_modal");
            modal.modal("hide");
        },
        error: function(xhr){
            alert("An error occured: " + xhr.status + " " + xhr.statusText);
        }
    });

});

$(".comment_add_toogle").click(function(event) {

    event.preventDefault();

    var button = $( this );
    var form = button.parent().parent().parent().find(".comment_add_form");
    form.toggle(500);

});