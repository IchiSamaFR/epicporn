
<?php

if(isset($_POST["delete_users"]) && isset($_POST["users"])){
    DeleteUsers($_POST["users"]);
}

?>




<div class="centered">
    <p class="page_title"> Utilisateurs </p>
    <form method="post">
        <div class="table_list page">
            <div class="box title_row border_down coms">
                <p></p>
                <p> Pseudo </p>
                <p> Mail </p>
                <p> Premium </p>
                <p> Date </p>
            </div>
            <?php
                GetUsers();
            ?>
            <div class="box title_row border_up coms">
                <p></p>
                <p> Pseudo </p>
                <p> Mail </p>
                <p> Premium </p>
                <p> Date </p>
            </div>
        </div>
        <div class="actions">
            <input type="submit" class="delete_button" value="Supprimer" 
                name="delete_users" tabindex="200"></input>
        </div>
    </form>
</div>