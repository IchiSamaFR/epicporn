
<?php 

if(isset($_POST["add_cat"])){
    AddCategorie($_POST["category"]);
}
if(isset($_POST["delete_cat"]) && isset($_POST["categories"])){
    DeleteCategories($_POST["categories"]);
}
if(isset($_POST["edit"]) && isset($_POST["categories"])){
    $get = "";
    foreach ($_POST["categories"] as $val){
        $get = $get . "&edit%5B%5D=" . $val;
    }
    echo '<script>window.location.href = "'. GetThisUrl() . $get .'";</script>';
}

if(isset($_POST["edit_cat"])){
    foreach ($_GET["edit"] as $val){
        EditCategoryName($val, $_POST["category_" . $val]);
    }
    echo '<script>window.location.href = "'. GetThisUrl() .'";</script>';
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
                        <input type="submit" class="add_button" value="Ajouter la catégorie" 
                        name="add_cat" tabindex="100"></input>
                        <a class="cancel_button" href="admin.php?cat" tabindex="110"> Annuler </a>
                    </div>
                </form>
            </div>
    <?php
        //          -------------------- EDIT CAT --------------------
        } else if(isset($_GET['edit'])){
        ?>
        <h1 class="page_title"> Modifier des catégories </h1>
            <div class="box new_vid">
                <form method="post">
                    
                    <?php
                    foreach ($_GET["edit"] as $val){
                        $name = GetCategoryName($val);
                        echo '<h3> Ancien nom : '.$name.' </h3>';
                        echo '<input class="textfield" type="text" placeholder="" 
                        tabindex="10" size="" value="'. $name .'" id="cat_name" name="category_'. $val .'"></input>';
                    }
                    ?>

                    </br>
                    </br>

                    <div>
                        <input type="submit" class="add_button" value="Modifier les catégories" 
                        name="edit_cat" tabindex="100"></input>
                        <a class="cancel_button" href="admin.php?cat" tabindex="110"> Annuler </a>
                    </div>
                </form>
            </div>
    <?php
        } else {
            //          -------------------- SHOW ALL CAT --------------------
        ?>
        <div class="">
            <a class="right add_button" href="admin.php?cat&new_cat"> Ajouter une catégorie </a>
            
            <h1 class="page_title"> Catégories </h1>
        </div>

        <form method="post">
            <div class="table_list">
                <div class="box title_row border_down categories">
                    </br>
                    <p> Nom de la catégorie </p>
                </div>

                <?php

                GetCategories("infos");

                ?>

                <div class="box title_row border_up categories">
                    </br>
                    <p> Nom de la catégorie </p>
                </div>
            </div>
            <div class="actions">
                    <input type="submit" class="delete_button" value="Supprimer" 
                        name="delete_cat" tabindex="200"></input>
                    <input type="submit" class="add_button" value="Modifier" 
                        name="edit" tabindex="210"></input>
            </div>
        </form>
        <?php
        }
    ?>
</div>