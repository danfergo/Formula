<?php



$request_url = strlen($_SERVER['REQUEST_URI']) == 15 ? "" : substr($_SERVER['REQUEST_URI'] , 15);

require_once('page-builder.php');

buld_and_print_page($request_url);
