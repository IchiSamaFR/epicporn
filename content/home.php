<?php
    if(!isset($check)){
        return;
    }
?>


<div class="center_mid">
    <div class="content_vids">
        <div class="content_header">
            <h3> Vidéos les plus récentes </h3>
            <a href="" class="button"><div class="cross"></div><p> Voir plus </p></a>
        </div>
        <div class="c80c20">
            <div class="show_vids">

            <?php
                // SHOW VIDS
                GetVideos("date", 8, "left");
            ?>
            </div>

            <div class="add right"></div>
        </div>
    </div>

    <div class="content_vids">
        <div class="content_header">
            <h3> Vidéos les plus vues </h3>
            <a href="" class="button"><div class="cross"></div><p> Voir plus </p></a>
        </div>
        <div class="c20c80">
            <div class="add left"></div>
            <div class="show_vids">
            
            <?php
                // SHOW VIDS
                GetVideos("views", 8, "right");
            ?>
            </div>
        </div>
    </div>
</div>
<?php


?>