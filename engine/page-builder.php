<?php

require_once('resources-interface.php');

function inflate_node_template($data) {

    //request node template
    $viewName = $data->view;
    unset($data->view);

    $template = get_resource('templates/' . $viewName);

    $locations = array();
    $contents = array();

    foreach ($data as $spcToApnd => $cntntsToApnd) {
        $cntntsToApnd = gettype($cntntsToApnd) !== "array" ? array($cntntsToApnd) : $cntntsToApnd;

        $temp = "";
        foreach ($cntntsToApnd as $cntntToApnd) {
            $temp .= inflate_node($cntntToApnd);
        }

        $locations[] = '/{\s*' . $spcToApnd . '\s*}/';
        $contents[] = $temp;
    }
    
    return preg_replace($locations, $contents, $template);
}

/**
 * $content url(string) or assoc_array(view:viewname, space: $subcontent).
 */
function inflate_node($data) {
    if (gettype($data) === "string") { // should be an URL
        return $data;
    } else {
        return inflate_node_template($data);
    }
}

function build_page($u) {
    $url = $u === "" ? 'index' : $u;

    $page = get_resource('pages/' . $url);
    if(gettype($page) === 'object'){
        $page->view = 'html'; //default/base page template.
        return inflate_node($page);
    }else {
        return $page;
    }
}



function buld_and_print_page($url) {
    $page = build_page($url);
    echo $page ;
}
