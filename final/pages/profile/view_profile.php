<?php

include_once("../../config/init.php");
include_once ($BASE_DIR."database/members.php");
include_once ($BASE_DIR."database/votes.php");
include_once ($BASE_DIR."database/posts.php");
include_once ($BASE_DIR."database/answers.php");
include_once ($BASE_DIR."database/questions.php");
include_once ($BASE_DIR."database/versions.php");

$user = getMemberById($_GET['id']);
if($user["username"]==$username)
    $user=getMemberByUsername($_SESSION["username"]);

$lastposts = getPostUser($user['id']);
if (!isset($_SESSION["username"])) {

    $_SESSION['error_messages'] = "You must be logged in to see members' profiles.";

    $destination = $BASE_URL."pages/home.php";

    header( "refresh:3;url={$destination}" );
    $smarty->assign('redirect_destiny', $destination);
    $smarty->display('common/info.tpl');
    die();
}

$array = array();


//img
    if (file_exists($BASE_DIR.'resources/img/'.$user['username'].'.png'))
      $photo = 'resources/img/'.$user['username'].'.png';
    if (file_exists($BASE_DIR.'resources/img/'.$user['username'].'.jpg'))
      $photo = 'images/users/'.$tweet['username'].'.jpg';
    if (!$photo) $photo = 'resources/img/user.png';


//score
$score=getScore($user['id']);

$smarty->display("common/header.tpl");

    ?>


<div class="container">


    <div class="row">

        <div class="col-md-5  toppad  pull-right col-md-offset-3 ">
        </div>

        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xs-offset-0 col-sm-offset-0 col-md-offset-3 col-lg-offset-3 toppad" >

            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title" align="center">User Profile</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-3 col-lg-3 " align="center">  <img alt="User Pic" src="<?=$BASE_URL.$photo?>" class="img-circle img-responsive">

                            <br>
                            <?php if(!isset($_GET['id'])) : ?>
                              <form action="<?=$BASE_URL.'actions/member/update_img_action.php'?>" method="post" enctype="multipart/form-data">

                            <label>Photo:<br>  <br>
                                <input type="file" name="photo">
                            </label>
                              <input type="hidden" name="username" value=<?=$user['username']?>>

                            <input type="submit" value="Submit">

                              </form>
                                                        <?php endif; ?>


                        </div>
                        <div class=" col-md-9 col-lg-9 ">
                            <table class="table table-user-information">
                                <tbody>
                                <tr>
                                    <td> Username:</td>
                                    <td><?=$user["username"]?></td>
                                </tr>
                                <tr>
                                    <td>Email:</td>
                                    <td><a href="mailto:<?=$user["email"]?>"><?=$user["email"]?></a></td>
                                </tr>
                                <tr>
                                    <td>Score:</td>
                                    <td><?=$score['sum']?></td>
                                </tr>
                                <tr>
                                    <td>Member Privilege:</td>
                                    <td><?=$user['privilege_level']?></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                </tr>


                                </tbody>
                                
                            </table>
                            <?php if(!isset($_GET['id'])) : ?>
                <div class="edit pull-right">
                    <a href="../../pages/profile/update_profile.php"title="Edit" data-toggle="tooltip" type="button" class="btn btn-sm btn-warning">
                    <i class="glyphicon glyphicon-edit"></i>
                    </a>
                 </div>
                            <div class="control-group">
                                <label></label>
                                <div class="controls">
                                    <button id="removeMember" type="submit" class="btn btn-primary">Remove</button>
                                </div>
                            </div>
                            <?php endif; ?>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!--Historico-->
<div class="container">
    <div class="row">
        <div class="title" align="center">
            <h3>Your latest topics</h3>
        </div>
    </div>
</div>

<div class="container">
    <div class="row ">
        <div class="tabela" id="opdRetro">
            <table class="table table-striped table-hover">
                <thead>
                <tr class="bg-primary">
                    <th>Question</th>
                    <th>Category</th>
                    <th>Date</th>
                </tr>
                </thead>
                <?php for ($i = 0; $i < sizeof($lastposts); $i++){
                    $aux;
                array_push($array,$lastposts[$i]['id']);

                if(isAnswer($array[$i])){
                    $aux=getQuestionId($array[$i]);
                }
                    else {
                    $aux=$array[$i];
                    }
                    $title=getQuestionTitle($aux);
                    $cat_id=getQuestionCategory($aux);
                    $cat=getCategory($cat_id['category_id']);
                    $version=getLatestPostVersion($aux);

                    ?>

                <tr><td><a class="" href="<?=$BASE_URL.'pages/posts/question.php?id='.$aux?>"><?= $title['title']?></a> </td>
                    <td><?php echo $cat['name'] ?></td>
                    <td><?php echo $version['date'] ?></td>
                </tr>



                <?php } ?>
                </table>



        </div>
    </div>
</div>

<?php $smarty->display("common/footer.tpl"); ?>


<script type="text/javascript">

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
</script>
