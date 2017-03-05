<!-- Header -->

<?php include_once "../templates/header.php" ?>
<script type="text/javascript" src="../lib/js/membersTabelAdmin.js"></script>


<!-- Main -->
<div class="container">
<div class="row">
    <div class="col-md-3">
      <!-- Left column -->
      <a href="#"><strong><i class="glyphicon glyphicon-wrench"></i> Tools</strong></a>  
      
      <hr>
      
      <ul class="list-unstyled">
        <li class="nav-header"> <a href="#" data-toggle="collapse" data-target="#menu2">
          <h5>Reports <i class="glyphicon glyphicon-chevron-right"></i></h5>
          </a>
        
            <ul class="list-unstyled collapse" id="menu2">
                <li><a href="#">Reports</a>
                </li>
            </ul>
        </li>

        
            <ul class="list-unstyled collapse" id="menu3">
                <li><a href="#"><i class="glyphicon glyphicon-circle"></i> Facebook</a></li>
            </ul>
        </li>
      </ul>
           

  	</div><!-- /col-3 -->
    <div class="col-md-9">
      	
      <!-- column 2 -->	
      <a href="#"><strong><i class="glyphicon glyphicon-dashboard"></i> My Dashboard</strong></a>  
      
      	<hr>
      
		<div class="row">
           
            
          
            <!-- center left-->	
         	<div class="col-md-6">
			  <div class="well">Inbox Reports <span class="badge pull-right">3</span></div>

             
	
			  <hr>              

			  <!--tabs-->
              <div class="container">
                <div class="col-md-4">
                <ul class="nav nav-tabs" id="myTab">
                  <li class="active"><a href="#members" data-toggle="tab">Members</a></li>
                  <li><a href="#admins" data-toggle="tab">Admins</a></li>
                  <li><a href="#moderators" data-toggle="tab">Moderators</a></li>
                </ul>
                
                <div class="tab-content">
                  <div class="tab-pane active" id="members">
        <h3 class="text-center">Members</h3>
            <div class="well" style="max-height: 300px;overflow: auto;">
        		<ul class="list-group checked-list-box">
                  <li class="list-group-item">Cras justo odio</li>
                  <li class="list-group-item" data-checked="true">Dapibus ac facilisis in</li>
                  <li class="list-group-item">Morbi leo risus</li>
                  <li class="list-group-item">Porta ac consectetur ac</li>
                  <li class="list-group-item">Vestibulum at eros</li>
                  <li class="list-group-item">Cras justo odio</li>
                  <li class="list-group-item">Dapibus ac facilisis in</li>
                  <li class="list-group-item">Morbi leo risus</li>
                  <li class="list-group-item">Porta ac consectetur ac</li>
                  <li class="list-group-item">Vestibulum at eros</li>
                </ul>

                 <div class="control-group">
                          	<label></label>
                        	<div class="controls">
                        	<button type="submit" class="btn btn-primary">
                              Remove
                            </button>
                        	</div>
                        </div>  
            </div>
                  </div>
                  <div class="tab-pane" id="admins">
        <h3 class="text-center">Admins</h3>
            <div class="well" style="max-height: 300px;overflow: auto;">
        		<ul class="list-group checked-list-box">
                  <li class="list-group-item">Cras justo odio</li>
                  <li class="list-group-item" data-checked="true">Dapibus ac facilisis in</li>
                  <li class="list-group-item">Morbi leo risus</li>
                  <li class="list-group-item">Porta ac consectetur ac</li>
                  <li class="list-group-item">Vestibulum at eros</li>
                  <li class="list-group-item">Cras justo odio</li>
                  <li class="list-group-item">Dapibus ac facilisis in</li>
                  <li class="list-group-item">Morbi leo risus</li>
                  <li class="list-group-item">Porta ac consectetur ac</li>
                  <li class="list-group-item">Vestibulum at eros</li>
                </ul>

                 <div class="control-group">
                          	<label></label>
                        	<div class="controls">
                        	<button type="submit" class="btn btn-primary">
                              Remove
                            </button>
                        	</div>
                        </div>  
            </div>
                  </div>
                  <div class="tab-pane" id="moderators">
        <h3 class="text-center">Moderators</h3>
            <div class="well" style="max-height: 300px;overflow: auto;">
        		<ul class="list-group checked-list-box">
                  <li class="list-group-item">Cras justo odio</li>
                  <li class="list-group-item" data-checked="true">Dapibus ac facilisis in</li>
                  <li class="list-group-item">Morbi leo risus</li>
                  <li class="list-group-item">Porta ac consectetur ac</li>
                  <li class="list-group-item">Vestibulum at eros</li>
                  <li class="list-group-item">Cras justo odio</li>
                  <li class="list-group-item">Dapibus ac facilisis in</li>
                  <li class="list-group-item">Morbi leo risus</li>
                  <li class="list-group-item">Porta ac consectetur ac</li>
                  <li class="list-group-item">Vestibulum at eros</li>
                </ul>

                 <div class="control-group">
                          	<label></label>
                        	<div class="controls">
                        	<button type="submit" class="btn btn-primary">
                              Remove
                                </button>
                        	</div>
                        </div>  
                     </div>
                  </div>
                </div>
              	</div>
              </div>  
               
              <!--/tabs-->
              

   
          	</div><!--/col-->
        	<div class="col-md-6">
              
              	<div class="panel panel-default">
                	<div class="panel-heading">
                      	<div class="panel-title">
                  		<i class="glyphicon glyphicon-wrench pull-right"></i>
                      	<h4>Add Category</h4>
                      	</div>
                	</div>
                	<div class="panel-body">

                      <form class="form form-vertical">
                       
                        <div class="control-group">
                          <label>Name</label>
                          <div class="controls">
                           <input type="text" class="form-control" placeholder="Enter Name">
                          </div>
                        </div>      
                        
                        <div class="control-group">
                          	<label></label>
                        	<div class="controls">
                        	<button type="submit" class="btn btn-primary">
                              Done
                            </button>
                        	</div>
                        </div>   
                        
                      </form>
 
                
                
                  </div><!--/panel content-->

                  
                </div><!--/panel-->

          
                        
                      </form>
 
                


         	<div class="panel panel-default">
                	<div class="panel-heading">
                      	<div class="panel-title">
                  		<i class="glyphicon glyphicon-wrench pull-right"></i>
                      	<h4>Add Staff</h4>
                      	</div>
                	</div>
                	<div class="panel-body">

                      <form class="form form-vertical">
                       
                        <div class="control-group">
                          <label>Name</label>
                          <div class="controls">
                           <input type="text" class="form-control" placeholder="Enter Name">
                          </div>
                        </div>      
                        
                        <div class="control-group">
                          <label>Message</label>
                          <div class="controls">
                          	<textarea class="form-control"></textarea>
                          </div>
                        </div> 
                             
                        <div class="control-group">
                          <label>Permissions</label>
                          <div class="controls">
                             <select class="form-control"><option>Moderator</option>
                                                          <option>Admin</option></select>
                          </div>
                        </div>    
                        
                        <div class="control-group">
                          	<label></label>
                        	<div class="controls">
                        	<button type="submit" class="btn btn-primary">
                              Done
                            </button>
                        	</div>
                        </div>   
                        
                      </form>
                
                
                  </div><!--/panel content-->
                </div><!--/panel-->
              
              

              
			</div><!--/col-span-6-->
     
      </div><!--/row-->
      
      <hr>
      
     
  	</div><!--/col-span-9-->
</div>
</div>
<!-- /Main -->

<?php include_once "../templates/footer.html" ?>