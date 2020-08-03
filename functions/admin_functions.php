<?php

require_once(__DIR__ . '/../config.php');


function CreateNewUser($mail, $username, $password){
    $dbh = BddConnect();

}

function AddVideo($embed, $title, $cat){
    //  Connection to the BDD
    $dbh = BddConnect();

    $embed = CleanText($embed);
    $title = CleanText($title);


    $thumb_url = "";
    $thumb_array = explode('src="', $embed);
    if(sizeof($thumb_array) > 1){
        $thumb_array = explode('"', $thumb_array[1]);
    } else {
        return;
    }

    //  Create new video
    $request = "INSERT INTO `videos` 
    (`id`, `title`, `embed`, `date`, `author`, `status`, `url_name`) 
    VALUES 
    (NULL, '".$title."', '".$embed."', (SELECT NOW()), '". $_SESSION["admin_user"] . "', 'published', '')";

    if(mysqli_query($dbh, $request)){
        $last_id = $dbh->insert_id;

        //  If there is a category
        if($cat != ""){
            $dbh = BddConnect();
            $request = "INSERT INTO `videos_meta` 
            (`meta_id`, `post_id`, `meta_key`, `meta_value`)
            VALUES ";
            
            $values = explode (";", $cat);
            $x = 0;
            foreach ($values as $val){
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
            
            if(!mysqli_query($dbh, $request)){
                echo("Error description: " . $dbh -> error);
            }
        }
        //  Thumbnail
        $thumb_url = "";
        $thumb_array = explode('src="', $embed);
        $thumb_array = explode('"', $thumb_array[1]);
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
        }

        $dbh = BddConnect();
        $request = "INSERT INTO `videos_meta` 
        (`meta_id`, `post_id`, `meta_key`, `meta_value`)
        VALUES (null, ". $last_id .",'thumbnail','". $thumb_url ."')
        ";
        if(!mysqli_query($dbh, $request)){
            echo("Error description: " . $dbh -> error);
        }
        
        $request = "INSERT INTO `videos_meta` 
        (`meta_id`, `post_id`, `meta_key`, `meta_value`)
        VALUES (null, ". $last_id .",'views','0');";
        if(!mysqli_query($dbh, $request)){
            echo("Error description: " . $dbh -> error);
        }

    } else {
        echo("Error description: " . $dbh -> error);
    }
}
function AddCategorie($name){
    //  Connection to the BDD
    $dbh = BddConnect();

    //  Create new video
    $request = "INSERT INTO `categories` 
    (`id`, `name`) 
    VALUES 
    (NULL, '".$name."')";

    if(!mysqli_query($dbh, $request)){
        echo("Error description: " . $dbh -> error);
    }
}

//          -------------------- GET FUNCTIONS --------------------

function GetInfos($type){
    $dbh = BddConnect();

    /*  **********************TO ADD WHEN IT'S FINISHED****************************


    if(isset($_SESSION["admin_rank"]) && $_SESSION["admin_rank"] <= 1){

    }*/
    
    if($type == "videos_count"){
        $request = "SELECT count(*) 
        FROM videos";

        $result = SendSQLRequest($request);
        return $result[0];
    } 
    else if ($type == "videos_views"){
        $request = "SELECT SUM(`meta_value`) 
        FROM `videos_meta` 
        WHERE meta_key = 'views'";

        $result = SendSQLRequest($request);
        return $result[0];
    } 
    else if ($type == "videos_coms"){
        $request = "SELECT count(*) 
        FROM `coms`";

        $result = SendSQLRequest($request);
        return $result[0];
    } 
    else if ($type == "videos_likes_stats"){
        $request = "SELECT SUM(`meta_value`) 
        FROM `videos_meta` 
        WHERE meta_key = 'likes', 
        SELECT SUM(`meta_value`) 
        FROM `videos_meta` 
        WHERE meta_key = 'dislikes'";

        $result = SendSQLRequest($request);
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

        $result = SendSQLRequest($request);
        return $result[0];
    }
}

function GetVideos($by){
    if($by == "infos"){
        $x = 0;
        
        $request = "SELECT id, title, embed
        FROM videos
        LIMIT 10";

        $result = SendSQLRequest_NoFetchArray($request);

        while($row = mysqli_fetch_array($result)){
            ?>

            <div class="box 
            <?php
                if ($x%2 == 0){
                    echo "pair";
                }
            ?> 
            video">
                <p> <a href="?vid&edit=<?php echo $row["id"] ?>"><?php echo $row["title"] ?> </a> </p>
                <div> 
                    <?php 


                    $secondRequest = "SELECT videos_meta.meta_value as id, categories.name as name
                    FROM videos_meta
                    INNER JOIN categories 
                    ON videos_meta.meta_value = categories.id
                    WHERE videos_meta.post_id=". $row["id"] .
                    " ORDER BY name ASC";

                    $secondResult = SendSQLRequest_NoFetchArray($secondRequest);

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

function GetCategories($by){
    if($by == "infos"){
        $x = 0;
        
        $request = "SELECT id, name
        FROM categories
        ORDER BY name ASC
        LIMIT 10";

        $result = SendSQLRequest_NoFetchArray($request);

        while($row = mysqli_fetch_array($result)){
            ?>

            <div class="box <?php
            if ($x%2 == 0){
                echo "pair";
            }?> 
            video">
                <p> <a href="?cat&edit=<?php echo $row["id"] ?>"><?php echo $row["name"] ?> </a> </p>
            </div>
            <?php

            $x = $x + 1;
        }
    } 
    else if ($by == "new_vid"){
        $request = "SELECT id, name
        FROM categories
        ORDER BY name ASC";

        $result = SendSQLRequest_NoFetchArray($request);

        while($row = mysqli_fetch_array($result)){
            ?>
                <div class="toggle_cat" id="<?php echo $row["id"] ?>" value="test">
                    <div class="toggle"> 
                        <div id="toggle_<?php echo $row["id"] ?>" class=""> </div>
                    </div>
                    <p> <?php echo $row["name"] ?> </p>
                </div>
            <?php
        }
    }
}

function GetComs($page = 1, $rowPerPage = 20){
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

    $result = SendSQLRequest_NoFetchArray($request);

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
            <div class="toggle_select" id="<?php echo $row["coms_id"]; ?>" value="test">
                <div class="toggle"> 
                    <div id="toggle_btn" class="toggle_btn"> </div>
                </div>
            </div>
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

function DeleteVideo($id){
    $dbh = BddConnect();

    $request = "DELETE FROM `videos`
    WHERE
    `id` = ". $id .";";

    if($result = mysqli_query($dbh, $request)) {

    } else {
        echo "error";
    }
}


//          -------------------- SQL --------------------

function SendSQLRequest($request){
    $dbh = BddConnect();
    if($result = mysqli_query($dbh, $request)){
        $lines = mysqli_fetch_row($result);

        foreach ($lines as &$line){
            if($line == ""){
                $line = 0;
            }
        }
        return $lines;
    } else {
        return "Error";
    }
}

function SendSQLRequest_NoFetchArray($request){
    $dbh = BddConnect();

    if($result = mysqli_query($dbh, $request))
    {
        return $result;
    } else {
        return "Error";
    }
}
//  Fonction clean des texts afin d'eviter les injections sql etc...
function CleanText($string){
    $string = str_replace("'","\'",$string);
    return $string;
}

?>