
<?php 

if(isset($_POST["add_cat"])){
    AddCategory($_POST["category"]);
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
    $url = strtok($_SERVER["REQUEST_URI"], '?');
    echo '<script>window.location.href = "'. $url .'?cat";</script>';
}
?>


<div class="centered">
    <?php
        //          -------------------- ADD A NEW CAT --------------------
        if(isset($_GET['new_cat']) && $rank_perm[2] > 1){
        ?>
        <h1 class="page_title"> Ajouter une catégorie </h1>
            <form method="post">
                <div class="box new_vid">
                    <h3> Nom de la catégorie </h3>
                    <input class="textfield" type="text" placeholder="" 
                        tabindex="10" size="" value="" id="cat_name" name="category"></input>
                </div>

                <div class="actions">
                    <input type="submit" class="add_button" value="Ajouter la catégorie" 
                    name="add_cat" tabindex="100"></input>
                    <a class="cancel_button" href="admin.php?cat" tabindex="110"> Annuler </a>
                </div>
            </form>
    <?php
        //          -------------------- EDIT CAT --------------------
        } else if(isset($_GET['edit']) && $rank_perm[2] > 1){
        ?>
        <h1 class="page_title"> Modifier des catégories </h1>
            <form method="post">
                <?php
                foreach ($_GET["edit"] as $val)
                { 
                    $name = GetCategoryName($val);
                    ?>

                <div class="box new_vid">
                        <h3> Ancien nom : <?php echo $name ?> </h3>
                        <input class="textfield" type="text" placeholder="" 
                        tabindex="10" size="" value="<?php echo $name ?>" id="cat_name" name="category_<?php echo $val ?>"></input>
                </div>
                <?php
                }
                ?>

                <div class="actions">
                    <input type="submit" class="add_button" value="Modifier les catégories" 
                    name="edit_cat" tabindex="100"></input>
                    <a class="cancel_button" href="admin.php?cat" tabindex="110"> Annuler </a>
                </div>
            </form>
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

            <?php
            if($rank_perm[2] > 1){
            ?>

            <div class="actions">
                    <input type="submit" class="delete_button" value="Supprimer" 
                        name="delete_cat" tabindex="200"></input>
                    <input type="submit" class="add_button" value="Modifier" 
                        name="edit" tabindex="210"></input>
            </div>
            
            <?php
            }
            else 
            {
            ?>

            <div class="actions">
            </div>

            <?php
            }
            ?>
        </form>
        <?php
        }
    ?>
</div>