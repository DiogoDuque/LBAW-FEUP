<?php

include_once("../../config/init.php");
include_once ($BASE_DIR."database/DatabaseGetter.php");

$smarty->display("common/header.tpl");

$getter = new DatabaseGetter();

$post = $getter->getPost($_GET["id"]);
$currentVersion = $getter->getLatestPostVersion($_GET["id"]);

?>

<div class="container">
    <h1 class="text-center">Edit Post</h1>

    <!--TODO: Put text to a PHP POST.-->
    <form>
        <input type="hidden" name="editedText" id="editedText" value="">
        <div class="new-answer">
            <div id="summernote" class="formgroup">
                    <?=$currentVersion["text"]?>
            </div>
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
        document.editedText.value = $('#summernote').summernote('code');
        document.forms["sampleForm"].submit();
    }

    function resetEditedText(){
        var uneditedText = <?= json_encode($currentVersion["text"], JSON_HEX_TAG);?>;
        $('#summernote').summernote('code', uneditedText);
    }
</script>

<?php $smarty->display("common/footer.tpl"); ?>
