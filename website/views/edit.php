<?php include_once "../templates/header.php"; ?>

<div class="container">
    <h1 class="text-center">Edit Post</h1>

    <form>
        <div class="new-answer">
            <div id="summernote" class="formgroup"><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam viverra feugiat erat posuere
                pellentesque. Nullam gravida lorem dolor, quis dignissim orci elementum sed. Etiam
                sollicitudin nunc eu risus tristique tristique. Mauris at massa elit. Fusce ligula tortor,
                blandit non rhoncus ac, rhoncus vel dui. Suspendisse sit amet sem id sapien volutpat
                interdum non non orci. Quisque vitae nisl ut nunc fringilla vestibulum. Nam porta porttitor
                rhoncus. Duis ultrices sem condimentum, suscipit sem vel, faucibus lectus. Nulla
                pellentesque felis sapien, et porta turpis rhoncus non. Proin nec leo venenatis, iaculis mi
                id, bibendum lorem. Aenean convallis nec elit vitae scelerisque. Vivamus condimentum nunc ac
                leo pretium, eu porttitor risus laoreet. Aliquam accumsan ipsum nec eros euismod, non
                hendrerit felis finibus. Sed scelerisque rhoncus consectetur. Orci varius natoque penatibus
                et magnis dis parturient montes, nascetur ridiculus mus.
                Aliquam ac turpis vel ligula sodales volutpat at in augue. Maecenas eleifend eros id
                consectetur fermentum. Ut hendrerit, nulla ut dictum pellentesque, urna enim efficitur urna,
                sit amet facilisis risus diam nec tellus. Vestibulum egestas justo neque, ac convallis lacus
                gravida eu. Nunc volutpat, libero at porttitor venenatis, sapien dui sollicitudin urna, ut
                feugiat sem metus id tortor. Donec vel rutrum nibh. Lorem ipsum dolor sit amet, consectetur
                adipiscing elit. Suspendisse sed odio mauris. Suspendisse porta purus quis libero hendrerit,
                vel tincidunt diam rutrum. Nam sodales erat sed tellus pellentesque, ac tincidunt eros
                euismod. Praesent tristique dolor sapien, et interdum orci rhoncus vel. Sed odio sem,
                    vulputate nec vulputate maximus, pharetra non est. Vivamus porta sagittis nunc.</p></div>
            <script>
                $(document).ready(function() {
                    $('#summernote').summernote();
                });
            </script>
        </div>

        <button type="submit" class="btn btn-success">Apply</button>
        <button type="reset" class="btn btn-danger">Reset</button>
    </form>
</div>

<?php include_once "../templates/footer.html"; ?>
