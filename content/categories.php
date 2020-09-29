
<div class="center_mid">


    <div class="content_header">
        <h3> Toutes les catégories </h3>
    </div>
    <div class="show_vids c20">
        <?php GetCategories() ?>
    </div>

    <div class="content_header">
        <h3> Voir d'autres vidéos </h3>
    </div>
    <div class="show_vids c20">
        <?php
            // SHOW VIDS
            GetVideos(array(
                //  Type of Order
                'orderType' => 'rand',
        
                //  How many
                'count' => 10,
        
                //  Start pos
                'startPos' => 0
            ));
        ?>
    </div>
</div>