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


function GetVideos($orderby, $count, $float){

    $request = "SELECT videos.id as id, videos.title as title, videos_meta.meta_value as thumbnail
    FROM videos
    INNER JOIN videos_meta 
    ON videos.id = videos_meta.post_id
    WHERE videos_meta.meta_key='thumbnail'";

    if($orderby == "date"){
        $request = $request . " ORDER BY videos.date DESC";
    } 
    else if($orderby == "views"){
        $request = $request . " ORDER BY 
            (SELECT videos_meta.meta_value 
            FROM videos_meta 
            WHERE videos_meta.meta_key = 'views' AND videos_meta.post_id=videos.id) 
            DESC";
    }
    $request = $request . " LIMIT " . $count;

    $result = GetSQLRequest_NoFetchArray($request);

    while($row = mysqli_fetch_array($result)){
        ?>

        <a href="?vid=<?php echo $row['id']; ?>" class="vid_content <?php echo $float; ?>" alt="<?php echo $row['title']; ?>">
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


//          -------------------- SQL --------------------

function SendSQLRequest($request){
    $dbh = BddConnect();
    if($result = mysqli_query($dbh, $request)){
        return true;
    } else {
        return "Error";
    }
}

function GetSQLRequest($request){
    $dbh = BddConnect();
    if($result = mysqli_query($dbh, $request)){
        $lines = mysqli_fetch_row($result);

        return $lines;
    } else {
        return "Error";
    }
}

function GetSQLRequest_NoFetchArray($request){
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
    $string = addslashes($string);
    return $string;
}

?>