function castVote(elem, voteValue, username){

    // TODO: See why color isn't updating on voting.
    // TODO: Think how to update vote instantly on client but only update on server after a period of time.

    if(username === ""){
        window.alert("You must login to vote!");
        //return;
    }
    var post_id = elem.data("post_id");
    var score_of_post_elemt = $( "p.post_score" + "[data-post_id='" + post_id + "']");

    var v = 0;

    if(voteValue ==="up")
    {
        v = 1;
    }
    else
    {
        v = -1;
    }

    $.ajax({
        type: "POST",
        url: BASE_URL+"api/vote/cast_vote.php",
        data:   {
            value : voteValue,
            post_id : post_id
        },
        success: function(response){

            if(response.status === "success")
            {
                score_of_post_elemt.html(response.score);

                highlightMemberVotes(elem);
                console.log("elem " + elem);

            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }
    });
}

function highlightMemberVotes(elem){

    var post_id = elem.data("post_id");

    $.ajax({
        type: "POST",
        url: BASE_URL+"api/vote/check_if_voted_on.php",
        data:   {
            post_id : post_id
        },
        success: function(response){

            if(response.found === true) {

                var up = $(".glyphicon-thumbs-up" + "[data-post_id='" + post_id + "']");
                var down = $(".glyphicon-thumbs-down" + "[data-post_id='" + post_id + "']");

                if(response.value == true)
                {
                    up.addClass('on');
                    down.removeClass('on');
                }
                else
                {
                    down.addClass('on');
                    up.removeClass('on');
                }

            }
            else
            {
                elem.removeClass('on');
            }

        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }
    });
}

$(document).ready(function () {

    $('.score .glyphicon-thumbs-up').on('click', function() {

        var voteValue = "up"; //vote.value
        castVote($(this), voteValue, username);

    });
    $('.score .glyphicon-thumbs-down').on('click', function() {
        var voteValue="down"; //vote.value
        castVote($(this),voteValue, username);
    });

    $('.post_score').each(function() {
        highlightMemberVotes($(this));
    });
});