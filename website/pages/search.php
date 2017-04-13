<?php include_once "../templates/header.tpl";?>

<!--Content-->
<div class="container">
  <h1 class="text-center">Advanced Search</h1>

  <form>
    <div class="form-group">
      <label for="text">Search for:</label>
      <input type="text" class="form-control" id="text">
    </div>
    
    <div class="container">
      <div class="row">
        
        <div class="col-sm-4">
          <div class="checkbox">
            <label><input type="checkbox" value="">Search in Titles</label>
          </div>
        </div>
        
        <div class="col-sm-4">
          <div class="checkbox">
            <label><input type="checkbox" value="">Search in Descriptions</label>
          </div>
        </div>
        
        <div class="col-sm-4">
          <div class="checkbox">
            <label><input type="checkbox" value="">Search in Answers</label>
          </div>
        </div>

      </div>
    </div>

    <div class="form-group">
      <label for="order">Order by:</label>
      <select class="form-control" id="order">
        <option>Most Recent</option>
        <option>Least Recent</option>
        <option>Best Score</option>
        <option>Most Voted</option>
        <option>Least Voted</option>
        <option>Peraltamometer</option>
      </select>
    </div>

    <h5>Filter by Category</h5>

    <div class="container">
      <div class="row">
        
        <div class="col-sm-3">
          <div class="checkbox">
            <label><input type="checkbox" value="">Foods and Drinks</label>
          </div>
        </div>
        
        <div class="col-sm-3">
          <div class="checkbox">
            <label><input type="checkbox" value="">Sports</label>
          </div>
        </div>
        
        <div class="col-sm-3">
          <div class="checkbox">
            <label><input type="checkbox" value="">Computers</label>
          </div>
        </div>

        <div class="col-sm-3">
          <div class="checkbox">
            <label><input type="checkbox" value="">Art</label>
          </div>
        </div>
        
      </div>
    </div>
  
    <button type="submit" class="btn btn-success btn-block">Search</button>
    <button type="reset" class="btn btn-danger btn-block">Reset</button>
  </form>
</div>

<!-- RESULTS -->

<h1 class="text-center">Results</h1>

<!--Multi Link-->
<div class="container answer">
  <div class="row">
    <div class="col-sm-9 pre">
      <h4><a href="posts/question.php" class="home-question-title">Is Picasso a Renaissance influence?</a><br>
        <small>asked 55 seconds ago by <a href="profile.php">Peralta</a> in <a href="./search.php">Arts</a></small>
      </h4>
    </div>
    <div class="col-sm-1">
      <h4 class="text-center">
        <small>
          <span class="glyphicon glyphicon-thumbs-up"></span>        
          2 
          <span class="glyphicon glyphicon-thumbs-up"></span>
          upvotes
        </small>
      </h4>
    </div>
    <div class="col-sm-1">
      <h4 class="text-center">
        <small>
          <span class="glyphicon glyphicon-thumbs-down"></span>        
          5
          <span class="glyphicon glyphicon-thumbs-down"></span>
           downvotes
        </small>
      </h4>
    </div>
    <div class="col-sm-1">
      <h4 class="text-center">
        <small>
          <span class="glyphicon glyphicon-comment"></span>
          0
          <span class="glyphicon glyphicon-comment"></span>
           answers
        </small>
      </h4>
    </div>
  </div>
</div>

<hr class="main-menu-questions-divider">


<?php include_once "../templates/footer.tpl";?>
