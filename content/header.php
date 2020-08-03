<?php
    if(!isset($check)){
        return;
    }
?>

<div id="header_log" class="header_log disable">

    <div class="center_mid">
        <div class="langage">
            <a href="" class="button"> FR </a>
        </div>
        <div class="co_menu">
            <a href="" class="button"> Inscription </a>
            <a href="" class="button"> Connexion </a>
        </div>
        
    </div>


</div>

<div id="header_menu" class="header_menu">

    <div class="center_mid">
        <a class="logo_btn" href="<?php echo GetUrl(); ?>">
            <div class="logo"></div>
        </a>
        <div class="nav_menu">
            <a href="<?php echo GetUrl(); ?>" class="nav_button 
            <?php if(empty($_GET)){
                echo "active"; 
            }
            ?>"> Accueil </a>
            <a href="" class="nav_button"> Categories </a>
        </div>

        <div id="mobile_nav_btn" class="mobile_nav_btn">
        </div>
        
    </div>
    <div id="mobile_nav_menu" class="mobile_nav_menu_content">
        <div class="title_menu"><h2> Navigation </h2></div>
        <a href="<?php echo GetUrl(); ?>" class="nav_button <?php if(empty($_GET)){
                echo "active"; 
            }
            ?>"><p> Accueil </p></a>
        <a href="" class="nav_button"><p> Categories </p></a>
    </div>


</div>








<script>
	window.onscroll = function() {replaceNav()};

	var navbar = document.getElementById("header_menu");
	var sticky = navbar.offsetTop;

	function replaceNav() 
	{
		if (window.pageYOffset >= sticky) {
			navbar.classList.add("sticky")
		} else {
			navbar.classList.remove("sticky");
		}
	}
    $(document).ready(function() {
        document.addEventListener("click", (evt) => {
            const firstElement = document.getElementById("mobile_nav_btn");
            const secondElement = document.getElementById("mobile_nav_menu");
            let targetElement = evt.target;

            do {
                if (targetElement == firstElement || targetElement == secondElement) {
                    if(firstElement.classList.contains("active")){
                        firstElement.classList.remove("active");
                        secondElement.classList.remove("active");
                    } else {
                        firstElement.classList.add("active");
                        secondElement.classList.add("active");
                    }
                    return;
                }
                targetElement = targetElement.parentNode;
            } while (targetElement);

            if(document.getElementById("mobile_nav_btn").classList.contains("active")){
                document.getElementById("mobile_nav_btn").classList.remove("active");
                document.getElementById("mobile_nav_menu").classList.remove("active");
            }
        });
    });
</script>

<?php

if(!isset($_SESSION["user"])){




} 
else 
{

    
}




?>