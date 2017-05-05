$("#add_category").submit(function(event) {

    event.preventDefault();

    var $form = $( this );
    var url = $form.attr( 'action' );
    var data = {name: $("#new_category_name").val()};
    $.ajax({
        type: "POST",
        url: url,
        data: data,
        success: function(data){
            console.log(data);
            if (data.status == 'error')
                alert("\"" + data.name + "\" category already exists");
            else
                alert("\"" + data.name + "\"  category was successfully created.\nYou may need to update to see the changes.");
        },
        error: function(xhr){
            alert("An error occured: " + xhr.status + " " + xhr.statusText);
        },
    });

});

$("#remove_category").submit(function(event) {

    event.preventDefault();

    var $form = $( this );
    var url = $form.attr( 'action' );
    var id = $("#remove_category_name").val();
    if(id == ""){
        alert("Please select a category.");
        return;
    }
    if(!confirm("You are trying to remove a category.\nThis will delete all questions, answer and comments of that category.\nDo you want to continue?"))
        return;
    var data = {id: id};

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