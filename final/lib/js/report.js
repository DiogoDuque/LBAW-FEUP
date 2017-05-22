/**
 * Created by SpardaMarco on 22/05/2017.
 */
$(".report_button").click(function(event) {

    event.preventDefault();

    var id = $( this ).attr("href");

    var modal = $("#report_modal");
    modal.find("input[name=post_id]").val(id);
    modal.modal("show");

});

$(".report_form").submit(function(event) {

    event.preventDefault();

    var form = $( this );
    var url = form.attr( 'action' );

    var data = form.serialize();

    $.ajax({
        type: "POST",
        url: url,
        data: data,
        success: function(){
            var modal = $("#report_modal");
            modal.modal("hide");
        },
        error: function(xhr){
            alert("An error occured: " + xhr.status + " " + xhr.statusText);
        }
    });
});