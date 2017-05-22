<?php

include_once("../../config/init.php");

if(!isset($_SESSION['username']))
    die("Member not authenticated.");

$smarty->display("common/header.tpl");

?>

<div class="container">
    <h1 class="text-center">Ask a Question:</h1>

    <form action="<?$BASE_URL?>actions/post/question_add.php" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" name="title" required>
        </div>

        <div class="form-group">
            <label for="category">Category</label>
            <select class="form-control" id="category" name="category" required>
            <?php
                foreach ($categories as $category) {
                    echo '<option>'.$category['name'].'<option>';
                }
            ?>
            </select>
        </div>

        <label>Text</label>
        <div class="new-post">

            <textarea id="summernote" class="formgroup" name="text">
            </textarea>

            <script>
                $(document).ready(function () {
                    var summernote = $('#summernote');
                    summernote.summernote({
                        height: '20rem',
                        minHeight: '20rem',
                        toolbar: [
                            // [groupName, [list of button]]
                            ['style', ['bold', 'italic', 'underline', 'clear']],
                            ['font', ['strikethrough', 'superscript', 'subscript']],
                            ['para', ['ul', 'ol']],
                            ['insert', ['link', 'table']],
                            ['misc', ['undo', 'redo', 'help']]
                        ]
                    });
                });
            </script>

        </div>

        <button type="submit" class="btn btn-success">Submit</button>
    </form>
</div>

<?php $smarty->display("common/footer.tpl"); ?>
