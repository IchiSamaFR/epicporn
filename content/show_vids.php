<?php 

$vidperpage_top = 6;
$vidperpage = 25;

if(isset($_GET["page"])){
    $startpos = ($_GET["page"] - 1) * ($vidperpage + $vidperpage_top);
} else {
    $startpos = 0;
}
?>

<div class="center_mid">
    <section class="content_vids">

        <div class="content_header">
            <h3> <?php
                if($_GET["show"] == "date"){
                    echo "Vidéos les plus récentes";
                } else if ($_GET["show"] == "views"){
                    echo "Vidéos les plus vues";
                } else if ($_GET["show"] == "category"){
                    echo "Vidéos de catégorie " . GetCategoryShow($_GET["cat"]);
                }
            ?> </h3>
        </div>
        <div class="c60c40">
                <div class="show_vids c33">

                <?php 
                    if($_GET["show"] == "date"){
                        // SHOW VIDS
                        GetVideos(array(
                            //  Type of Order
                            'orderType' => 'date',
                    
                            //  How many
                            'count' => $vidperpage_top,
                    
                            //  Start pos
                            'startPos' => $startpos
                        ));
                    } 
                    else if ($_GET["show"] == "views"){
                        // SHOW VIDS
                        GetVideos(array(
                            //  Type of Order
                            'orderType' => 'views',
                    
                            //  How many
                            'count' => $vidperpage_top,
                    
                            //  Start pos
                            'startPos' => $startpos
                        ));
                    } 
                    else if ($_GET["show"] == "category"){
                        // SHOW VIDS
                        GetVideos(array(
                            //  Type of Order
                            'orderType' => 'category',
                            'catType' => $_GET["cat"],
                    
                            //  How many
                            'count' => $vidperpage_top,
                    
                            //  Start pos
                            'startPos' => $startpos
                        ));
                    }
                    
                    ?>
                </div>

            <div class="add right"></div>
        </div>
        <div class="">
            <div class="show_vids c20">

                <?php 
                    if($_GET["show"] == "date"){
                        // SHOW VIDS
                        GetVideos(array(
                            //  Type of Order
                            'orderType' => 'date',
                    
                            //  How many
                            'count' => $vidperpage,
                    
                            //  Start pos
                            'startPos' => ($startpos + $vidperpage_top)
                        ));
                    } else if ($_GET["show"] == "views"){
                        // SHOW VIDS
                        GetVideos(array(
                            //  Type of Order
                            'orderType' => 'views',
                    
                            //  How many
                            'count' => $vidperpage,
                    
                            //  Start pos
                            'startPos' => ($startpos + $vidperpage_top)
                        ));
                    }
                    else if ($_GET["show"] == "category"){
                        // SHOW VIDS
                        GetVideos(array(
                            //  Type of Order
                            'orderType' => 'category',
                            'catType' => $_GET["cat"],
                    
                            //  How many
                            'count' => $vidperpage,
                    
                            //  Start pos
                            'startPos' => ($startpos + $vidperpage_top)
                        ));
                    }
                    
                    ?>
                </div>
            </div>
        </div>
    </section>
    <?php
        GetNavBar($vidperpage + $vidperpage_top);
    ?>
</div>