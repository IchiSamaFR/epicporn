
<?php
	$check = true;
	session_start();

	require_once("functions/universal_functions.php");
	include_once("functions/admin_functions.php");
	

	//session_destroy();
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
		<?php //<link rel="shortcut icon" href="icon.ico" /> 
		?>
	    <link rel="stylesheet" type="text/css" href="css/admin.css" />
	    <meta charset="utf-8">
		<meta name="EpicPorn" content="EpicPorn">
	    <title>EpicPorn - EpicPorn.fr le Porno Tube Francais, des vidéos sex free...</title>
	</head>
    <body>
        <script src="tools/jquery=3.1.1.min.js"></script>

	<?php
		if(!isset($_SESSION['Admin'])){
			include 'content_admin/connection.php';
		} else if(isset($_SESSION['Admin'])) {
			include 'content_admin/header.php';
			include 'content_admin/content.php';
		}

	?>

	</body>
</html>