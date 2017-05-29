
function getGET(qs) {
    qs = qs.split("+").join(" ");
    var params = {},
        tokens,
        re = /[?&]?([^=]+)=([^&]*)/g;
    while (tokens = re.exec(qs)) {
        params[decodeURIComponent(tokens[1])]
            = decodeURIComponent(tokens[2]);
    }
    return params;
}

$(document).ready(function () {
    $(".answer-delete").click(function (event) {
        event.preventDefault();

        var elem = $(this).parent().parent().parent().parent();
        var author = elem.children(".userInfo").children(".user").children("a").get(0).innerHTML;
        var text = elem.children("div").children("p").get(0).innerHTML;
        var questionId = getGET(document.location.search)["id"];

        var requestData = [author, text, questionId];
        $.ajax({
            url: "../../actions/post/answer_delete.php",
            type: "POST",
            data: {data: JSON.stringify(requestData)},
            success: function (data) {
                elem.remove();
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
        });

    });
});