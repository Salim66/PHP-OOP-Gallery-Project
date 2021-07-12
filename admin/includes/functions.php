<?php

/**
 * 1. autoload we can use better error get and customize error show 
 * 2. and my file has my project folder then automatic load this file
 */ 

// create autoload function
function my_autoloader($class){ 

    $class = strtolower($class);

    $the_path = "includes/{$class}.php";

    // checked whether the file exist or not
    if(file_exists($the_path)){
        require_once($the_path);
    }else {
        die("The file named {$class}.php was not found anywhere....");
    }

    
}
spl_autoload_register('my_autoloader');




?>