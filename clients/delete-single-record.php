<?php
    
    session_start();

	//constant variable can't be set here like footer and header becasue initalize.php are where the constants were defined
    require_once("../private/initialize.php"); 
  
	redirect_if_not_ajax_request("clients");
	
	$table = "clients";
	require_once(SHARED_PATH."/delete-single-record-content.php");

?>