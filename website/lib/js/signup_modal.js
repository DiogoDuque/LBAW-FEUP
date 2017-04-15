var goodColor = "#66cc66";
var badColor = "#ff6666";
var white ="#ffffff";


var usernameElem = document.getElementById('username');
var emailElem = document.getElementById('email');

function validateUsername(){

    var username = usernameElem.val();
    var email = emailElem.val();

    usernameElem.style.backgroundColor = goodColor;

    return $.ajax({
        type: "POST",
        url: "{$BASE_URL}/actions/auth/signup.php",
        data:   {
            action: 'checkIfUsernameExists',
            username : username,
        },
        success: function(response){
            if(response == "false")
            {
                usernameElem.style.backgroundColor = goodColor;
                return true;
            }
            else
            {
                usernameElem.style.backgroundColor = badColor;
                return false;
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }
    });

}