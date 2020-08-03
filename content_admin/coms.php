<div class="centered">
    <p class="page_title"> Commentaires </p>

    <div class="table_list page">
        <div class="box title_row border_down coms">
            <div class="toggle_select" id="all" value="test">
                <div class="toggle"> 
                    <div id="toggle_" class="toggle_btn"> </div>
                </div>
            </div>
            <p> Auteur </p>
            <p> Commentaire </p>
            <p> Vidéo </p>
            <p> Date </p>
        </div>
        <?php
        GetComs();
        ?>
        <div class="box title_row border_up coms">
            <p></p>
            <p> Auteur </p>
            <p> Commentaire </p>
            <p> Vidéo </p>
            <p> Date </p>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('.toggle_select').click(function(){
            var t = $(this).attr('id');

            if(t == "all"){
                boolval active = false;
                if(document.getElementById(t).classList.contains("active")){
                    document.getElementById(t).classList.remove("active");
                    document.getElementById("toggle_" + t).classList.remove("toggle_btn");
                } else {
                    document.getElementById(t).classList.add("active");
                    document.getElementById("toggle_" + t).classList.add("toggle_btn");
                }
                
                $.ajax({ url: 'functions/admin_addtolist.php',
                    data: {
                        category: t,
                        set: "coms"
                    },
                    type: 'GET',
                    success: function(output) {
                                //alert(output);
                            }
                });
            } else {
                if(document.getElementById(t).classList.contains("active")){
                    document.getElementById(t).classList.remove("active");
                    document.getElementById("toggle_" + t).classList.remove("toggle_btn");
                } else {
                    document.getElementById(t).classList.add("active");
                    document.getElementById("toggle_" + t).classList.add("toggle_btn");
                }
                
                $.ajax({ url: 'functions/admin_addtolist.php',
                    data: {
                        category: t,
                        set: "coms"
                    },
                    type: 'GET',
                    success: function(output) {
                                //alert(output);
                            }
                });
            }
        });
    });

</script>