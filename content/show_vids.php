<?php 


?>

<div class="center_mid">
    <div class="content_vids">

    <div class="content_header">
        <h3> <?php
            if($_GET["show"] == "date"){
                echo "Vidéos les plus récentes";
            } else if ($_GET["show"] == "views"){
                echo "Vidéos les plus vues";
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
                        'count' => 6,
                
                        //  Start pos
                        'startPos' => 0
                    ));
                } else if ($_GET["show"] == "views"){
                    // SHOW VIDS
                    GetVideos(array(
                        //  Type of Order
                        'orderType' => 'views',
                
                        //  How many
                        'count' => 6,
                
                        //  Start pos
                        'startPos' => 0
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
                        'count' => 25,
                
                        //  Start pos
                        'startPos' => 6
                    ));
                } else if ($_GET["show"] == "views"){
                    // SHOW VIDS
                    GetVideos(array(
                        //  Type of Order
                        'orderType' => 'views',
                
                        //  How many
                        'count' => 25,
                
                        //  Start pos
                        'startPos' => 6
                    ));
                }
                
                ?>
            </div>
    </div>
    


    </div>
</div>