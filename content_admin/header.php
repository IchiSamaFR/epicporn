<div class="header sticky">
    <div class="logo left"></div>
    <a href="" class="disconnect right"> Se déconnecter </a>
    <p class="user_pres right"> Connecté : xxxx <div class="img"></div></p>
</div>

<div class="left_menu sticky">
    <div class="nav_menu">
        <a href="admin" class="<?php if(empty($_GET)){ echo "active"; } ?>">
             Tableau de bord </a>
        <a href="?perso" class="<?php if(isset($_GET["perso"])){ echo "active"; }?>">
         Personalisation </a>
        <a href="?vid" class="<?php if(isset($_GET["vid"])){ echo "active"; }?>">
         Vidéos </a>
        <a href="?cat" class="<?php if(isset($_GET["cat"])){ echo "active"; }?>">
         Catégories </a>
        <a href="?coms" class="<?php if(isset($_GET["coms"])){ echo "active"; }?>">
         Commentaires </a>
        <a href="?users" class="<?php if(isset($_GET["users"])){ echo "active"; }?>">
         Utilisateurs </a>
        <a href="?ad" class="<?php if(isset($_GET["ad"])){ echo "active"; }?>">
         Publicités </a>
    </div>
</div>