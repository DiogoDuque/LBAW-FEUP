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
                elem.toggleClass('on');
                console.log("elem " + elem);

                score_of_post_elemt.text(function(i,oldVal){
                    return parseInt(oldVal,10) + v;
                });
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }
    });
}

function highlightMemberVotes(elem){

    var post_id = elem.data("post_id");

    console.log(post_id);

    $.ajax({
        type: "POST",
        url: BASE_URL+"api/vote/check_if_voted_on.php",
        data:   {
            post_id : post_id
        },
        success: function(response){

            if(response.found === "true") {
                //elem.addClass('on');
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

    $(".score .glyphicon-thumbs-down, .score .glyphicon-thumbs-up").each(function() {
        //highlightMemberVotes($(this));
    });
});