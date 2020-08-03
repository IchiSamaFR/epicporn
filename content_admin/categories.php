
<?php 

if(!isset($_SESSION['cache_categories'])){
    $_SESSION['cache_categories'] = "";
}
if(isset($_POST["add_vid"]) && $_POST["add_vid"] != ""){
    AddCategorie($_POST["category"]);
}
?>


<div class="centered">
    <?php
        //          -------------------- ADD A NEW CAT --------------------
        if(isset($_GET['new_cat'])){
        ?>
        <h1 class="page_title"> Ajouter une catégorie </h1>
            <div class="box new_vid">
                <form method="post">

                    <h3> Nom de la catégorie </h3>
                    <input class="textfield" type="text" placeholder="" 
                    tabindex="10" size="" value="" id="cat_name" name="category"></input>

                    </br>
                    </br>

                    <div>
                        <input type="submit" class="add_button" href="admin.php?vid&new_vid" value="Ajouter la catégorie" 
                        name="add_vid" tabindex="100"></input>
                        <a class="cancel_button" href="admin.php?vid" tabindex="110"> Annuler </a>
                    </div>
                </form>
            </div>
        <?php
        } else {
        ?>
        <div class="">
            <a class="right add_button" href="admin.php?cat&new_cat"> Ajouter une catégorie </a>
            
            <h1 class="page_title"> Catégories </h1>
        </div>

        <div class="table_list">
            <div class="box title_row border_down category">
                <p> Nom de la catégorie </p>
            </div>

            <?php

            GetCategories("infos");

            ?>

            <div class="box title_row border_up category">
                <p> Nom de la catégorie </p>
            </div>
        </div>
    <?php
        }
    ?>
</div>