<?php

require_once(__DIR__ . '/../config.php');

/**
 * Get actual url without GET
 *
 * @return string
 */
function GetUrl(){
    $protocol = stripos($_SERVER['SERVER_PROTOCOL'],'https') === 0 ? 'https://' : 'http://';
    return $protocol . $_SERVER['SERVER_NAME'] . strtok($_SERVER["REQUEST_URI"],'?');
}

/**
 * Get Video name by the id
 *
 * @param  int $id
 * @return string
 */
function GetVideo_Name(int $id){

    $request = "SELECT title
    FROM videos
    WHERE id=" . $id;

    $result = GetSQLRequest($request);

    return $result[0];
}


/**
 * Get Categories by the video id and display it as a list
 *
 * @param  int $id
 * @return mixed
 */
function GetVideo_Categories(int $id){

    $request = "SELECT categories.name as cat_name
    FROM categories
    INNER JOIN videos_meta 
    ON categories.id = videos_meta.meta_value
    WHERE videos_meta.post_id='" . $id . "'";

    $result = GetSQLRequest_NoFetchArray($request);

    while($row = mysqli_fetch_array($result)){
        echo '<a href="" class="vid_category">'.$row["cat_name"].'</a>';
    }
}

/**
 * Get Video Embed by the id
 *
 * @param  int $id
 * @return string
 */
function GetVideo_Embed(int $id){

    $request = "SELECT embed
    FROM videos
    WHERE id='" . $id. "'";

    $result = GetSQLRequest($request);

    return $result[0];
}

/**
 * Get Video Views by the id
 *
 * @param  int $id
 * @return int
 */
function GetVideo_Views(int $id){

    $request = "SELECT meta_value
    FROM videos_meta
    WHERE post_id='" . $id . "' AND meta_key='views'";

    $result = GetSQLRequest($request);

    return $result[0];
}

/**
 * Add a view to the video
 *
 * @param  int $id
 * @return void
 */
function AddView(int $id){
    
    $request = "UPDATE videos_meta
    SET meta_value = meta_value + 1
    WHERE
        post_id='" . $id . "' AND meta_key='views'";

    $result = SendSQLRequest($request);

}


/**
 * Display videos by 
 * date : Order by date
 * views : Oreder by views
 *
 * @param  array $orderby
 * @return mixed
 */
function GetVideos(array $orderby){

    $request = "SELECT videos.id as id, videos.title as title, videos_meta.meta_value as thumbnail
    FROM videos
    INNER JOIN videos_meta 
    ON videos.id = videos_meta.post_id
    WHERE videos_meta.meta_key='thumbnail'";
    /*
    SELECT videos.id as id, 
		videos.title as title, 
        (SELECT videos_meta.meta_value FROM videos_meta WHERE videos_meta.meta_key='thumbnail' AND videos_meta.post_id = videos.id) as thumbnail,
		videos_meta.meta_id
        
    FROM videos
    INNER JOIN videos_meta 
    ON videos.id = videos_meta.post_id
    */
    if($orderby['orderType'] == "date"){
        $request = $request . " ORDER BY videos.date DESC";
    } 
    else if($orderby['orderType'] == "views"){
        $request = $request . " ORDER BY 
        CONVERT (
            (SELECT videos_meta.meta_value 
            FROM videos_meta 
            WHERE videos_meta.meta_key = 'views' AND videos_meta.post_id=videos.id),
            SIGNED INTEGER)
            DESC";
    }
    else if($orderby['orderType'] == "rand"){
        $request = $request . " ORDER BY 
        RAND()";
    }
    else if($orderby['orderType'] == "category"){
        $request = $request . " AND 
        (SELECT COUNT(post_id) 
        FROM videos_meta 
        WHERE videos_meta.meta_key = 'category' 
            AND videos_meta.post_id = id 
            AND videos_meta.meta_value = ". $orderby["catType"] .") > 0";
    }
    $request = $request . " LIMIT " . ($orderby['count'] + $orderby['startPos']);

    $result = GetSQLRequest_NoFetchArray($request);
    $x = 0;
    while($row = mysqli_fetch_array($result)){
        $x += 1;
        if($x > $orderby['startPos'])
        {
            if(strlen($row['title']) > 40){
                $row['title'] = substr($row['title'], 0, 40) . "...";
            }

            /*      HTML PART */
        ?>
        
        <a href="?vid=<?php echo $row['id']; ?>" class="vid_content" alt="<?php echo $row['title']; ?>">
            <div class="vid">
                <img src="<?php echo $row['thumbnail']; ?>" />
            </div>
            <div class="container">
                <div class="center_content">
                    <p> <?php echo $row['title']; ?> </p>
                </div>
            </div>
        </a>

        <?php
            /*      HTML END */
        }
    }
}

function GetCategoryShow(int $id)
{
    $request = "SELECT name
    FROM categories
    WHERE id='" . $id ."'";

    $result = GetSQLRequest($request);

    return $result[0];
}


/**
 * Display catégories
 * date : Order by date
 * views : Oreder by views
 *
 * @param  array $orderby
 * @return mixed
 */
function GetCategories()
{
    $request = "SELECT id, 
	(SELECT COUNT(post_id) 
     	FROM videos_meta 
     	WHERE meta_value = id
		AND meta_key = 'category') as count,
	name
    FROM categories
    WHERE (SELECT COUNT(post_id) 
            FROM videos_meta 
            WHERE meta_value = id
            AND meta_key = 'category') > 0
    ORDER BY name";
    $result = GetSQLRequest_NoFetchArray($request);
    while($row = mysqli_fetch_array($result)){
    ?>
        <a href="?show=category&cat=<?php echo $row["id"] ?>" class="category">
            <div class="img"></div>
            <div class="cat_footer">
                <h5 class="title"><?php echo $row['name']; ?></h5>
                <p class="count">(<?php echo $row['count']; ?>)</p>
            </div>
        </a>
    <?php
    }
}


/**
 * Get the navigation bar between pages
 *
 * @param  int $v_perpage videos per pages
 * @return mixed
 */
function GetNavBar(int $v_perpage){
    $videos = GetVideos_Number();
    $corrector = 0;

    $pages = intval($videos / $v_perpage) + 1;

    if($pages == 1){
        return;
    }

    if($pages == ($videos / $v_perpage) + 1){
        $corrector = 1;
    }

    if(!isset($_GET["page"])){
        $_GET["page"] = 1;
    }
    ?>

    <div class="nav_pages">
        <?php 
        $count = 0;
        if($pages <= 10){
            while($pages > $count + $corrector){
                $count ++;
                if($count == $_GET["page"]){
                    echo '<a>';
                } else {
                    echo '<a href="?show='. $_GET["show"] .'&page='. $count .'">';
                }
                    ?>
                    <div class="nav_slot <?php 
                    if($count == $_GET["page"]){
                        echo 'active';
                    }
                    ?>
                    ">
                        <p><?php echo $count; ?> </p>
                    </div>
                </a>
                <?php
            }
        }else {
            if($_GET["page"] < 6)
            {
                while($count < 8){
                    $count ++;
                    if($count == $_GET["page"]){
                        echo '<a>';
                    } else {
                        echo '<a href="?show='. $_GET["show"] .'&page='. $count .'">';
                    }
                        ?>
                        <div class="nav_slot <?php 
                        if($count == $_GET["page"]){
                            echo 'active';
                        }
                        ?>
                        ">
                            <p><?php echo $count; ?> </p>
                        </div>
                    </a>
                    <?php
                }
                ?>
                <a>
                    <div class="nav_slot">
                        <p>...</p>
                    </div>
                </a>
                <?php
                echo '<a href="?show='. $_GET["show"] .'&page='. ($pages - $corrector) .'">';
                ?>
                    <div class="nav_slot">
                        <p><?php echo ($pages - $corrector); ?> </p>
                    </div>
                </a>
                <?php
            } 
            else if ($_GET["page"] > $pages-7)
            {
                
                echo '<a href="?show='. $_GET["show"] .'&page=1">';
                ?>
                    <div class="nav_slot">
                        <p><?php echo 1; ?> </p>
                    </div>
                </a>
                <a>
                    <div class="nav_slot">
                        <p>...</p>
                    </div>
                </a>
                <?php
                $count = $pages - 9;
                while($count < $pages - $corrector){
                    $count ++;
                    if($count == $_GET["page"]){
                        echo '<a>';
                    } else {
                        echo '<a href="?show='. $_GET["show"] .'&page='. $count .'">';
                    }
                        ?>
                        <div class="nav_slot <?php 
                        if($count == $_GET["page"]){
                            echo 'active';
                        }
                        ?>
                        ">
                            <p><?php echo $count; ?> </p>
                        </div>
                    </a>
                    <?php
                }
            } else 
            {
                echo '<a href="?show='. $_GET["show"] .'&page=1">';
                ?>
                    <div class="nav_slot">
                        <p> 1 </p>
                    </div>
                </a>
                <a>
                    <div class="nav_slot">
                        <p>...</p>
                    </div>
                </a>
                <?php
                $count = $_GET["page"] - 3;
                while($count < $_GET["page"] + 3){
                    $count ++;
                    if($count == $_GET["page"]){
                        echo '<a>';
                    } else {
                        echo '<a href="?show='. $_GET["show"] .'&page='. $count .'">';
                    }
                        ?>
                        <div class="nav_slot <?php 
                        if($count == $_GET["page"]){
                            echo 'active';
                        }
                        ?>
                        ">
                            <p><?php echo $count; ?> </p>
                        </div>
                    </a>
                    <?php
                }
                ?>
                <a>
                    <div class="nav_slot">
                        <p>...</p>
                    </div>
                </a>
                <?php
                echo '<a href="?show='. $_GET["show"] .'&page='. ($pages - $corrector) .'">';
                ?>
                    <div class="nav_slot">
                        <p><?php echo ($pages - $corrector); ?> </p>
                    </div>
                </a>
                <?php
            }
        }
        
        
        ?>
    </div>
    <?php

}


/**
 * Get Number of all videos
 *
 * @return int
 */
function GetVideos_Number(){
    $request = "SELECT COUNT(id) FROM `videos`";

    $result = GetSQLRequest($request);
    return $result[0];
}


/**
 * Get an ads by id or randomly
 *
 * @return string
 */
function GetAds(int $id = -1){
    if($id != -1)
    {
        $request = "SELECT frame 
        FROM `ads` 
        WHERE id=". $id ."
        LIMIT 1";
    }
    else 
    {
        $request = "SELECT frame 
        FROM `ads` 
        ORDER BY RAND()
        LIMIT 1";
    }

    $result = GetSQLRequest($request);
    return $result[0];
}


function IsHomePage(){
    if(isset($_GET["vid"]) || 
    isset($_GET["show"]) || 
    isset($_GET["cgu"]) || 
    isset($_GET["privacy"]) || 
    isset($_GET["dmca"]) ||
    isset($_GET["categories"]))
    {
        return false;
    }
    else
    {
        return true;
    }
}



?>