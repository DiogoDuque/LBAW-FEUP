<?php include_once "../templates/header.tpl"; ?>

<div class="container">
  <h1 class="text-center">Ask a Question:</h1>

  <form>
    <div class="form-group">
      <label for="title">Title</label>
      <input type="text" class="form-control" id="title">
    </div>

    <div class="form-group">
      <label for="category">Category</label>
      <select class="form-control" id="category">
        <option>Foods and Drinks</option>
        <option>Sports</option>
        <option>Computers</option>
        <option>Art</option>
      </select>
    </div>
  
    <div class="form-group">
      <label for="text">Text</label>
      <textarea rows="5" class="form-control" id="text"></textarea>
    </div>
  
    <button type="submit" class="btn btn-default">Submit</button>
    <button type="reset" class="btn btn-danger">Reset</button>
  </form>
</div>

<?php include_once "../templates/footer.tpl"; ?>
