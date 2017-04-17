<?php

include_once ("../../config/init.php");

$smarty->display("common/header.tpl");

?>

<div class="container">
  <h1 class="text-center">Ask a Question:</h1>

  <form action="../../actions/post/question_add.php" method="post" enctype="multipart/form-data">
    <div class="form-group">
      <label for="title">Title</label>
      <input type="text" class="form-control" name="title" required>
    </div>

    <div class="form-group">
      <label for="category">Category</label>
      <select class="form-control" id="category" name="category" required>
        <option>Food</option>
        <option>Sports</option>
        <option>Technology</option>
        <option>Art</option>
      </select>
    </div>
  
    <div class="form-group">
      <label for="text">Text</label>
      <textarea rows="5" class="form-control" name="text" required></textarea>
    </div>
  
    <button type="submit" class="btn btn-default">Submit</button>
    <button type="reset" class="btn btn-danger">Reset</button>
  </form>
</div>

<?php $smarty->display("common/footer.tpl"); ?>
