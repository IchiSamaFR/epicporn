<div class="content">

    <?php

    $rank_perm = Admin_GetRank($_SESSION["Admin"]["id"]);


    $_SESSION["admin_user"] = 13;

    if(isset($_GET["perso"]))
    {
        if($rank_perm[0] == 0){
            include("dashboard.php");
            return;
        }
    } 
    else if(isset($_GET["vid"]))
    {
        if($rank_perm[1] == 0){
            include("dashboard.php");
            return;
        }
        include("video.php");
    } 
    else if(isset($_GET["cat"]))
    {
        if($rank_perm[2] == 0){
            include("dashboard.php");
            return;
        }
        include("categories.php");
    }
    else if(isset($_GET["coms"]))
    {
        if($rank_perm[3] == 0){
            include("dashboard.php");
            return;
        }
        include("coms.php");
    }  
    else if(isset($_GET["ausers"]))
    {
        if($rank_perm[4] == 0){
            include("dashboard.php");
            return;
        }
        include("admin_users.php");
        
    }
    else if(isset($_GET["users"]))
    {
        if($rank_perm[5] == 0){
            include("dashboard.php");
            return;
        }
        include("users.php");
    }  
    else if(isset($_GET["ad"]))
    {
        if($rank_perm[6] == 0){
            include("dashboard.php");
            return;
        }
        include("ads.php");
    } else 
    {
        include("dashboard.php");
    }
    ?>

    </div>
</div>