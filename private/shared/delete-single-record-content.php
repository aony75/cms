<?php
	
	//constant variable can't be set here like footer and header becasue initalize.php are where the constants were defined
    require_once("../../private/initialize.php");

    $is_session_active = check_session_time();

	if(is_POST_request()){
		
		$id = h($_POST["id"]);
        
        if(array_key_exists("table", $_POST)){
            
            $table = h($_POST["table"]);
            
        }
		
        if($is_session_active == true){
            
            $record_deleted = delete_query($table, $id);

            echo $record_deleted;
            
        }else {
            
            echo "100";
            
        }
		
	}

?>