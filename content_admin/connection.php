<?php

    if(isset($_POST['submit'])){
        Admin_Connection($_POST['user'], $_POST['pass']);
        echo '<script>window.location.href = "'. GetThisUrl() .'";</script>';
    }

?>



<div class="connec_page">
    <div class="connec_panel">
        <div class="connec_logo">
        </div>
        
        <form method="post" action="" id="loginform" name="loginform">
            <input class="inputField" type="text" placeholder="Nom d'utilisateur" tabindex="10" size="30" value=
                <?php
                if(isset($_POST['user'])){
                    echo '"' . $_POST['user'] . '"';
                } else {
                    echo '""';
                }
                ?>
                id="user_login" name="user" required />

            <input class="inputField" type="password" placeholder="Mot de passe" tabindex="20" size="30" value="" id="user_pass" name="pass" />
            <input type="submit" class="submit" tabindex="100" value="Se connecter" id="submit" name="submit">
        </form>
    </div>
</div>