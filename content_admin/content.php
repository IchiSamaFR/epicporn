<div class="content">

    <?php

    $_SESSION["admin_user"] = 13;

    if(isset($_GET["perso"]))
    {

    } 
    else if(isset($_GET["vid"]))
    {
        include("video.php");
    } 
    else if(isset($_GET["coms"]))
    {
        include("coms.php");
    } 
    else if(isset($_GET["users"]))
    {

    } 
    else if(isset($_GET["cat"]))
    {
        include("categories.php");
    } 
    else if(isset($_GET["ad"]))
    {
        include("ads.php");
    } else 
    {
        include("dashboard.php");
    }
    ?>

    </div>
</div>