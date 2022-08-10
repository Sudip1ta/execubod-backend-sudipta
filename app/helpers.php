<?php 


function active_nav($nav_name){

    $uri = $_SERVER['REQUEST_URI'];
    $exp_uri = explode('/',$uri);

    if(is_array($nav_name)){
        foreach($nav_name as $url){
            if(end($exp_uri) == $url){
                echo "active";
            }else{
                echo '';
            }
        }
    }else{
        if(end($exp_uri) == $nav_name){
            echo "active";
        }else{
            echo '';
        }
    }

   

    
   
}