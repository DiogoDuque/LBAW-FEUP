<?php
include_once("../../config/init.php");
include_once($BASE_DIR."database/members.php");

function displayMembersList($members, $privilege){
  ?>
  <div class=<?php
    if(strcmp($privilege, "Member")==0)
      echo "\"tab-pane active\"";
    else echo "\"tab-pane\"";

    if(strcmp($privilege, "Member")==0)
      echo " id=\"members\"";
    else if(strcmp($privilege, "Moderator")==0)
      echo " id=\"moderators\"";
    else echo " id=\"admins\""; ?>>

    <h3 class="text-center"><? $privilege."s" ?></h3>
    <div class="well" style="max-height: 300px;overflow: auto;">
      <ul class="list-group checked-list-box">
        <?php foreach($members as $member){
            if(strcmp($member['privilege_level'], $privilege)==0){
              echo "<li class=\"list-group-item\">".$member['username']."</li>";
            }
          }?>
      </ul>
      <div class="control-group">
        <label></label>
        <div class="controls">
          <button id="removeMember" type="submit" class="btn btn-primary">Remove</button>
        </div>
      </div>
    </div>
  </div>
<?php
};

$memberInfos = getAllUsernamesAndPrivileges();

$smarty->display("common/header.tpl");
?>

<!-- Main -->
<div class="container">
  <div class="row">
    <div class="col-md-3">
      <!-- Left column -->
      <a href="#"><strong><i class="glyphicon glyphicon-wrench"></i> Tools</strong></a>  
      
      <hr>
      
      <ul class="list-unstyled">
        <li class="nav-header">
          <a href="#" data-toggle="collapse" data-target="#menu2">
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
                <li><a href="#moderators" data-toggle="tab">Moderators</a></li>
                <li><a href="#admins" data-toggle="tab">Admins</a></li>
              </ul>
              <div class="tab-content">
              
              <?php
                displayMembersList($memberInfos,"Member");
                displayMembersList($memberInfos,"Moderator");
                displayMembersList($memberInfos,"Administrator");
              ?>

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
            <form id="add_category" action="../../actions/admin/create_category.php" method="post" enctype="multipart/form-data" class="form form-vertical">
              <div class="control-group">
                <label>Name</label>
                <div class="controls">
                 <input id="new_category_name" type="text" class="form-control" placeholder="Enter Name" name="name" required>
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
              <script type='text/javascript'>
                  $("#add_category").submit(function(event) {

                      event.preventDefault();

                      var $form = $( this );
                      var url = $form.attr( 'action' );
                      var data = {name: $("#new_category_name").val()};
                      $.ajax({
                          type: "POST",
                          url: url,
                          data: data,
                          success: function(data){
                              console.log(data);
                              if (data.status == 'error')
                                  alert("\"" + data.name + "\" category already exists");
                              else
                                  alert("\"" + data.name + "\"  category was successfully created.\nYou may need to update to see the changes.");
                          },
                          error: function(xhr){
                              alert("An error occured: " + xhr.status + " " + xhr.statusText);
                          }
                      });

                  });
              </script>
          </div><!--/panel content-->

        </div><!--/panel-->

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
                <label>Permissions</label>
                <div class="controls">
                  <select class="form-control">
                    <option>Moderator</option>
                    <option>Admin</option>
                  </select>
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

<?php $smarty->display("common/footer.tpl"); ?>

<script type="text/javascript" src="../../lib/js/membersTabelAdmin.js"></script>

<script type="text/javascript">

  $(document).ready(function(){
    $("#removeMember").click(function() {
      var membersList = $("li.list-group-item.list-group-item-primary.active");
      
      //check if there are users to be removed
      if(membersList.length<0)
        return;

      //warning window
      if(!window.confirm("Are you sure you want to remove "+membersList.length+" members?"))
        return;
      
      //confirmation window
      var password = window.prompt("Confirm your password:");
      if(password==null)
        return;

      //ajax request
      var usernames = [];
      for(i=0; i<membersList.length; i++){
        usernames.push(membersList.get(i).innerText);
      }
      var requestData = [password,usernames];
      var request = $.ajax({
        url: "../../actions/member/member_delete.php",
        type: "POST",
        dataType: "json",
        data: JSON.stringify(requestData),
        success: function(data){
          window.warning(data.message+data.users);
          context.reload();
        }
      });

    });
  });
</script>
