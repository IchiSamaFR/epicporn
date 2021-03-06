
<?php 


if($rank_perm[1] > 1)
{
    if(isset($_POST["add_vid"]) && $_POST["add_vid"] != ""){
        if(!isset($_POST["categories"])){
            $_POST["categories"] = null;
        }
        $error = AddVideo($_POST["embed"], $_POST["title"], $_POST["categories"]);
    }
    if(isset($_POST["delete_vid"]) && isset($_POST["videos"])){
        DeleteVideos($_POST["videos"]);
    }

    if(isset($_POST["modify_vid"]) && isset($_POST["videos"])){
        $get = "";
        foreach ($_POST["videos"] as $val){
            $get = $get . "&edit%5B%5D=" . $val;
        }
        echo '<script>window.location.href = "'. GetThisUrl() . $get .'";</script>';
    }

    if(isset($_POST["edit_vid"])){
        foreach ($_GET["edit"] as $val){
            EditVideo($val, $_POST["title_" . $val], $_POST["embed_" . $val], $_POST["categories_" . $val]);
        }
        $url = strtok($_SERVER["REQUEST_URI"], '?');
        echo '<script>window.location.href = "'. $url .'?vid";</script>';
    }
}
?>

<div class="centered">

    <?php
        //          -------------------- ADD A NEW VIDEO --------------------
        if(isset($_GET['new_vid']) && $rank_perm[1] > 1){
            ?>

            <h1 class="page_title"> Ajouter une vidéo </h1>
            <div class="box new_vid">
                <form method="post">

                    <h3> Titre de la vidéo </h3>
                    <input class="textfield" type="text" placeholder="" 
                    tabindex="20" size="" value="" id="vid_name" name="title" required />
                        
                    <h3> Embed de la vidéo </h3>
                    <textarea name="embed" id="embed" class="textfield" required></textarea>


                    <h3> Catégories associés </h3>
                    <div class="choose_categories">
                        <?php 
                            GetCategories("add_vid"); 
                        ?>
                    </div>

                    </br>

                    <div>
                        <input type="submit" class="add_button" value="Ajouter la vidéo" 
                        name="add_vid" tabindex="100" />
                        <a class="cancel_button" href="admin.php?vid" tabindex="110"> Annuler </a>
                    </div>
                </form>
            </div>

    <?php
            //          -------------------- EDIT VIDEO --------------------
            } else if(isset($_GET['edit']) && $rank_perm[1] > 1){
            ?>

            <h1 class="page_title"> Ajouter une vidéo </h1>
            <form method="post">
                <?php
                foreach ($_GET["edit"] as $val){
                ?>
                <div class="box new_vid">

                        <h3> Ancien titre : <?php echo GetVideoTitle($val); ?> </h3>
                        <input class="textfield" type="text" placeholder="" 
                        tabindex="20" size="" value="<?php echo GetVideoTitle($val); ?>" id="vid_name" name="title_<?php echo $val; ?>" required />
                            
                        <h3> Embed de la vidéo </h3>
                        <textarea name="embed_<?php echo $val; ?>" id="embed" class="textfield" required><?php echo GetVideoEmbed($val);?></textarea>


                        <h3> Catégories associés </h3>
                        <div class="choose_categories">
                            <?php 
                                GetCategories("add_vid", $val); 
                            ?>
                        </div>

                </div>
                <?php
                }
                ?>

                <div class="actions">
                    <input type="submit" class="add_button" value="Editer les vidéos" 
                    name="edit_vid" tabindex="100" />
                    <a class="cancel_button" href="admin.php?vid" tabindex="110"> Annuler </a>
                </div>
            </form>

    <?php
        } else {
        //          -------------------- SHOW ALL VIDEOS --------------------
        ?>


        <div class="">
            <a class="right add_button" href="admin.php?vid&new_vid"> Ajouter une vidéo </a>
            
            <h1 class="page_title"> Vidéos </h1>
        </div>

        <form method="post">
            <div class="table_list page">
                <div class="box title_row border_down video">
                    </br>
                    <p> Titre de la vidéo </p>
                    <p> Catégories </p>
                </div>

                <?php
                    GetVideos("list");
                ?>
                
                <div class="box title_row border_up video">
                    </br>
                    <p> Titre de la vidéo </p>
                    <p> Catégories </p>
                </div>
            </div>
            
            <?php if($rank_perm[1] > 1){ ?>
                <div class="actions">
                        <input type="submit" class="delete_button" value="Supprimer" 
                            name="delete_vid" tabindex="200"></input>
                        <input type="submit" class="add_button" value="Modifier" 
                            name="modify_vid" tabindex="210"></input>
                </div>
            <?php } else { ?>
                <div class="actions">
                </div>
            <?php } ?>
        </form>

    <?php
        }
    ?>
</div>


<script>
    /*
    $(document).ready(function() {
        $('.toggle_cat').click(function(){
            var t = $(this).attr('id');

            if(document.getElementById(t).classList.contains("active")){
                document.getElementById(t).classList.remove("active");
                document.getElementById("toggle_" + t).classList.remove("toggle_btn");
            } else {
                document.getElementById(t).classList.add("active");
                document.getElementById("toggle_" + t).classList.add("toggle_btn");
            }
            
            $.ajax({ url: 'functions/admin_addtolist.php',
                data: {
                    category: t,
                    set: "vids"
                },
                type: 'GET',
                success: function(output) {
                            //alert(output);
                        }
            });
        });
    });
    */

</script>