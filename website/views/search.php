<?php include_once "../templates/header.html" ?>

<link rel="stylesheet" href="../lib/css/search.css">

<div class="container">

    <h3 class="text-left">Keywords</h3>

    <!-- Search bar -->
    <div class="row" id="custom-search-input">

        <div class="input-group col-md-12">
            <input type="text" class="search-query form-control"/>
            <span class="input-group-btn">

                <button class="btn btn-danger" type="button">
                    <span class=" glyphicon glyphicon-search"></span>
                </button>
            </span>
        </div>

    </div>


    <!-- Filters -->
    <div class="row top10" id="custom-search-filters">
        <div class="dropdown col-md-3">
            <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Category
                <span class="caret"></span>
            </button>

            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <li><a class="dropdown-item" href="#">Foods and Drinks</a></li>
                <li><a class="dropdown-item" href="#">Sports</a></li>
                <li><a class="dropdown-item" href="#">Computers</a></li>
                <li><a class="dropdown-item" href="#">Art</a></li>
            </ul>
        </div>

        <div class="btn-group" data-toggle="buttons">
            <label class="btn btn-primary">
                <input type="radio" name="answer_or_question" id="answer_radio" autocomplete="off"> Answer
            </label>
            <label class="btn btn-primary active">
                <input type="radio" name="answer_or_question" id="question_radio" autocomplete="off"> Question
            </label>
        </div>
    </div>

</div>

<?php include_once "../templates/footer.html" ?>
