<div class="centered">
    <p class="page_title"> Tableau de bord </p>
    <div class="all_stats">
        <div class="box stats">
            <p class="type_name"> Nombre de vidéos </p>
            <p class="infos"> <?php echo GetInfos("videos_count") ?> </p>
        </div>
        <div class="box stats">
            <p class="type_name"> Nombre de vues </p>
            <p class="infos"> <?php echo GetInfos("videos_views") ?> </p>
        </div>
        <div class="box stats">
            <p class="type_name"> Nombre de commentaires </p>
            <p class="infos"> <?php echo GetInfos("videos_coms") ?> </p>
        </div>
        <div class="box stats">
            <p class="type_name"> Nombre d'utilisateurs </p>
            <p class="infos"> <?php echo GetInfos("users_count") ?> </p>
        </div>
        <div class="box stats">
            <p class="type_name"> Like stats (%) </p>
            <p class="infos"> <?php echo GetInfos("videos_likes_stats") ?> </p>
        </div>
    </div>
</div>