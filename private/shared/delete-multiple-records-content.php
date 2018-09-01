<?php
	
	//constant variable can't be set here like footer and header becasue initalize.php are where the constants were defined
    require_once("../../private/initialize.php"); 

    $is_session_active = check_session_time();

	if((is_POST_request())){
		
		$id_set = h($_POST["id_set"]);
        
        if($is_session_active == true){

            $record_deleted = delete_multiple_query($table, $id_set);

            echo $record_deleted;
            
        }else{
            
            echo "100";
            
        }
		
	}

?>