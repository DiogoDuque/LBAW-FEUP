<?php include_once "../templates/logged_in_header.html";?>

    <link rel="stylesheet" href="../lib/css/question.css">
	<script>
		$(document).ready(function(){
			$('[data-toggle="tooltip"]').tooltip(); 
		});
	</script>

    <!--Content-->
    <div class="container">
        <!--Title-->
        <h2>Lorem ipsum?</h2>

        <div class="question row">
			
            <!--Score-->
            <div class="col-md-1">
                <ul class="score-col">
                    <li><a class="glyphicon glyphicon-thumbs-up" href="#"></a></li>
                    <li><p class="score">3</p></li>
                    <li><a class="glyphicon glyphicon-thumbs-down" href="#"></a></li>
                </ul>
            </div>
            <!--User-->
            <div class="user col-md-1">
                <img alt="User Pic" src="../resources/img/user.png" class="img-circle img-responsive" width="100" height="100">
                <a href="#">Peralta</a>
            </div>
            <!--Text-->
            <div class="col-md-10">
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam viverra feugiat erat posuere pellentesque. Nullam gravida lorem dolor, quis dignissim orci elementum sed. Etiam sollicitudin nunc eu risus tristique tristique. Mauris at massa elit. Fusce ligula tortor, blandit non rhoncus ac, rhoncus vel dui. Suspendisse sit amet sem id sapien volutpat interdum non non orci. Quisque vitae nisl ut nunc fringilla vestibulum. Nam porta porttitor rhoncus. Duis ultrices sem condimentum, suscipit sem vel, faucibus lectus. Nulla pellentesque felis sapien, et porta turpis rhoncus non. Proin nec leo venenatis, iaculis mi id, bibendum lorem. Aenean convallis nec elit vitae scelerisque. Vivamus condimentum nunc ac leo pretium, eu porttitor risus laoreet. Aliquam accumsan ipsum nec eros euismod, non hendrerit felis finibus. Sed scelerisque rhoncus consectetur. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.
                    Aliquam ac turpis vel ligula sodales volutpat at in augue. Maecenas eleifend eros id consectetur fermentum. Ut hendrerit, nulla ut dictum pellentesque, urna enim efficitur urna, sit amet facilisis risus diam nec tellus. Vestibulum egestas justo neque, ac convallis lacus gravida eu. Nunc volutpat, libero at porttitor venenatis, sapien dui sollicitudin urna, ut feugiat sem metus id tortor. Donec vel rutrum nibh. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse sed odio mauris. Suspendisse porta purus quis libero hendrerit, vel tincidunt diam rutrum. Nam sodales erat sed tellus pellentesque, ac tincidunt eros euismod. Praesent tristique dolor sapien, et interdum orci rhoncus vel. Sed odio sem, vulputate nec vulputate maximus, pharetra non est. Vivamus porta sagittis nunc.</p>
				<ul class="actions pull-right">	
					<li><a class="glyphicon glyphicon-link" href="#" data-toggle="tooltip" title="Share"></a></li>
					<li><a class="glyphicon glyphicon-flag" href="#" data-toggle="tooltip" title="Report"></a></li>
					<li><a class="glyphicon glyphicon-pencil" href="#" data-toggle="tooltip" title="Edit"></a></li>
					<li><a class="glyphicon glyphicon-trash" href="#" data-toggle="tooltip" title="Remove"></a></li>
				</ul>
            </div>
            <!--Comments-->
            <?php
                for($j=0;$j<2;$j++) {
            ?>
                    <div class="comment col-md-9 col-md-offset-3">
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam viverra feugiat erat posuere pellentesque. Nullam gravida lorem dolor, quis dignissim orci elementum sed</p>
                            <a href="#">Peralta</a>
							<ul class="actions pull-right">	
								<li><a class="glyphicon glyphicon-flag" href="#" data-toggle="tooltip" title="Report"></a></li>
								<li><a class="glyphicon glyphicon-pencil" href="#" data-toggle="tooltip" title="Edit"></a></li>
								<li><a class="glyphicon glyphicon-trash" href="#" data-toggle="tooltip" title="Remove"></a></li>
							</ul>
						
                    </div>
            <?php
                }
            ?>
        </div>

        <?php
        for($i=0;$i<3;$i++){
        ?>
            <div class="answer row">
                <!--Score-->
                <div class="col-md-1">
                    <ul class="score-col">
                        <li><a class="glyphicon glyphicon-thumbs-up" href="#"></a></li>
                        <li><p class="score">3</p></li>
                        <li><a class="glyphicon glyphicon-thumbs-down" href="#"></a></li>
                    </ul>
                </div>
                <!--User-->
                <div class="user col-md-1">
                    <img alt="User Pic" src="../resources/img/user.png" class="img-circle img-responsive" width="100" height="100">
                    <a href="#">Peralta</a>
                </div>
                <!--Text-->
                <div class="col-md-8">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam viverra feugiat erat posuere pellentesque. Nullam gravida lorem dolor, quis dignissim orci elementum sed. Etiam sollicitudin nunc eu risus tristique tristique. Mauris at massa elit. Fusce ligula tortor, blandit non rhoncus ac, rhoncus vel dui. Suspendisse sit amet sem id sapien volutpat interdum non non orci. Quisque vitae nisl ut nunc fringilla vestibulum. Nam porta porttitor rhoncus. Duis ultrices sem condimentum, suscipit sem vel, faucibus lectus. Nulla pellentesque felis sapien, et porta turpis rhoncus non. Proin nec leo venenatis, iaculis mi id, bibendum lorem. Aenean convallis nec elit vitae scelerisque. Vivamus condimentum nunc ac leo pretium, eu porttitor risus laoreet. Aliquam accumsan ipsum nec eros euismod, non hendrerit felis finibus. Sed scelerisque rhoncus consectetur. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.
                    Aliquam ac turpis vel ligula sodales volutpat at in augue. Maecenas eleifend eros id consectetur fermentum. Ut hendrerit, nulla ut dictum pellentesque, urna enim efficitur urna, sit amet facilisis risus diam nec tellus. Vestibulum egestas justo neque, ac convallis lacus gravida eu. Nunc volutpat, libero at porttitor venenatis, sapien dui sollicitudin urna, ut feugiat sem metus id tortor. Donec vel rutrum nibh. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse sed odio mauris. Suspendisse porta purus quis libero hendrerit, vel tincidunt diam rutrum. Nam sodales erat sed tellus pellentesque, ac tincidunt eros euismod. Praesent tristique dolor sapien, et interdum orci rhoncus vel. Sed odio sem, vulputate nec vulputate maximus, pharetra non est. Vivamus porta sagittis nunc.</p>
					<ul class="actions pull-right">	
						<li><a class="glyphicon glyphicon-flag" href="#" data-toggle="tooltip" title="Report"></a></li>
						<li><a class="glyphicon glyphicon-pencil" href="#" data-toggle="tooltip" title="Edit"></a></li>
						<li><a class="glyphicon glyphicon-trash" href="#" data-toggle="tooltip" title="Remove"></a></li>
					</ul>
                </div>
                <!--Extra Info-->
                <div class="col-md-2">
                    <p>some xtra stuff, maybe some tags or "resources"</p>
                </div>
                <!--Comments-->
                <?php
                for($j=0;$j<2;$j++) {
                ?>
                    <div class="comment col-md-7 col-md-offset-3">
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam viverra feugiat erat posuere pellentesque. Nullam gravida lorem dolor, quis dignissim orci elementum sed</p>
                            <a href="#">Peralta</a>
							<ul class="actions pull-right">	
								<li><a class="glyphicon glyphicon-flag" href="#" data-toggle="tooltip" title="Report"></a></li>
								<li><a class="glyphicon glyphicon-pencil" href="#" data-toggle="tooltip" title="Edit"></a></li>
								<li><a class="glyphicon glyphicon-trash" href="#" data-toggle="tooltip" title="Remove"></a></li>
							</ul>
                    </div>
                <?php
                }
                ?>
            </div>
        <?php
        }
        ?>

    </div>



<?php include_once "../templates/footer.html";?>