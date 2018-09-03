<?php

//url por defecto, y la sobreescribimos de ser necesario.

function get_url(){

    if(isset($_GET['url'])){ 

        $url = $_GET['url']; 
        $url = explode('/', $_GET['url']); 

    }else{

        $url = ['main'];
    }
    
    return $url; 
}
