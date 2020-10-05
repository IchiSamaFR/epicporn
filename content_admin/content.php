<div class="content">

    <?php

    $rank_perm = Admin_GetRank($_SESSION["Admin"]["id"]);


    $_SESSION["admin_user"] = 13;

    if(isset($_GET["perso"]) && $rank_perm[0] > 0)
    {

    } 
    else if(isset($_GET["vid"]) && $rank_perm[1] > 0)
    {
        include("video.php");
    } 
    else if(isset($_GET["cat"]) && $rank_perm[2] > 0)
    {
        include("categories.php");
    }
    else if(isset($_GET["coms"]) && $rank_perm[3] > 0)
    {
        include("coms.php");
    }  
    else if(isset($_GET["ausers"]) && $rank_perm[4] > 0)
    {
        include("admin_users.php");
    }
    else if(isset($_GET["users"]) && $rank_perm[5] > 0)
    {
        include("users.php");
    }  
    else if(isset($_GET["ad"]) && $rank_perm[6] > 0)
    {
        include("ads.php");
    } else 
    {
        include("dashboard.php");
    }
    ?>

    </div>
</div>