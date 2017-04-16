<?php

include_once("../../config/init.php");
include_once ($BASE_DIR."database/DatabaseGetter.php");

$smarty->display("common/header.tpl");

if (!isset($_GET['id']))
    die('Missing post ID.');

$getter = new DatabaseGetter();

$post = $getter->getPost($_GET["id"]);
$currentVersion = $getter->getLatestPostVersion($_GET["id"]);

?>

<div class="container">
    <h1 class="text-center">Edit Post</h1>

    <!--TODO: Put text to a PHP POST.-->
    <form action="<?=$BASE_URL?>actions/post/post_apply_edit.php" method="post">

        <input type="hidden" name="editedText" id="editedText" value="">
        <input type="hidden" name="postId" value="<?=$_GET["id"]?>">

        <div class="new-post">

            <textarea id="summernote" class="formgroup"  name="editedText">
                    <?=$currentVersion["text"]?>
            </textarea>

            <script>
                $(document).ready(function() {
                    $('#summernote').summernote();
                });
            </script>

        </div>

        <button type="submit" onclick="sendEditedText()" class="btn btn-success">Apply</button>
        <button type="reset" onclick="resetEditedText()" class="btn btn-danger">Reset</button>
    </form>
</div>

<script>
    function sendEditedText(){
        document.forms["sampleForm"].submit();
    }

    function resetEditedText(){
        var uneditedText = <?= json_encode($currentVersion["text"], JSON_HEX_TAG);?>;
        $('#summernote').summernote('code', uneditedText);
    }
</script>

<?php $smarty->display("common/footer.tpl"); ?>
