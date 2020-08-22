<?php

    /*
    *   Set of the older age or not
    */

	session_start();
    $_SESSION['older'] = "true";
    return $_SESSION["older"];
?>