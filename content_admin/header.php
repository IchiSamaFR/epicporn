
<?php
if(isset($_POST['disconnect'])){
    Admin_Disconnection();
    echo '<script>window.location.href = "'. GetThisUrl() .'";</script>';
}


function NullGet(){
    if(!isset($_GET["perso"]) && !isset($_GET["vid"]) && !isset($_GET["cat"]) && !isset($_GET["coms"]) && !isset($_GET["ausers"]) && !isset($_GET["users"]) && !isset($_GET["ad"])){
        return true;
    }
}

$rank_perm = Admin_GetRank($_SESSION["Admin"]["id"]);

?>


<div class="header sticky">
    <div class="logo left"></div>
    <form method="post" action="" id="loginform" name="loginform">
        <input type="submit" class="disconnect right" tabindex="0" value="Se déconnecter" id="disconnect" name="disconnect">
    </form>
    <p class="user_pres right"> Connecté : xxxx <div class="img"></div></p>
</div>

<?php

    /*  Menu with all nav buttons
    *   If user had the good right, show button
    *   If he's in this page show active
    */
?>

<div class="left_menu sticky">
    <div class="nav_menu">

        <?php
            if($rank_perm[0] != 0){
        ?>
        <a href="admin" class="<?php if(NullGet()){ echo "active"; } ?>">
             Tableau de bord </a>
        <?php
            }
            if($rank_perm[1] != 0){
        ?>
        <a href="?perso" class="<?php if(isset($_GET["perso"])){ echo "active"; }?>">
         Personalisation </a>
         <?php
            }
            if($rank_perm[2] != 0){
        ?>
        <a href="?vid" class="<?php if(isset($_GET["vid"])){ echo "active"; }?>">
         Vidéos </a>
         <?php
            }
            if($rank_perm[3] != 0){
        ?>
        <a href="?cat" class="<?php if(isset($_GET["cat"])){ echo "active"; }?>">
         Catégories </a>
         <?php
            }
            if($rank_perm[4] != 0){
        ?>
        <a href="?coms" class="<?php if(isset($_GET["coms"])){ echo "active"; }?>">
         Commentaires </a>
         <?php
            }
            if($rank_perm[5] != 0){
        ?>
        <a href="?ausers" class="<?php if(isset($_GET["ausers"])){ echo "active"; }?>">
         Administrateurs </a>
         <?php
            }
            if($rank_perm[6] != 0){
        ?>
        <a href="?users" class="<?php if(isset($_GET["users"])){ echo "active"; }?>">
         Utilisateurs </a>
         <?php
            }
            if($rank_perm[7] != 0){
        ?>
        <a href="?ad" class="<?php if(isset($_GET["ad"])){ echo "active"; }?>">
         Publicités </a>
        <?php
            }
        ?>
    </div>
</div>