
<?php 

if($rank_perm[2] > 1)
{
    /* Add new category
     */
    if(isset($_POST["add_cat"])){
        if(is_uploaded_file($_FILES["cat_img"])){
            AddCategory($_POST["category"], $_FILES["cat_img"]);
        }
        else {
            AddCategory($_POST["category"]);
        }
    }
    
    /* Delete categories
     */
    if(isset($_POST["delete_cat"]) && isset($_POST["categories"])){
        DeleteCategories($_POST["categories"]);
    }
    
    /* Edit categories
     * Edit cat
     */
    if(isset($_POST["edit_cat"])){
    
        foreach ($_GET["edit"] as $val){
            if(is_uploaded_file($_FILES["cat_img_" . $val]["tmp_name"])){
                EditCategory($val, $_POST["category_" . $val], $_FILES["cat_img_" . $val]);
            }
            else {
                EditCategory($val, $_POST["category_" . $val]);
            }
        }
        //$url = strtok($_SERVER["REQUEST_URI"], '?');
        //echo '<script>window.location.href = "'. $url .'?cat";</script>';
    }
    
    
    /* For each categories to edit
     * add category to the url
     */
    if(isset($_POST["edit"]) && isset($_POST["categories"])){
        $get = "";
        foreach ($_POST["categories"] as $val){
            $get = $get . "&edit%5B%5D=" . $val;
        }
        echo '<script>window.location.href = "'. GetThisUrl() . $get .'";</script>';
    }
}
?>


<div class="centered">
    <?php
        /*          -------------------- ADD A NEW CAT --------------------
         *
         */
        if(isset($_GET['new_cat']) && $rank_perm[2] > 1){
        ?>
        <h1 class="page_title"> Ajouter une catégorie </h1>
            <form method="post" enctype="multipart/form-data">
                <div class="box new_vid">
                    <h3> Nom de la catégorie </h3>
                    <input class="textfield" type="text" placeholder="" 
                        tabindex="10" size="" value="" id="cat_name" name="category" required />
                    <input type="file" class="add_img" id="cat_img" name="cat_img" accept="image/png, image/jpeg"/>
                </div>

                <div class="actions">
                    <input type="submit" class="add_button" value="Ajouter la catégorie" 
                    name="add_cat" tabindex="100" />
                    <a class="cancel_button" href="admin.php?cat" tabindex="110"> Annuler </a>
                </div>
            </form>
    <?php
        /*          -------------------- EDIT CAT --------------------
         *
         */
        } else if(isset($_GET['edit']) && $rank_perm[2] > 1){
        ?>
        <h1 class="page_title"> Modifier des catégories </h1>
            <form method="post" enctype="multipart/form-data">
                <?php
                foreach ($_GET["edit"] as $val)
                { 
                    $name = GetCategoryName($val);
                    $file = GetCategoryFileName($val);
                    $file = explode('/', $file);
                    $file = $file[sizeof($file) - 1];
                    ?>

                    <div class="box new_vid">
                            <h3> Ancien nom : <?php echo $name ?> </h3>
                            <input class="textfield" type="text" placeholder="" 
                                tabindex="10" size="" value="<?php echo $name ?>" id="cat_name_<?php echo $val ?>" name="category_<?php echo $val ?>" required />
                            
                            <h3> Ancien fichier : <?php echo $file ?> </h3>
                            <input type="file" class="add_img" id="cat_img_<?php echo $val ?>" name="cat_img_<?php echo $val ?>" accept="image/png, image/jpeg"/>
                    </div>
                <?php
                }
                ?>

                <div class="actions">
                    <input type="submit" class="add_button" value="Modifier les catégories" 
                    name="edit_cat" tabindex="100"/>
                    <a class="cancel_button" href="admin.php?cat" tabindex="110"> Annuler </a>
                </div>
            </form>
    <?php
        } else {
            /*          -------------------- SHOW ALL CAT --------------------
            *
            */
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
                    <p> Nom de l'image </p>
                </div>

                <?php
                    GetCategories("list");
                ?>

                <div class="box title_row border_up categories">
                    </br>
                    <p> Nom de la catégorie </p>
                    <p> Nom de l'image </p>
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