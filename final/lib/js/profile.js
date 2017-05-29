$(document).ready(function () {
    $("#removeMember").click(function () {

        //confirmation window
        var password = window.prompt("Are you sure you want to remove your account? If you are, confirm your password:");
        if (password == null)
            return;

        //ajax request
        var username = $(".table.table-user-information tr td:nth-child(2)").get(0).innerHTML;



        var requestData = [password, username];
        $.ajax({
            url: "../../actions/member/member_delete_user.php",
            type: "POST",
            data: {data: JSON.stringify(requestData)},
            success: function (data) {
                window.alert(data);
                location.reload();
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
        });

    });
});
