
<?php

	if(isset($_GET["admin"])){

		require_once("admin.php");
		return;
	}
	require_once("functions/functions.php");

	$check = true;
	session_start();
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
	    <link rel="stylesheet" type="text/css" href="css/theme.css" />
	    <meta charset="utf-8">
		<meta name="EpicPorn" content="EpicPorn">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
	    <title>EpicPorn - EpicPorn.fr le Porno Tube Francais, des vidéos sex free...</title>
	</head>
    <body>
        <script src="tools/jquery=3.1.1.min.js"></script>

<?php
if(!isset($_SESSION["older"])){
	include 'content/yearoldpanel.php';
	echo '<div id="blur" class="blur">';
	echo '<div>';
}
include 'content/header.php';

if(isset($_GET["vid"])){
	include 'content/single_vid.php';
} 
else if(empty($_GET))
{
	include 'content/home.php';
}


include 'content/pre_foot.php';

include 'content/footer.php';

?>

	</body>
</html>