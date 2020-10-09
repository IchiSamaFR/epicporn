<?php
    if(!isset($check)){
        return;
    }

    $adsInfos = GetAdsInfos("home");
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


    <section class="content_vids">
        <div class="content_header">
            <h3> Vidéos les plus récentes </h3>
            <a href="?show=date" class="button"><div class="cross"></div><p> Voir plus </p></a>
        </div>

        <?php
        /* -------------- WITH ADS -------------- */
        if($adsInfos['between_vid']['val'] > 0){
        ?>
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
                        preg_replace('/width=".*."/', 'width="100%"', 
                        GetAds(-1, $adsInfos['between_vid']['type'])));
                    echo preg_replace('/height=".*."/', 'height="auto"',
                        preg_replace('/width=".*."/', 'width="100%"', 
                        GetAds(-1, $adsInfos['between_vid']['type'])));
                ?>
            </div>
        </div>

        <?php
        /* -------------- WITHOUT ADS -------------- */
            }
            else
            {
        ?>
            <div class="">
                <div class="show_vids c20">
                <?php
                    // SHOW VIDS
                    GetVideos(array(
                        //  Type of Order
                        'orderType' => 'date',
                        //  How many
                        'count' => 10,
                        //  Start pos
                        'startPos' => 0
                    ));
                ?>
                </div>
            </div>
        <?php
            }
            /* -------------- END WITHOUT ADS -------------- */
        ?>

    </section>

    <section class="content_vids">
        <div class="content_header">
            <h3> Vidéos les plus vues </h3>
            <a href="?show=views" class="button"><div class="cross"></div><p> Voir plus </p></a>
        </div>
        <?php
        /* -------------- WITH ADS -------------- */
        if($adsInfos['between_vid']['val'] > 0){
        ?>
        <div class="c20c80">
            <div class="home_ads left">
                <?php
                    echo preg_replace('/height=".*."/', 'height="auto"',
                        preg_replace('/width=".*."/', 'width="100%"', 
                        GetAds(-1, $adsInfos['between_vid']['type'])));
                    echo preg_replace('/height=".*."/', 'height="auto"',
                        preg_replace('/width=".*."/', 'width="100%"', 
                        GetAds(-1, $adsInfos['between_vid']['type'])));
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

        <?php
        /* -------------- WITHOUT ADS -------------- */
        }
        else
        {
        ?>
            <div class="">
                <div class="show_vids c20">
                <?php
                    // SHOW VIDS
                    GetVideos(array(
                        //  Type of Order
                        'orderType' => 'views',
                        //  How many
                        'count' => 10,
                        //  Start pos
                        'startPos' => 0
                    ));
                ?>
                </div>
            </div>
        <?php
        }
        /* -------------- END WITHOUT ADS -------------- */
        ?>
    </section>
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
<?php


?>