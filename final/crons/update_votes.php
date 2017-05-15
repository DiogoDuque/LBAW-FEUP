<?php

    $dir = dirname(dirname(__FILE__), 1) . "/";

    include_once ($dir."config/init.php");
    include_once ($BASE_DIR. "database/votes.php");

    updateVotes();