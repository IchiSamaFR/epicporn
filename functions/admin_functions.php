<?php

require_once(__DIR__ . '/../config.php');


function CreateNewUser($mail, $username, $password){
    $dbh = BddConnect();

}

//          -------------------- CONNECTIONS --------------------

function Admin_Connection($username, $password){

    $username = CleanText($username);
    $password = CleanText($password);

    $password = hash('md5', $password, false);
    
	$request = "SELECT * FROM admin_users 
    WHERE username='" . $username . "'
    AND password='" . $password . "'";

    
    $result = GetSQLRequest_NoFetchArray($request);
    
    if(mysqli_num_rows($result) > 0){
        $data = mysqli_fetch_assoc($result);
        $_SESSION['Admin'] = array(
            'login' => $username, 
            'pass' => $password,
            'id' => $data['id']
        );
    } else {
        return "Mauvais identifiants.";
    }
}

function Admin_Disconnection(){
    unset($_SESSION['Admin']);
}

function Admin_GetRank($id){

    $request = "SELECT ranks.rank_right as right
    FROM ranks
    INNER JOIN admin_users
    ON ranks.id = admin_users.rank
    WHERE admin_users.id=". $id;

    $result = GetSQLRequest($request);

    return $result[0];

}

//          -------------------- VIDEOS --------------------

function AddVideo($embed, $title, $cat){

    if($title == ""){
        return "Titre null";
    } else if (!IsEmbed($embed)){
        return "Impossible de récuperer l'embed";
    }

    $title = CleanText($title);
    $embedInsert = CleanText($embed);


    
    //  Create new video
    $request = "INSERT INTO `videos` 
    (`id`, `title`, `embed`, `date`, `author`, `status`, `url_name`) 
    VALUES 
    (NULL, '".$title."', '". $embedInsert ."', (SELECT NOW()), '". $_SESSION['Admin']['id'] . "', 'published', '')";

    if($result = SendSQLRequest($request)){
        $last_id = $result->insert_id;

        //  If there is a category
        if($cat != null){
            $request = "INSERT INTO `videos_meta` 
            (`meta_id`, `post_id`, `meta_key`, `meta_value`)
            VALUES ";
            
            $x = 0;
            //  Foreach cat, add it to the sql request
            foreach ($cat as $val){
                if($x > 0){
                    $request = $request . ",";
                }
                $x ++;
                if($val != ""){
                    $request = $request . "(null, ". $last_id .",'category','". $val ."')";
                }
            }
            $request = rtrim($request, ", ");
            $request = $request . ";";

            if(!$result = SendSQLRequest($request)){
                echo($result);
            }
        }
        
        $thumb_url = GetThumbnail($embed);
        $request = "INSERT INTO `videos_meta` 
        (`meta_id`, `post_id`, `meta_key`, `meta_value`)
        VALUES (null, ". $last_id .",'thumbnail','". $thumb_url ."')
        ";
        if(!$result = SendSQLRequest($request)){
            echo($result);
        }
        
        $request = "INSERT INTO `videos_meta` 
        (`meta_id`, `post_id`, `meta_key`, `meta_value`)
        VALUES (null, ". $last_id .",'views','0');";

        if(!$result = SendSQLRequest($request)){
            echo($result);
        }

    } else {
        return ($result -> error);
    }
}

//  Check if the embed had a source
function IsEmbed($string){
    $thumb_array = explode('src="', $string);
    if(sizeof($thumb_array) > 1){
        return true;
    } else {
        return false;
    }
}

//  Return the thumbnail
function GetThumbnail($string){

    $thumb_array = explode('src="', $string);
    if(sizeof($thumb_array) > 1){
        $thumb_array = explode('"', $thumb_array[1]);
    } else {
        return false;
    }

    //  Thumbnail
    $vid_url = $thumb_array[0];
    if(stristr($vid_url, "txxx.com"))
    {
        $thumb_array = explode('/', $vid_url);
        $thousand = $thumb_array[sizeof($thumb_array) - 2];
        $thumb_url = "https://cdn37804682.ahacdn.me/contents/videos_screenshots/" . substr($thousand, 0, -3) . "000" . "/" . $thousand . "/288x162/1.jpg";
    }
    else if(stristr($vid_url, "upornia.com"))
    {
        $thumb_array = explode('/', $vid_url);
        $thousand = $thumb_array[sizeof($thumb_array) - 2];
        $thumb_url = "https://static2.upornia.org/contents/videos_screenshots/" . substr($thousand, 0, -3) . "000" . "/" . $thousand . "/268x201/1.jpg";
    }
    else if(stristr($vid_url, "hdzog.com"))
    {
        $thumb_array = explode('/', $vid_url);
        $thousand = $thumb_array[sizeof($thumb_array) - 2];
        $thumb_url = "https://cdn49752055.ahacdn.me/contents/videos_screenshots//" . substr($thousand, 0, -3) . "000" . "/" . $thousand . "/300x169/1.jpg";
    } else {
        return false;
    }
    return $thumb_url;
}

function DeleteVideos($videos){
    $videos = CleanText($videos);

    $videosToSql = "";
    $videosMetaToSql = "";
    $videosComsToSql = "";

    $x = sizeof($videos);
    foreach($videos as $vid){
        $x = $x - 1;
        $videosToSql = $videosToSql . "id=" . $vid . " ";
        $videosMetaToSql = $videosMetaToSql . "post_id=" . $vid . " ";
        $videosComsToSql = $videosComsToSql . "id_video=" . $vid . " ";

        if($x != 0) {
            $videosToSql = $videosToSql . "OR ";
            $videosMetaToSql = $videosMetaToSql . "OR ";
            $videosComsToSql = $videosComsToSql . "OR ";
        }
    }

    //  Delete from categories
    $request = "DELETE FROM `videos` 
    WHERE " . $videosToSql;

    if(!$res = SendSQLRequest($request)){
        echo($res);
    }
    
    //  Delete categories from meta videos
    $request = "DELETE FROM `videos_meta` 
    WHERE " . $videosMetaToSql;

    if(!$res = SendSQLRequest($request)){
        echo($res);
    }

    //  Delete categories from meta videos
    $request = "DELETE FROM `coms` 
    WHERE " . $videosComsToSql;

    if(!$res = SendSQLRequest($request)){
        echo($res);
    }
}

function GetVideos($by){
    if($by == "infos"){
        $x = 0;
        
        $request = "SELECT id, title, embed
        FROM videos
        LIMIT 50";

        $result = GetSQLRequest_NoFetchArray($request);

        while($row = mysqli_fetch_array($result)){
            ?>

            <div class="box 
            <?php
                if ($x%2 == 0){
                    echo "pair";
                }
            ?> 
            video">
            
                <label class="container">
                  <input type="checkbox" name="videos[]" value="<?php echo $row["id"] ?>">
                  <span class="checkmark"></span>
                </label>
                <p> <a href="?vid&edit[]=<?php echo $row["id"] ?>"><?php echo $row["title"] ?> </a> </p>
                <div> 
                    <?php 


                    $secondRequest = "SELECT videos_meta.meta_value as id, categories.name as name
                    FROM videos_meta
                    INNER JOIN categories 
                    ON videos_meta.meta_value = categories.id
                    WHERE videos_meta.post_id=". $row["id"] .
                    " ORDER BY name ASC";

                    $secondResult = GetSQLRequest_NoFetchArray($secondRequest);

                    echo '<p>';
                    while($secondRow = mysqli_fetch_array($secondResult)){
                        echo '<a href="">' . $secondRow['name'] . '</a> ';
                    }
                    echo '</p>';
                    ?> 
                </div>
            </div>

            <?php
            $x = $x + 1;
        }
    }
}

function GetVideoTitle($id){
    $id = CleanText($id);
    $request = "SELECT title
    FROM videos
    WHERE id=" . $id;

    $result = GetSQLRequest($request);
    return $result[0];
}

function GetVideoEmbed($id){
    $id = CleanText($id);
    $request = "SELECT embed
    FROM videos
    WHERE id=" . $id;

    $result = GetSQLRequest($request);
    
    return $result[0];
}

function EditVideo($id, $title, $embed, $categories){
    $id = CleanText($id);
    $title = CleanText($title);

    
    if(!IsEmbed($embed)){
        return "Embed non correcte";
    }

    $embedInsert = CleanText($embed);

    $request = "UPDATE videos
    SET title='". $title ."' AND embed='". $embed ."' AND author='". $_SESSION['Admin']['id'] ."'
    WHERE id=". $id;

    if($result = SendSQLRequest($request)){
        $request = "DELETE FROM videos_meta
        WHERE post_id=". $id . " AND meta_key='category'";

        $result = SendSQLRequest($request);

        //  If there is a category
        if($categories != null){
            $request = "INSERT INTO `videos_meta` 
            (`meta_id`, `post_id`, `meta_key`, `meta_value`)
            VALUES ";
            
            $x = 0;
            //  Foreach categories, add it to the sql request
            foreach ($categories as $val){
                if($x > 0){
                    $request = $request . ",";
                }
                $x ++;
                if($val != ""){
                    $request = $request . "(null, ". $id .",'category','". $val ."')";
                }
            }
            $request = rtrim($request, ", ");
            $request = $request . ";";

            SendSQLRequest($request);
        }
    }
}
//          -------------------- CATEGORIES --------------------

function AddCategorie($name){
    $name = CleanText($name);

    //  Create new video
    $request = "INSERT INTO `categories` 
    (`id`, `name`) 
    VALUES 
    (NULL, '".$name."')";

    if(!$res = SendSQLRequest($request)){
        echo($res);
    }
}

function DeleteCategories($categories){

    $categoriesToSql = "";
    $videosCatToSql = "";
    $x = sizeof($categories);
    foreach($categories as $cat){
        $x = $x - 1;
        $categoriesToSql = $categoriesToSql . "id=" . $cat . " ";

        $videosCatToSql = $videosCatToSql . "meta_value=" . $cat . " ";

        if($x != 0) {
            $categoriesToSql = $categoriesToSql . "OR ";
            $videosCatToSql = $videosCatToSql . "OR ";
        }
    }

    //  Delete from categories
    $request = "DELETE FROM `categories` 
    WHERE " . $categoriesToSql;

    if(!$res = SendSQLRequest($request)){
        echo($res);
    }
    
    //  Delete categories from meta videos
    $request = "DELETE FROM `videos_meta` 
    WHERE meta_key='category' AND (" . $videosCatToSql . ")";

    if(!$res = SendSQLRequest($request)){
        echo($res);
    }
}

function GetCategories($by, $id = -1){

    $id = CleanText($id);

    if($by == "infos"){
        $x = 0;
        
        $request = "SELECT id, name
        FROM categories
        ORDER BY name ASC
        LIMIT 50";

        $result = GetSQLRequest_NoFetchArray($request);

        while($row = mysqli_fetch_array($result)){
            ?>

            <div class="box categories <?php
            if ($x%2 == 0){
                echo "pair";
            }?> 
            ">
                <label class="container">
                  <input type="checkbox" name="categories[]" value="<?php echo $row["id"] ?>">
                  <span class="checkmark"></span>
                </label>
                <p> <a href="?cat&edit%5B%5D=<?php echo $row["id"] ?>"><?php echo $row["name"] ?> </a> </p>
            </div>
            <?php

            $x = $x + 1;
        }
    } 
    else if ($by == "new_vid" && $id == -1){
        $request = "SELECT id, name
        FROM categories
        ORDER BY name ASC";

        $result = GetSQLRequest_NoFetchArray($request);

        while($row = mysqli_fetch_array($result)){
            ?>
            
                <label class="container"> <p> <?php echo $row["name"] ?> </p>
                  <input type="checkbox" name="categories[]" value="<?php echo $row["id"] ?>">
                  <span class="checkmark"></span>
                </label>
            <?php
        }
    } else if ($by == "new_vid" && $id >= 0){


        $arrayCat = array();
        $arrayCat[] = null;
        $request = "SELECT meta_value
        FROM videos_meta
        WHERE meta_key='category' AND post_id=" . $id;

        $result = GetSQLRequest_NoFetchArray($request);
        while($row = mysqli_fetch_array($result)){
            $arrayCat[] = $row['meta_value'];
        }


        $request = "SELECT id, name
        FROM categories
        ORDER BY name ASC";

        $result = GetSQLRequest_NoFetchArray($request);

        while($row = mysqli_fetch_array($result)){
            ?>
            
                <label class="container"> <p> <?php echo $row["name"]; ?> </p>
                    <input type="checkbox" name="categories_<?php echo $id; ?>[]" value="<?php echo $row["id"] ?>" 
                    <?php 
                    if(array_search($row["id"], $arrayCat))
                    {
                        echo " checked";
                    }
                    ?>>
                    <span class="checkmark"></span>
                </label>
            <?php
        }
    }
}

function GetCategoryName($id){
    $id = CleanText($id);
    $request = "SELECT name
    FROM categories
    WHERE id=" . $id;

    $result = GetSQLRequest($request);
    return $result[0];
}

function EditCategoryName($id, $name){
    $id = CleanText($id);
    $name = CleanText($name);
    $request = "UPDATE categories
    SET name='". $name ."'
    WHERE id=". $id;

    $result = SendSQLRequest($request);
}

//          -------------------- GET FUNCTIONS --------------------

function GetInfos($type){
    /*  **********************TO ADD WHEN IT'S FINISHED****************************


    if(isset($_SESSION["admin_rank"]) && $_SESSION["admin_rank"] <= 1){

    }*/
    
    if($type == "videos_count"){
        $request = "SELECT count(*) 
        FROM videos";

        $result = GetSQLRequest($request);
        return $result[0];
    } 
    else if ($type == "videos_views"){
        $request = "SELECT SUM(`meta_value`) 
        FROM `videos_meta` 
        WHERE meta_key = 'views'";

        $result = GetSQLRequest($request);
        return $result[0];
    } 
    else if ($type == "videos_coms"){
        $request = "SELECT count(*) 
        FROM `coms`";

        $result = GetSQLRequest($request);
        return $result[0];
    } 
    else if ($type == "videos_likes_stats"){
        $request = "SELECT SUM(`meta_value`) 
        FROM `videos_meta` 
        WHERE meta_key = 'likes', 
        SELECT SUM(`meta_value`) 
        FROM `videos_meta` 
        WHERE meta_key = 'dislikes'";

        $result = GetSQLRequest($request);
        if($result[0] != 0 && $result[1] != 0)
        {
            return $result[0] / ($result[0] + $result[1]) ;
        } else if ($result[0] != 0)
        {
            return 100;
        } else if ($result[1] != 0)
        {
            return 0;
        } else 
        {
            return 0;
        }
    } 
    else if ($type == "users_count"){
        $request = "SELECT count(*) FROM epic_users";

        $result = GetSQLRequest($request);
        return $result[0];
    }
}

function GetComs($page = 1, $rowPerPage = 20){
    $page = CleanText($page);

    $x = 0;
    $pair = 0;
    
    $rowsToGet = $page * $rowPerPage;
    $request = "SELECT coms.id as coms_id, coms.id_author, epic_users.username as author, videos.title as video, coms.content, coms.date 
    FROM coms
    INNER JOIN epic_users 
    ON coms.id_author = epic_users.id
    INNER JOIN videos 
    ON coms.id_video = videos.id
    LIMIT ". $rowsToGet;

    $result = GetSQLRequest_NoFetchArray($request);

    while($row = mysqli_fetch_array($result)){

        $x = $x + 1;
        if(!($x <= $rowsToGet - $rowPerPage || $x > $rowsToGet)){
            $pair ++;
        ?>
        <div class="box 
        <?php
        if ($pair%2 == 0){
            echo "pair";
        }?>
         coms">
            <label class="container">
              <input type="checkbox" name="coms[]" value="<?php echo $row["coms_id"] ?>">
              <span class="checkmark"></span>
            </label>
            <div class="author">
                <p> <?php echo $row["author"]; ?> </p>
            </div>
            <div class="comment">
                <p> <?php echo $row["content"]; ?>
                    </br>
                </p>
            </div>
            <div class="video">
                <p> <?php echo $row["video"]; ?> </p>
            </div>
            <div class="date">
                <p> <?php echo $row["date"]; ?> </p>
            </div>
        </div>
        <?php
        }
    }
}
function GetUsers($by = "infos"){
    if($by == "infos"){
        $x = 0;
        
        $request = "SELECT id, username, mail, premium, dateRegistred
        FROM epic_users
        ORDER BY dateRegistred ASC
        LIMIT 50";

        $result = GetSQLRequest_NoFetchArray($request);

        while($row = mysqli_fetch_array($result)){
            if($row["premium"] == ""){
                $row["premium"] = "null";
            }
            ?>

            <div class="box coms <?php
            if ($x%2 == 0){
                echo "pair";
            }?> 
            ">
                <label class="container">
                  <input type="checkbox" name="users[]" value="<?php echo $row["id"] ?>">
                  <span class="checkmark"></span>
                </label>
                <p> <a href=""><?php echo $row["username"] ?> </a> </p>
                <p> <a href=""><?php echo $row["mail"] ?> </a> </p>
                <p> <a href=""><?php echo $row["premium"] ?> </a> </p>
                <p> <a href=""><?php echo $row["dateRegistred"] ?> </a> </p>
            </div>
            <?php

            $x = $x + 1;
        }
    }
}

function DeleteComs($coms){
    $coms = CleanText($coms);

    $comsToSql = "";

    $x = sizeof($coms);
    foreach($coms as $com){
        $x = $x - 1;
        $comsToSql = $comsToSql . "id=" . $com . " ";

        if($x != 0) {
            $comsToSql = $comsToSql . "OR ";
        }
    }

    //  Delete from categories
    $request = "DELETE FROM `coms` 
    WHERE " . $comsToSql;

    if(!$res = SendSQLRequest($request)){
        echo($res);
    }
}
function DeleteUsers($users){

    $usersToSql = "";
    $usersComsToSql = "";

    $x = sizeof($users);
    foreach($users as $user){
        $x = $x - 1;
        $usersToSql = $usersToSql . "id=" . $user . " ";
        $usersComsToSql = $usersComsToSql . "id_author=" . $user . " ";

        if($x != 0) {
            $usersToSql = $usersToSql . "OR ";
            $usersComsToSql = $usersComsToSql . "OR ";
        }
    }

    //  Delete from users
    $request = "DELETE FROM `epic_users` 
    WHERE " . $usersToSql;

    if(!$res = SendSQLRequest($request)){
        echo($res);
    }

    //  Delete from coms
    $request = "DELETE FROM `coms` 
    WHERE " . $usersComsToSql;

    if(!$res = SendSQLRequest($request)){
        echo($res);
    }
}

?>