<?php 

	//template for show client form for ajax purposes

    //constant variable can't be set here like footer and header becasue initalize.php are where the constants were defined
    require_once("../../private/initialize.php");

    $is_session_active = check_session_time();

    $evv_id_border = "";
    $first_name_border = "";
    $last_name_border = "";
    $amerigroup_number_border = "";
    $medicaid_id_border = "";
    $phone_number_border = "";
    $comments_border = "";

	if(is_POST_request()){
		
		$id = h($_POST["id"]);
		
		$client = [];
		
		$client["evv_id"] = h($_POST["evv_id"]);
		$client["first_name"] = h($_POST["first_name"]);
		$client["last_name"] = h($_POST["last_name"]);
		$client["amerigroup_number"] = h($_POST["amerigroup_number"]);
		$client["medicaid_id"] = h($_POST["medicaid_id"]);
		$client["phone_number"] = h($_POST["phone_number"]);
		$client["comments"] = h($_POST["comments"]);
		$client["id"] = h($_POST["id"]);
		
		$incorrect_input = 0;
		
		$client["first_name"] = ucwords($client["first_name"]);
		$client["last_name"] = ucwords($client["last_name"]);
		
		$input_border = "incorrect-border";
		
		if(validate_client_id($client["evv_id"]) !== true){
			
			$incorrect_input++;
				
			$evv_id_border = $input_border;
			
		}

		if(validate_text_only($client["first_name"]) !== true){
			
			$incorrect_input++;
			
			$first_name_border = $input_border;
			
		}

		if(validate_text_only($client["last_name"]) !== true){
			
			$incorrect_input++;
				
			$last_name_border = $input_border;
		
		}
		
		if(validate_number($client["amerigroup_number"], 9) !== true){
			
			$incorrect_input++;
				
			$amerigroup_number_border = $input_border;
			
		}
		
		if(validate_number($client["medicaid_id"], 9) !== true){
			
			$incorrect_input++;
				
			$medicaid_id_border = $input_border;
				
		}
		
		if(validate_phone_number($client["phone_number"]) !== true){
			
			$incorrect_input++;
				
			$phone_number_border = $input_border;
		
		}

		if(validate_textarea($client["comments"]) !== true){
			
			$incorrect_input++;
				
			$comments_border = $input_border;
		
		}
        
        if($is_session_active == true){
        
            if(validate_unique_evv_id($client["evv_id"], "clients", $id) !== true){

                $incorrect_input = 1000;

                $evv_id_border = $input_border;

            }
        
            if($incorrect_input == 0){

                $is_query_successful = update_client($client);

                $correct_statement = ($is_query_successful == true) ? "Client Successfully updated" : $is_query_successful;

            }
        
        }else{
            
            $correct_statement = "";
            
        }
		
	}

	require_once(SHARED_PATH."/client-content/show-client-form-content-actual.php");
?>