<div class="container">
    <div class="row">

        <div class="col-md-5  toppad  pull-right col-md-offset-3 ">
        </div>

        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xs-offset-0 col-sm-offset-0 col-md-offset-3 col-lg-offset-3 toppad" >

            <!-- User Panel-->
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title" align="center">User Profile</h3>
                </div>

                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-3 col-lg-3 " align="center">
                            {if $member.filename}
                                <img alt="User Pic" src="{$BASE_URL}resources/uploads/{$member.filename}" class="img-circle img-responsive">
                            {else}
                                <img alt="User Pic" src="{$BASE_URL}resources/img/user.png" class="img-circle img-responsive">
                            {/if}

                            <br>

                            {if $self}
                                <form action="{$BASE_URL}actions/member/update_img_action.php" method="post" enctype="multipart/form-data">

                                    <label>Photo:<br>  <br>
                                        <input type="file" name="photo">
                                    </label>
                                    <input type="hidden" name="username" value=<?=$user['username']?>
                                    <input type="submit" value="Submit">

                                </form>
                            {/if}


                        </div>
                        <div class=" col-md-9 col-lg-9 ">
                            <table class="table table-user-information">
                                <tbody>
                                <tr>
                                    <td> Username:</td>
                                    <td>{$member.username}</td>
                                </tr>
                                <tr>
                                    <td>Email:</td>
                                    <td><a href="mailto:{$member.email}">{$member.email}</a></td>
                                </tr>
                                <tr>
                                    <td>Score:</td>
                                    <td>{$score.sum}</td>
                                </tr>
                                <tr>
                                    <td>Member Privilege:</td>
                                    <td>{$member.privilege_level}</td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                </tr>
                                </tbody>
                            </table>

                            {if $self}
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
                            {/if}

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
            <h3>Latest Topics</h3>
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

                {foreach $lastPosts as $i=>$post}
                    <tr>
                        <td><a class="" href="{$BASE_URL}pages/posts/question.php?id={$post.id}">{$post.title}</a></td>
                        <td><a class="" href="{$BASE_URL}pages/home.php?category={$post.category_id}">{$post.category}</a></td>
                        <td>{$post.date}</td>
                    </tr>
                {/foreach}
            </table>



        </div>
    </div>
</div>
<script type="text/javascript" src="{$BASE_URL}lib/js/profile.js"></script>