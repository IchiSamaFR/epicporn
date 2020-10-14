<?php


if($rank_perm[6] > 1)
{
    if(isset($_POST["edit_ads"]))
    {
        $ads = [];
        foreach ($_POST as $key => $value) {
            if(substr($key, 0, 6) == "check_"){
                array_push($ads, substr($key, 6));
            }
        }
        SetAdsPanel($ads);
    }
}

?>





<div class="centered">
    <p class="page_title"> Paramètres de publicités </p>
    
    <form method="post">
        <div class="all_panels">
            <?php
                GetAdsPanel();
            ?>
        </div>
        <div class="actions">
            <input type="submit" class="add_button" value="Appliquer les modifications" 
                name="edit_ads" tabindex="100"/>
        </div>
    </form>
</div>