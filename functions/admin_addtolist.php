<?php
    session_start();

    if($set = "vids"){
        $values = array();
        $values = explode (";", $_SESSION['cache_categories']);
    
        $pos = array_search($_GET['category'], $values);
    
        if(in_array($_GET['category'], $values)){
            array_splice($values, $pos, 1);
    
            if(sizeof($values) > 0){
                $_SESSION['cache_categories'] = "";
                foreach ($values as $val){
                    if($val != ""){
                        $_SESSION['cache_categories'] = $_SESSION['cache_categories'] . $val . ";";
                    }
                }
            }
        }
        else {
            $_SESSION['cache_categories'] = $_SESSION['cache_categories'] . $_GET['category'] . ";";
        }
        echo $_SESSION['cache_categories'];
    } else if($set = "coms") {

    }
?>