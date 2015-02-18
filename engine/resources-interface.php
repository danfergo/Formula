<?php

function get_resource($url){
    
    if(substr($url, 0, 6) === 'pages/'){
        $content = file_get_contents('../views/'.$url. '.json');
    }else if(substr($url, 0, 10) === 'templates/'){
        $content = file_get_contents('../views/'.$url. '.html');
    }
    
    if($content === false){
        echo "file not found";
    }
   
    return $content;
} 