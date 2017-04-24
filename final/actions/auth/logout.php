<?php

    include_once "../../config/init.php";
    session_start();
    session_unset();
    session_destroy();
?>

<script>
    window.location.href = "<?=$BASE_URL?>index.php";
</script>