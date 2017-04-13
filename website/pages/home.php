<?php include_once "../templates/common/header.tpl";

$questions = array(
    "Why are the only possible values for a bit 0 and 1?",
    "Best side dish for a filet mignon?",
    "Do you like this?",
    "What are the best Billiards training practices?",
    "Difference between DFS and BFS?"
);

$questions_categories = array(
    "Computers",
    "Food and Drinks",
    "Food and Drinks",
    "Sports",
    "Computers"
);

$questions_points = array(4, -2, 5, 0, 7);

?>

    <!--Content-->
    <div class="container">
        <!--Tabs-->
        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#recent">Recent</a></li>
            <li><a data-toggle="tab" href="#popular">Most Popular</a></li>
            <li><a data-toggle="tab" href="#controverse">Most Controversial</a></li>
        </ul>

        <!--TODO: Make a template of question/answer and put it in the templates folder.-->

        <!--Tabs Content-->
        <div class="tab-content">

            <!--MOST RECENT -->
            <div id="recent" class="tab-pane fade in active">

                <?php

                for ($i = 0;
                     $i < count($questions);
                     $i++) {
                ?>

                <!--Multi Link-->
                <div class="container answer">
                    <div class="row">
                        <div class="col-sm-10 pre">
                            <h4><a href="/question.php"
                                   class="home-question-title"><?= $questions[$i] ?></a><br>
                                <small>asked 55 seconds ago by <a href="profile.php">Peralta</a> in
                                    <a href="./search.php"><?= $questions_categories[$i] ?></a>
                                </small>
                            </h4>
                        </div>

                        <div class="points col-sm-1">
                            <h4 class="text-center">
                                <div class="points"><?= $questions_points[$i] ?></div>
                                <small>points</small>
                            </h4>
                        </div>


                        <div class="answers col-sm-1">
                            <h4 class="text-center">
                                <div class="answers">
                                    0
                                    <small><span class="glyphicon glyphicon-comment"></span></small>
                                </div>

                                <small>
                                    answers
                                </small>
                            </h4>
                        </div>

                    </div>
                </div>

                <?php } ?>

            </div>

            <hr class="main-menu-questions-divider">

            <!--MOST POPULAR-->
            <div id="popular" class="tab-pane fade">
                <p>Some content.</p>
            </div>

            <!--MOST CONTROVERSE-->
            <div id="controverse" class="tab-pane fade">
                <!--Single Link-->
                <div class="container answer">
                    <div class="row">
                        <div class="col-sm-9 pre">
                            <h4><a class="home-question-title">Is Trump the new Jesus?</a><br>
                                <small>asked 55 seconds ago by <a href="profile.php">Peralta</a></small>
                            </h4>
                        </div>
                        <div class="col-sm-1">
                            <h4 class="text-center">
                                2
                                <small>
                                    <span class="glyphicon glyphicon-thumbs-up"></span>
                                    upvotes
                                </small>
                            </h4>
                        </div>
                        <div class="col-sm-1">
                            <h4 class="text-center">
                                50
                                <small>
                                    <span class="glyphicon glyphicon-thumbs-down"></span>
                                    downvotes
                                </small>
                            </h4>
                        </div>
                        <div class="col-sm-1">
                            <h4 class="text-center">
                                2
                                <small>
                                    <span class="glyphicon glyphicon-comment"></span>
                                    answers
                                </small>
                            </h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="../lib/js/home.js"></script>

<?php include_once "../templates/footer.tpl"; ?>
