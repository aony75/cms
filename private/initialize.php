<?php

    //ob start turns on output buffering if it is not already on.
    //used in case you call header function after html is outputed. allows for an amount of characters to be used before header is //created
    ob_start();
    
    //contstants to use for directory location
    define("PRIVATE_PATH", dirname(__FILE__));
    define("PROJECT_PATH", dirname(PRIVATE_PATH));
    define("PUBLIC_PATH", PROJECT_PATH . "/public");
    define("SHARED_PATH", PRIVATE_PATH . "/shared");
    
    //define() is making WWW_ROOT the name of the constant variable and assigning $doc_root as the value
    $public_end = strpos($_SERVER['SCRIPT_NAME'], "/cms") + 4;
    $doc_root = substr($_SERVER['SCRIPT_NAME'], 0, $public_end);
    define("WWW_ROOT", $doc_root);
 
    //includes functions.php so when initialze.php runs on any page so will the functions.php
    require_once("functions.php");

    //includes database.php so when initialize.php runs on any page so will database.php
    require_once("database.php");

    //db_connect function called in initalize.php so that anytime initialize is used at on any page, mysql connection is opened
    $db = db_connect();
    
    // requires inclusion of query_functions.php
    require_once(PRIVATE_PATH."/query_functions.php");
	
	//includes mobile detect on initialize.php
    require_once(SHARED_PATH."/mobile-detect/Mobile_Detect.php");

	//creates new object of mobile detect
    $browser_type = new Mobile_Detect;

?>
