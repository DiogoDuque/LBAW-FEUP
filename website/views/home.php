<?php include_once "../templates/header.html";?>

<!--Content-->
<div class="container">
  <!--Tabs-->
  <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#recent">Recent</a></li>
    <li><a data-toggle="tab" href="#popular">Most Popular</a></li>
    <li><a data-toggle="tab" href="#controverse">Most Controversial</a></li>
  </ul>
  
  <!--Tabs Content-->
  <div class="tab-content">
    <div id="recent" class="tab-pane fade in active">
      <div class="container">
        <div class="row">
          <div class="col-sm-4">
            <h3>Column 1</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit...</p>
            <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris...</p>
          </div>
          <div class="col-sm-4">
            <h3>Column 2</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit...</p>
            <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris...</p>
          </div>
          <div class="col-sm-4">
            <h3>Column 3</h3>        
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit...</p>
            <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris...</p>
          </div>
        </div>
      </div>
    </div>

    <div id="popular" class="tab-pane fade">
      <p>Some content.</p>
    </div>

    <div id="controverse" class="tab-pane fade">
      <p>More content.</p>
    </div>
  </div>
</div>

<?php include_once "../templates/footer.html";?>