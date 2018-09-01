<?php

    $is_session_active = check_session_time();

    $evv_id_border = "";
    $first_name_border = "";
    $last_name_border = "";
    $pay_rate_border = "";
    $phone_number_border = "";
    $comments_border = "";
    $mail_border = "";

    if(is_POST_request()){
		
		$id = h($_POST["id"]);
        
        $staff = [];
		
		$staff["evv_id"] = h($_POST["evv_id"]);
		$staff["first_name"] = h($_POST["first_name"]);
		$staff["last_name"] = h($_POST["last_name"]);
		$staff["mail"] = h($_POST["mail"]);
		$staff["pay_rate"] = h($_POST["pay_rate"]);
		$staff["phone_number"] = h($_POST["phone_number"]);
		$staff["comments"] = h($_POST["comments"]);
		$staff["id"] = h($_POST["id"]);
		
		$incorrect_input = 0;
		
		$staff["first_name"] = ucwords($staff["first_name"]);
		$staff["last_name"] = ucwords($staff["last_name"]);
		
		$input_border = "incorrect-border";
		
		if(validate_number($staff["evv_id"], 5) !== true){
			
			$incorrect_input++;
				
			$evv_id_border = $input_border;
			
		}

		if(validate_text_only($staff["first_name"]) !== true){
			
			$incorrect_input++;
			
			$first_name_border = $input_border;
			
		}

		if(validate_text_only($staff["last_name"]) !== true){
			
			$incorrect_input++;
				
			$last_name_border = $input_border;

		
		}
		
		if(validate_mail($staff["mail"]) !== true){
            
            $incorrect_input++;
			
            $mail_border = $input_border;
            
            exit("Something went wrong with the mail. Refresh and try again.");

		}
		
		if(validate_money($staff["pay_rate"]) !== true){
			
			$incorrect_input++;
				
			$pay_rate_border = $input_border;
			
		}
		
		if(validate_phone_number($staff["phone_number"]) !== true){
			
			$incorrect_input++;
				
			$phone_number_border = $input_border;
		
		}

		if(validate_textarea($staff["comments"]) !== true){
			
			$incorrect_input++;
				
			$comments_border = $input_border;
		
		}
        
        if($is_session_active == true){
        
            if(validate_unique_evv_id($staff["evv_id"], "staff", $id) !== true){

                $incorrect_input == 1000;

                $evv_id_border = $input_border;

            }

            if($incorrect_input == 0){

                $is_query_successful = update_staff($staff);

                $correct_statement = ($is_query_successful == true) ? "Staff Successfully updated" : $is_query_successful;

            }
            
        }else{
            
            $correct_statement = "";
            
        }
		
	}

    require_once(SHARED_PATH."/staff-content/show-staff-form-content-actual.php");
?>