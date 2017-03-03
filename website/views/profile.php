<?php include_once "../templates/logged_in_header.html" ?>


<div class="container">
    <div class="row">
        <!--AQUI-->
        <div class="col-md-5  toppad  pull-right col-md-offset-3 ">
        </div>
        <!--AQUI-->
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xs-offset-0 col-sm-offset-0 col-md-offset-3 col-lg-offset-3 toppad" >

            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title" align="center">User Profile</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-3 col-lg-3 " align="center"> <img alt="User Pic" src="../resources/img/user.png" class="img-circle img-responsive"> </div>
                        <div class=" col-md-9 col-lg-9 ">
                            <table class="table table-user-information">
                                <tbody>
                                <tr>
                                    <td>Name:</td>
                                    <td>Peralta o Biatch</td>
                                </tr>
                                <tr>
                                    <td>Age:</td>
                                    <td>999</td>
                                </tr>
                                <tr>
                                    <td>Date of Birth:</td>
                                    <td>23/11/1788</td>
                                </tr>
                                <tr>
                                    <td>Gender:</td>
                                    <td>Male</td>
                                </tr>
                                <tr>
                                    <td>Home Address:</td>
                                    <td>China</td>
                                </tr>
                                <tr>
                                    <td>Email:</td>
                                    <td><a href="peraltas@hotmail.com">peraltas@hotmail.com</a></td>
                                </tr>
                                <td>Score:</td>
                                <td>-5000</td>
                                </tr>

                                </tbody>
                                
                            </table>
                <div class="editP pull-right">	
					<div class="glyphicon glyphicon-pencil" href="#" data-toggle="tooltip" title="Edit"></div>
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
            <h3>Historical</h3>
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
            </table>



        </div>
    </div>
</div>

<?php include_once "../templates/footer.html" ?>

