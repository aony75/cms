<?php

    session_start();

    //constant variable can't be set here like footer and header becasue initalize.php are where the constants were defined
    require_once("../private/initialize.php");

    redirect_if_not_ajax_request("staff");

    $is_session_active = check_session_time();
	
	$input_border = "";
	$incorrect_input = "";

	$new_staff = [];
	
	$new_staff["evv_id"] = "";
	$new_staff["first_name"] = "";
	$new_staff["last_name"] = "";
	$new_staff["mail"] = "";
	$new_staff["pay_rate"] = "";
	$new_staff["phone_number"] = "";
	$new_staff["comments"] = "";

    $evv_id_border = "";
    $first_name_border = "";
    $last_name_border = "";
    $pay_rate_border = "";
    $phone_number_border = "";
    $comments_border = "";
    $mail_border = "";

	if(is_POST_request()){
		
		$new_staff["evv_id"] = h($_POST["evv_id"]);
		$new_staff["first_name"] = h($_POST["first_name"]);
		$new_staff["last_name"] = h($_POST["last_name"]);
		$new_staff["mail"] = h($_POST["mail"]);
		$new_staff["pay_rate"] = h($_POST["pay_rate"]);
		$new_staff["phone_number"] = h($_POST["phone_number"]);
		$new_staff["comments"] = h($_POST["comments"]);
		$incorrect_input = 0;
		
		$new_staff["first_name"] = ucwords($new_staff["first_name"]);
		$new_staff["last_name"] = ucwords($new_staff["last_name"]);
		
		$input_border = "incorrect-border";
        
		if(validate_number($new_staff["evv_id"], 5, true, "required") !== true){
			
			$incorrect_input++;
				
			$evv_id_border = $input_border;
			
			$new_staff["evv_id"] = "";
		}

		if(validate_text_only($new_staff["first_name"]) !== true){
			
			$incorrect_input++;
			
			$first_name_border = $input_border;
			
			$new_staff["first_name"] = "";
			
		}

		if(validate_text_only($new_staff["last_name"]) !== true){
			
			$incorrect_input++;
				
			$last_name_border = $input_border;
			
			$new_staff["last_name"] = "";
		
		}
		
		if(validate_mail($new_staff["mail"]) !== true){
            
            $incorrect_input++;
			
            $mail_border = $input_border;
            
            echo "<script>alert('Something went wrong with mail. Refresh and try again.');</script>";
            
            exit();

		}
		
		if(validate_money($new_staff["pay_rate"]) !== true){
			
			$incorrect_input++;
				
			$pay_rate_border = $input_border;
			
			$new_staff["pay_rate"] = "";
				
		}
		
		if(validate_phone_number($new_staff["phone_number"]) !== true){
			
			$incorrect_input++;
				
			$phone_number_border = $input_border;
			
			$new_staff["phone_number"] = "";
		
		}

		if(validate_textarea($new_staff["comments"]) !== true){
			
			$incorrect_input++;
				
			$comments_border = $input_border;
			
			$new_staff["comments"] = "";
		
		}
        
        if($is_session_active == true){
        
             if(validate_unique_evv_id($new_staff["evv_id"], "staff") !== true){

                $incorrect_input = 1000;

                $evv_id_border = $input_border;

            }

            if($incorrect_input == 0){

                $is_query_successful = create_new_staff($new_staff);

                $correct_statement = ($is_query_successful == true) ? "Staff Successfully Added" : $is_query_successful;

            }
            
        }else{
            
            $correct_statement = "";
            
        }
		
	}

    require_once(SHARED_PATH."/staff-content/new-staff-form-content.php");

?>