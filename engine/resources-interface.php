<?php
require_once('exceptions.php');

function get_data($url){
    
}

function get_page($url){
    $pageExtsns = array('json','php','html','htm'); // extenstions and its priority. 
    $location = '../';
     
    foreach($pageExtsns as $ext){
        if(!file_exists($location .$url. '.' .$ext)){ 
            continue;
        }
        
        if($ext === 'php'){
            ob_start();
            include $location .$url. '.' .$ext;
            return ob_get_clean(); 
        }else if($ext === 'json'){
            return json_decode(file_get_contents($location .$url. '.' .$ext));
        }else{
            return file_get_contents($location .$url. '.' .$ext);
        }            
    }
    return false;   
}


function get_template($url){
    $templateExtsns = array('html','htm'); // extenstions and its priority. 
    $location = '../views/';
    
    foreach($templateExtsns as $ext){
        if(file_exists($location .$url. '.' .$ext)){
            return file_get_contents($location .$url. '.' .$ext);
        }
    }
    return false;
}



function get_resource($url){
    
    if(substr($url, 0, 6) === 'pages/'){
        $content = get_page($url);
    }else if(substr($url, 0, 10) === 'templates/'){
        $content = get_template($url);
    }else {
        $content = get_data($url);
    }
    
    if($content === false){
       throw new NotFoundException();
    }
    
    return $content;
} 