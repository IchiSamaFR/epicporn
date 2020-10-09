<?php 

$vidperpage_top = 6;
$vidperpage = 25;

$adsInfos = GetAdsInfos("show_vids");

if($adsInfos["side"]["val"] == 0)
{
    $vidperpage_top = 0;
}

if(isset($_GET["page"])){
    $startpos = ($_GET["page"] - 1) * ($vidperpage + $vidperpage_top);
} else {
    $startpos = 0;
}
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


        <?php
        if($adsInfos["side"]["val"] > 0)
        {
        ?>
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

            <div class="solo_ads right" style="margin-top:50%; margin-bottom: -100px; transform: translate(0, -50%);">
                
                    <?php
                    if($adsInfos["side"]["val"] > 0)
                    {
                        ?>
                        <?php
                            echo preg_replace('/height=".*."/', 'height="auto"',
                                preg_replace('/width=".*."/', 'width="60%"', GetAds(1)));
                        ?>
                        <?php
                    }
                    ?>
            </div>
        </div>

        <?php
        }
        ?>

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
    </section>
    <?php
        GetNavBar($vidperpage + $vidperpage_top);
    ?>
    
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