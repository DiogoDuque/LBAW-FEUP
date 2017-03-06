<?php include_once "../templates/header.php"; ?>

    <link rel="stylesheet" href="../lib/css/question.css">
    <script>
        $(document).ready(function () {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>

    <!--Content-->
        <div class="container">
            <ol class="breadcrumb">
                <li><a href="home.php">Home</a></li>
                <li>Sports</li>
                <li class="active">Lorem ipsum?</li>        
            </ol>
    
        <!--Title-->
        <h2>Lorem ipsum?</h2>

        <small class="pull-right">
            8
            <span class="glyphicon glyphicon-thumbs-up"></span>
            5
            <span class="glyphicon glyphicon-thumbs-down"></span>
        </small>

        <!--Question-->
        <div class="question row">

            <div class="col-md-2">
                <!--User-->
                <div class="user">
                    <img alt="User Pic" src="../resources/img/user.png" class="img-circle img-responsive" width="100"
                         height="100">
                    <a href="./profile.php">Peralta</a>
                </div>
                <!--Score-->
                <ul class="score">
                    <li><a class="glyphicon glyphicon-thumbs-up" href="#"></a></li>
                    <li><p>3</p></li>
                    <li><a class="glyphicon glyphicon-thumbs-down" href="#"></a></li>
                </ul>
            </div>

            <!--Text-->
            <div class="col-md-10">
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam viverra feugiat erat posuere
                    pellentesque. Nullam gravida lorem dolor, quis dignissim orci elementum sed. Etiam sollicitudin nunc
                    eu risus tristique tristique. Mauris at massa elit. Fusce ligula tortor, blandit non rhoncus ac,
                    rhoncus vel dui. Suspendisse sit amet sem id sapien volutpat interdum non non orci. Quisque vitae
                    nisl ut nunc fringilla vestibulum. Nam porta porttitor rhoncus. Duis ultrices sem condimentum,
                    suscipit sem vel, faucibus lectus. Nulla pellentesque felis sapien, et porta turpis rhoncus non.
                    Proin nec leo venenatis, iaculis mi id, bibendum lorem. Aenean convallis nec elit vitae scelerisque.
                    Vivamus condimentum nunc ac leo pretium, eu porttitor risus laoreet. Aliquam accumsan ipsum nec eros
                    euismod, non hendrerit felis finibus. Sed scelerisque rhoncus consectetur. Orci varius natoque
                    penatibus et magnis dis parturient montes, nascetur ridiculus mus.
                    Aliquam ac turpis vel ligula sodales volutpat at in augue. Maecenas eleifend eros id consectetur
                    fermentum. Ut hendrerit, nulla ut dictum pellentesque, urna enim efficitur urna, sit amet facilisis
                    risus diam nec tellus. Vestibulum egestas justo neque, ac convallis lacus gravida eu. Nunc volutpat,
                    libero at porttitor venenatis, sapien dui sollicitudin urna, ut feugiat sem metus id tortor. Donec
                    vel rutrum nibh. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse sed odio
                    mauris. Suspendisse porta purus quis libero hendrerit, vel tincidunt diam rutrum. Nam sodales erat
                    sed tellus pellentesque, ac tincidunt eros euismod. Praesent tristique dolor sapien, et interdum
                    orci rhoncus vel. Sed odio sem, vulputate nec vulputate maximus, pharetra non est. Vivamus porta
                    sagittis nunc.</p>
                <ul class="actions pull-right">
                    <li><a class="glyphicon glyphicon-link" href="#" data-toggle="tooltip" title="Share"></a></li>
                    <li><a class="glyphicon glyphicon-flag" href="#" data-toggle="tooltip" title="Report"></a></li>
                    <li><a class="glyphicon glyphicon-pencil" href="#" data-toggle="tooltip" title="Edit"></a></li>
                    <li><a class="glyphicon glyphicon-trash" href="#" data-toggle="tooltip" title="Remove"></a></li>
                </ul>
            </div>

            <!--Comments-->
            <?php
            for ($j = 0; $j < 2; $j++) {
                ?>
                <div class="comment col-md-9 col-md-offset-3">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam viverra feugiat erat posuere
                        pellentesque. Nullam gravida lorem dolor, quis dignissim orci elementum sed</p>
                    <a href="./profile.php">Peralta</a>
                    <ul class="actions pull-right">
                        <li><a class="glyphicon glyphicon-flag" href="#" data-toggle="tooltip" title="Report"></a></li>
                        <li><a class="glyphicon glyphicon-pencil" href="#" data-toggle="tooltip" title="Edit"></a></li>
                        <li><a class="glyphicon glyphicon-trash" href="#" data-toggle="tooltip" title="Remove"></a></li>
                    </ul>

                </div>
                <?php
            }
            ?>
        </div>



        <div class="answers">

            <h4 >Answers</h4>

            <?php
            for ($i = 0; $i < 3; $i++) {
                ?>
                <small class="pull-right">
                    10
                    <span class="glyphicon glyphicon-thumbs-up"></span>
                    5
                    <span class="glyphicon glyphicon-thumbs-down"></span>
                </small>

                <div class="answer row">
                    <div class="col-md-2">
                        <!--User-->
                        <div class="user">
                            <img alt="User Pic" src="../resources/img/user.png" class="img-circle img-responsive"
                                 width="100" height="100">
                            <a href="./profile.php">Peralta</a>
                        </div>
                        <!--Score-->
                        <ul class="score">
                            <li><a class="glyphicon glyphicon-thumbs-up" href="#"></a></li>
                            <li><p>5</p></li>
                            <li><a class="glyphicon glyphicon-thumbs-down" href="#"></a></li>
                        </ul>
                    </div>
                    <!--Text-->
                    <div class="col-md-10">
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam viverra feugiat erat posuere
                            pellentesque. Nullam gravida lorem dolor, quis dignissim orci elementum sed. Etiam
                            sollicitudin nunc eu risus tristique tristique. Mauris at massa elit. Fusce ligula tortor,
                            blandit non rhoncus ac, rhoncus vel dui. Suspendisse sit amet sem id sapien volutpat
                            interdum non non orci. Quisque vitae nisl ut nunc fringilla vestibulum. Nam porta porttitor
                            rhoncus. Duis ultrices sem condimentum, suscipit sem vel, faucibus lectus. Nulla
                            pellentesque felis sapien, et porta turpis rhoncus non. Proin nec leo venenatis, iaculis mi
                            id, bibendum lorem. Aenean convallis nec elit vitae scelerisque. Vivamus condimentum nunc ac
                            leo pretium, eu porttitor risus laoreet. Aliquam accumsan ipsum nec eros euismod, non
                            hendrerit felis finibus. Sed scelerisque rhoncus consectetur. Orci varius natoque penatibus
                            et magnis dis parturient montes, nascetur ridiculus mus.
                            Aliquam ac turpis vel ligula sodales volutpat at in augue. Maecenas eleifend eros id
                            consectetur fermentum. Ut hendrerit, nulla ut dictum pellentesque, urna enim efficitur urna,
                            sit amet facilisis risus diam nec tellus. Vestibulum egestas justo neque, ac convallis lacus
                            gravida eu. Nunc volutpat, libero at porttitor venenatis, sapien dui sollicitudin urna, ut
                            feugiat sem metus id tortor. Donec vel rutrum nibh. Lorem ipsum dolor sit amet, consectetur
                            adipiscing elit. Suspendisse sed odio mauris. Suspendisse porta purus quis libero hendrerit,
                            vel tincidunt diam rutrum. Nam sodales erat sed tellus pellentesque, ac tincidunt eros
                            euismod. Praesent tristique dolor sapien, et interdum orci rhoncus vel. Sed odio sem,
                            vulputate nec vulputate maximus, pharetra non est. Vivamus porta sagittis nunc.</p>
                        <ul class="actions pull-right">
                            <li><a class="glyphicon glyphicon-flag" href="#" data-toggle="tooltip" title="Report"></a>
                            </li>
                            <li><a class="glyphicon glyphicon-pencil" href="#" data-toggle="tooltip" title="Edit"></a>
                            </li>
                            <li><a class="glyphicon glyphicon-trash" href="#" data-toggle="tooltip" title="Remove"></a>
                            </li>
                        </ul>
                    </div>
                    <!--Comments-->
                    <?php
                    for ($j = 0; $j < 2; $j++) {
                        ?>
                        <div class="comment col-md-9 col-md-offset-3">
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam viverra feugiat erat
                                posuere pellentesque. Nullam gravida lorem dolor, quis dignissim orci elementum sed</p>
                            <a href="./profile.php">Peralta</a>
                            <ul class="actions pull-right">
                                <li><a class="glyphicon glyphicon-flag" href="#" data-toggle="tooltip"
                                       title="Report"></a></li>
                                <li><a class="glyphicon glyphicon-pencil" href="#" data-toggle="tooltip"
                                       title="Edit"></a></li>
                                <li><a class="glyphicon glyphicon-trash" href="#" data-toggle="tooltip"
                                       title="Remove"></a></li>
                            </ul>
                        </div>
                        <?php
                    }
                    ?>
                </div>
                <?php
            }
            ?>
        </div>

        <?php if($logged_in) { ?>

            <div class="new-answer">
                <h3>Your answer</h3>
                <div id="summernote" class="formgroup"></div>
                <script>
                    $(document).ready(function() {
                        $('#summernote').summernote();
                    });
                </script>

                <button type="submit" class="btn btn-success">Submit</button>
            </div>

        <?php } ?>



    </div>


<?php include_once "../templates/footer.html"; ?>
