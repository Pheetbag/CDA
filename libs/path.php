<?php

//url por defecto, y la sobreescribimos de ser necesario.

function get_url(){
    
    $url[0] = 'main'; 
    if(isset($_GET['url'])){ 

        $url = $_GET['url']; 
        $url = explode('/', $_GET['url']); 

    }
    
    return $url; 
}
