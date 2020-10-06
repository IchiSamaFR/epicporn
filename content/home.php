<?php
    if(!isset($check)){
        return;
    }
?>


<div class="center_mid">
    <section class="content_vids">
        <div class="content_header">
            <h3> Vidéos les plus récentes </h3>
            <a href="?show=date" class="button"><div class="cross"></div><p> Voir plus </p></a>
        </div>
        <div class="c80c20">
            <div class="show_vids c25">

            <?php
                // SHOW VIDS
                GetVideos(array(
                    //  Type of Order
                    'orderType' => 'date',
            
                    //  How many
                    'count' => 8,
            
                    //  Start pos
                    'startPos' => 0
                ));
            ?>
            </div>

            <div class="home_ads right">
                <?php
                    echo preg_replace('/height=".*."/', 'height="auto"',
                        preg_replace('/width=".*."/', 'width="100%"', GetAds(1)));
                    echo preg_replace('/height=".*."/', 'height="auto"',
                        preg_replace('/width=".*."/', 'width="100%"', GetAds(2)));
                ?>
            </div>

        </div>
    </section>

    <section class="content_vids">
        <div class="content_header">
            <h3> Vidéos les plus vues </h3>
            <a href="?show=views" class="button"><div class="cross"></div><p> Voir plus </p></a>
        </div>
        <div class="c20c80">
            <div class="home_ads left">
                <?php
                    echo preg_replace('/height=".*."/', 'height="auto"',
                        preg_replace('/width=".*."/', 'width="100%"', GetAds(1)));
                    echo preg_replace('/height=".*."/', 'height="auto"',
                        preg_replace('/width=".*."/', 'width="100%"', GetAds(2)));
                ?>
            </div>
            <div class="show_vids c25">
            
            <?php
                // SHOW VIDS
                GetVideos(array(
                    //  Type of Order
                    'orderType' => 'views',
            
                    //  How many
                    'count' => 8,
            
                    //  Start pos
                    'startPos' => 0
                ));
            ?>
            </div>
        </div>
    </section>
</div>
<?php


?>