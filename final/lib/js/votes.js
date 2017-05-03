function castVote(elem, voteValue, username){

    // TODO: Allow Member to unvote.
    // TODO: Think how to update vote instantly on client but only update on server after a period of time.

    if(username === ""){
        window.alert("You must login to vote!");
        //return;
    }
    var post_id = elem.data("post_id");
    var score_of_post_elemt = $( "p.post_score" + "[data-post_id='" + post_id + "']");

    console.log(score_of_post_elemt);

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
        url: BASE_URL+"actions/post/cast_vote.php",
        data:   {
            value : voteValue,
            post_id : post_id
        },
        success: function(response){

            if(response.status === "error") {
                window.alert("Duplicated vote.");
            }
            else{
                elem.toggleClass('on');

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

$(document).ready(function () {

    $('.glyphicon-thumbs-up').on('click', function() {

        if($(this).hasClass('on'))
        {
            $(this).removeClass('on');
        }
        else {
            var voteValue = "up"; //vote.value
            castVote($(this), voteValue, username);
        }

    });
    $('.glyphicon-thumbs-down').on('click', function() {
        var voteValue="down"; //vote.value
        castVote($(this),voteValue, username);
    });
});