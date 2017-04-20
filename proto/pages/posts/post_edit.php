<?php

include_once("../../config/init.php");
include_once ($BASE_DIR."database/posts.php");
include_once ($BASE_DIR."database/members.php");
include_once ($BASE_DIR."database/versions.php");

$smarty->display("common/header.tpl");

if (!isset($_GET['id']))
    die('Missing post ID.');

if (!isset($_SESSION['username']))
    die('Member not authenticated.');


$post = getPost($_GET["id"]);
$currentVersion = getLatestPostVersion($_GET["id"]);
$member_id = intval(getMemberByUsername($_SESSION["username"])["id"]);

?>

<div class="container">
    <h1 class="text-center">Edit Post</h1>

    <!--TODO: Put text to a PHP POST.-->
    <form action="<?=$BASE_URL?>actions/post/post_apply_edit.php" method="post">

        <input type="hidden" name="post_id" value="<?=$_GET["id"]?>">
        <input type="hidden" name="member_id" value="<?=$member_id?>">

        <div class="new-post">

            <textarea id="summernote" class="formgroup"  name="edited_text">
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
