<?php

$adsInfos = GetAdsInfos("categories");

?>



<div class="center_mid">

    <?php
    if($adsInfos['heading']['val'] > 0)
    {
    ?> 
    <div class="headband_ads">
        <?php
        echo preg_replace('/height=".*."/', 'height="auto"',
            preg_replace('/width=".*."/', 'width="100%"', 
            GetAds(-1, $adsInfos['heading']['type'])));
        echo preg_replace('/height=".*."/', 'height="auto"',
            preg_replace('/width=".*."/', 'width="100%"', 
            GetAds(-1, $adsInfos['heading']['type'])));
        ?>
    </div>
    <?php
    }
    ?> 

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



    
    <?php
    if($adsInfos['footing']['val'] > 0)
    {
    ?> 
    <div class="headband_ads">
        <?php
        echo preg_replace('/height=".*."/', 'height="auto"',
            preg_replace('/width=".*."/', 'width="100%"', 
            GetAds(-1, $adsInfos['footing']['type'])));
        echo preg_replace('/height=".*."/', 'height="auto"',
            preg_replace('/width=".*."/', 'width="100%"', 
            GetAds(-1, $adsInfos['footing']['type'])));
        ?>
    </div>
    <?php
    }
    ?> 
</div>