
<?php

?>




<div class="centered">
    <p class="page_title"> Utilisateurs Admin </p>
    <form method="post">
        <div class="table_list page">
            <div class="box title_row border_down coms">
                <p></p>
                <p> Pseudo </p>
                <p> Mail </p>
                <p> Rank </p>
                <p> Publications </p>
            </div>
            <?php
                GetAdminUsers();
            ?>
            <div class="box title_row border_up coms">
                <p></p>
                <p> Pseudo </p>
                <p> Mail </p>
                <p> Rank </p>
                <p> Publications </p>
            </div>
        </div>
    </form>
</div>