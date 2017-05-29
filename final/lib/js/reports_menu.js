/**
 * Created by SpardaMarco on 29/05/2017.
 */
$('.no-collapse').on('click', function (e) {
    e.stopPropagation();
});

$('.delete-report').on('click', function (e) {

    var r = $( this ).parent().parent().parent().parent().parent().parent().parent();
    var id = r.attr('id').split("-")[1];

    var url = "../../actions/report/report_delete.php";

    var data = {
        id : id
    };

    $.ajax({
        type: "POST",
        url: url,
        data: data,
        success: function(){
            r.remove();
        },
        error: function(xhr){
            alert("An error occured: " + xhr.status + " " + xhr.statusText);
        }
    });
});