<?php
    if(!isset($check)){
        return;
    }

    AddView($_GET["vid"]);
    //1350px
?>

<div class="center_mid">
    <div class="single_vid_player">
        <div class="responsive_player">
            <div id="video_frame">
                <?php echo GetVideo_Embed($_GET["vid"]); /*
                <iframe width="99%" height="560" src="https://txxx.com/embed/4489015/" frameborder="0" 
                allowfullscreen webkitallowfullscreen mozallowfullscreen oallowfullscreen msallowfullscreen></iframe>
                */
                ?>
            </div>
        </div>

        <div class="ads">
            <div class="first_ads">
                <a href="https://t.grtya.com/2ktqza69z4?url_id=0&amp;aff_id=129893&amp;offer_id=6224&amp;bo=2779,2778,2777,2776,2775&amp;file_id=392320&amp;po=6533" target="_blank"><img src="https://www.imglnkd.com/6224/008698A_JRKM_18_ALL_EN_71_L.gif" width="300" height="250" border="0" class="loaded" data-was-processed="true"></a>
            </div>
            <div class="second_ads">
                <a href="https://t.bawafx.com/95jxt8d1s0?url_id=0&amp;aff_id=129893&amp;offer_id=3785&amp;bo=2753,2754,2755,2756&amp;file_id=288650&amp;po=6456" target="_blank"><img src="https://www.imglnkd.com/3785/20180402102149-005096A_GDAT_18_ALL_FR_71_L.gif" width="300" height="250" border="0" class="loading" data-was-processed="true"></a>
            </div>
        </div>
        
        <div class="footer_vid">
            <div class="center">
                <h1 class="vid_title"><?php echo GetVideo_Name($_GET["vid"]); ?> </h1>
                <div class="categories">
                    <?php GetVideo_Categories($_GET["vid"]); ?>
                </div>
            </div>


        </div>
        <div class="footer_vid left"> <h4><?php echo GetVideo_Views($_GET["vid"]) ?> </h4> <p> vues </p></div>
    </div>


    </br>
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

    <script>
        $(document).ready(function() {
            if($(window).width() > 1250){
                var childs = document.getElementById("video_frame").children;
                childs[0].height = "520";
                childs[0].width = "99%";
            } else {
                var childs = document.getElementById("video_frame").children;
                childs[0].height = "220";
                childs[0].width = "99%";
            }
        });
    </script>
</div>