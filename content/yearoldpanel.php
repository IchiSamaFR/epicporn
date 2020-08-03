<?php


?>

<div id="older">
    <div id="oldercontent" class="oldercontent">
        <div class="popup">
            <div class="sizer">
                <div class="logo"> </div>
                <h2> Avez-vous plus de 18 ans ? </h2>
                <p> EpicPorn est une communauté qui offre du contenu réservé aux adultes. </br>
                Vous devez avoir 18 ans ou plus pour entrer. </p>

                <input type="button" id="button_enter" class="button_enter" value="J'ai 18 ans ou plus"> </input>
            </div>
        </div>

    </div>
</div>

<script>
    /*
    document.getElementById('button_enter').onclick =  
	function(){
			//getRequest("../functions/olderthan18.php", "");
            $.post("functions/olderthan18.php");

    }*/
    
    $(document).ready(function() {
        $("#button_enter").click(function(){
            $.get("functions/yearoldcheck.php", function(data, status){
                if(status == "success"){
                    document.getElementById('blur').classList.remove("blur");

                    var toDelete = document.getElementById("older");
                    toDelete.removeChild(toDelete.childNodes[1]); 
                }
            })
        });
    });
</script>