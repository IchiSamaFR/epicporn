
<?php

	if(isset($_GET["admin"])){

		require_once("admin.php");
		return;
	}
	require_once("functions/universal_functions.php");
	require_once("functions/functions.php");

	$check = true;
	session_start();
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
		<?php //<link rel="shortcut icon" href="icon.ico" /> 
		?>
	    <link rel="stylesheet" type="text/css" href="css/theme.css" />
	    <meta charset="utf-8">
		<meta name="EpicPorn" content="EpicPorn">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
	    <title>EpicPorn - EpicPorn.fr le Porno Tube Francais, des vidéos sex free...</title>
	</head>
    <body class="censure">
        <script src="tools/jquery=3.1.1.min.js"></script>

<?php
if(!isset($_SESSION["older"])){
	include 'content/yearoldpanel.php';
	echo '<div id="blur" class="blur">';
}
include 'content/header.php';

if(isset($_GET["vid"])){
	include 'content/single_vid.php';
} 
else if(isset($_GET["show"]))
{
	include 'content/show_vids.php';
}
else if(empty($_GET))
{
	include 'content/home.php';
}


include 'content/pre_foot.php';

include 'content/footer.php';

?>
		</div>
	</body>
</html>