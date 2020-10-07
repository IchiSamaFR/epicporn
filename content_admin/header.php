
<?php
if(isset($_POST['disconnect'])){
    Admin_Disconnection();
    echo '<script>window.location.href = "'. GetThisUrl() .'";</script>';
}


$rank_perm = Admin_GetRank($_SESSION["Admin"]["id"]);

function NullGet(){
    $rank_perm = Admin_GetRank($_SESSION["Admin"]["id"]);

    $isTrue;

    if(isset($_GET["perso"]) && $rank_perm[0] > 0){
        return false;
    }
    if (isset($_GET["vid"]) && $rank_perm[1] > 0){
        return false;
    }
    if (isset($_GET["cat"]) && $rank_perm[2] > 0){
        return false;
    }
    if (isset($_GET["coms"]) && $rank_perm[3] > 0){
        return false;
    }
    if (isset($_GET["ausers"]) && $rank_perm[4] > 0){
        return false;
    }
    if (isset($_GET["users"]) && $rank_perm[5] > 0){
        return false;
    }
    if (isset($_GET["ad"]) && $rank_perm[6] > 0){
        return false;
    }
    return true;
}


?>


<header>
    <nav class="header sticky">
        <div class="logo left"></div>
        <form method="post" action="" id="loginform" name="loginform">
            <input type="submit" class="disconnect right" tabindex="0" value="Se déconnecter" id="disconnect" name="disconnect">
        </form>
        <p class="user_pres right"> Connecté : <?php echo $_SESSION['Admin']['login']?> <div class="img"></div></p>
    </nav>

    <?php

        /*  Menu with all nav buttons
        *   If user had the good right, show button
        *   If he's in this page show active
        */
    ?>

    <nav class="left_menu sticky">
        <div class="nav_menu">

            <a href="admin.php" class="<?php if(NullGet()){ echo "active"; } ?>">
                Tableau de bord </a>
            <?php
                if($rank_perm[0] != 0){
            ?>
            <a href="?perso" class="<?php if(isset($_GET["perso"])){ echo "active"; }?>">
            Personalisation </a>
            <?php
                }
                if($rank_perm[1] != 0){
            ?>
            <a href="?vid" class="<?php if(isset($_GET["vid"])){ echo "active"; }?>">
            Vidéos </a>
            <?php
                }
                if($rank_perm[2] != 0){
            ?>
            <a href="?cat" class="<?php if(isset($_GET["cat"])){ echo "active"; }?>">
            Catégories </a>
            <?php
                }
                if($rank_perm[3] != 0){
            ?>
            <a href="?coms" class="<?php if(isset($_GET["coms"])){ echo "active"; }?>">
            Commentaires </a>
            <?php
                }
                if($rank_perm[4] != 0){
            ?>
            <a href="?ausers" class="<?php if(isset($_GET["ausers"])){ echo "active"; }?>">
            Administrateurs </a>
            <?php
                }
                if($rank_perm[5] != 0){
            ?>
            <a href="?users" class="<?php if(isset($_GET["users"])){ echo "active"; }?>">
            Utilisateurs </a>
            <?php
                }
                if($rank_perm[6] != 0){
            ?>
            <a href="?ad" class="<?php if(isset($_GET["ad"])){ echo "active"; }?>">
            Publicités </a>
            <?php
                }
            ?>
        </div>
    </nav>
</header>