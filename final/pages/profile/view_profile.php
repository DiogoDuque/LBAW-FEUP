<?php

include_once("../../config/init.php");
include ($BASE_DIR."database/members.php");
include ($BASE_DIR."database/votes.php");


$smarty->display("common/header.tpl");

$user = getMemberByUsername($_SESSION["username"]);

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
                        <div class="col-md-3 col-lg-3 " align="center"> <img alt="User Pic" src="../../resources/img/user.png" class="img-circle img-responsive"> </div>
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
                                    <td><?=$score?></td>
                                </tr>
                                <tr>
                                    <td>Member Privilege</td>
                                    <td><?=$user['privilege_level']?></td>
                                </tr>

                                </tbody>
                                
                            </table>

                <div class="edit pull-right">
                    <a href="../../pages/profile/update_profile.php"title="Edit" data-toggle="tooltip" type="button" class="btn btn-sm btn-warning">
                    <i class="glyphicon glyphicon-edit"></i>
                    </a>
                 </div>
                            <div class="delete pull-right">
                                <a href="../../actions/member/member_delete.php"title="Delete" data-toggle="tooltip" type="button" class="btn btn-sm btn-warning">
                                    <i class="glyphicon glyphicon-remove"></i>
                                </a>
                            </div>

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
                    <th>Category</th>
                    <th>Date</th>
                    <th>Question</th>
                </tr>
                </thead>

                <tr>
                    <td>Animals</td>
                    <td>24/2/2000</td>
                    <td><a href="#">What is an animal?</a></td>
                </tr>

                <tr>
                    <td>Food</td>
                    <td>28/3/2001</td>
                    <td><a href="#">What is the best food in the world?</a></td>
                </tr>

                <tr>
                    <td>School</td>
                    <td>1/2/2004</td>
                    <td><a href="#">How do i learn faster?</a></td>
                </tr>

                <tr>
                    <td>Computers</td>
                    <td>4/3/2017</td>
                    <td><a href="#">What is the main difference between DFS and BFS?</a></td>
                </tr>
            </table>



        </div>
    </div>
</div>

<?php $smarty->display("common/footer.tpl"); ?>
