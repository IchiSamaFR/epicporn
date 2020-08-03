<?php

require_once(__DIR__ . '/../config.php');

function GetUrl(){
    $protocol = stripos($_SERVER['SERVER_PROTOCOL'],'https') === 0 ? 'https://' : 'http://';
    return $protocol . $_SERVER['SERVER_NAME'] . strtok($_SERVER["REQUEST_URI"],'?');
}

function GetVideo_Name($id){

    $request = "SELECT title
    FROM videos
    WHERE id=" . $id;

    $result = GetSQLRequest($request);

    return $result[0];
}
function GetVideo_Categories($id){

    $request = "SELECT categories.name as cat_name
    FROM categories
    INNER JOIN videos_meta 
    ON categories.id = videos_meta.meta_value
    WHERE videos_meta.post_id='" . $id . "'";

    $result = GetSQLRequest_NoFetchArray($request);

    while($row = mysqli_fetch_array($result)){
        echo '<a href="" class="category">'.$row["cat_name"].'</a>';
    }
}
function GetVideo_Embed($id){

    $request = "SELECT embed
    FROM videos
    WHERE id='" . $id. "'";

    $result = GetSQLRequest($request);

    return $result[0];
}
function GetVideo_Views($id){

    $request = "SELECT meta_value
    FROM videos_meta
    WHERE post_id='" . $id . "' AND meta_key='views'";

    $result = GetSQLRequest($request);

    return $result[0];
}

function AddView($id){
    
    $request = "UPDATE videos_meta
    SET meta_value = meta_value + 1
    WHERE
        post_id='" . $id . "' AND meta_key='views'";

    $result = SendSQLRequest($request);

}


function GetVideos($orderby){

    $request = "SELECT videos.id as id, videos.title as title, videos_meta.meta_value as thumbnail
    FROM videos
    INNER JOIN videos_meta 
    ON videos.id = videos_meta.post_id
    WHERE videos_meta.meta_key='thumbnail'";

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
        }
    }
}


function GetPages_Number(){
    
    $request = "SELECT COUNT(id) FROM `videos`";

    $result = GetSQLRequest($request);

    $countVideos = $result[0];
}

?>