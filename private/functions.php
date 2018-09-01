<?php
    
    //returns root path 
    function url_for($script_path) {
        
        // add the leading '/' if not present
        if($script_path[0] != '/') {
            
            $script_path = "/" . $script_path;
        }
        
        return WWW_ROOT . $script_path;
    }

    //returns value of urlencode
    function u($string = "") {
        return urlencode(h($string));
    }

    //returns value of rawurlencode
    function raw_u($string = "") {
        return rawurlencode(h($string));
    }

    //returns value of htmlspecialchars
    function h($string = "") {
        return htmlspecialchars($string);
    }

    //function takes a location and redirects based on location
    function redirect_to($location){
        header("Location: ".$location);
        exit();
    }

    //checks whether the request is a post and returns true if it is 
    function is_POST_request() {
       return $_SERVER["REQUEST_METHOD"] == "POST";
    }
    
    //checks whether request is get and returns true if it is
    function is_GET_request() {
        return $_SERVER["REQUEST_METHOD"] == "GET";
    }

	
	//validates client id input
	function validate_client_id($evv_id){
		
		switch(strlen($evv_id)){
				
			case 11:
				
				$is_id_input_correct = ((!is_numeric(substr($evv_id, 0, 7))) || ($evv_id[7] != "-") || (substr($evv_id, -3) != "MCD")) ? false : true;
				
				break;
				
			default:
				
				$is_id_input_correct = false;
		
		}
		
		return $is_id_input_correct;
				
	}


	//validates input if it is a text only and by input length
	function validate_text_only($text, $is_required = "required", $input_length_limit = 30){
		
		$text = str_replace(" ", "", $text);
		
		switch($is_required){
				
			case "not required":
				
				if($text==""){$text = "none";}
				
				$is_name_input_correct = ((strlen($text) > $input_length_limit) ||  (!ctype_alpha($text))) ? false : true;

				break;
				
			default:
				
				$is_name_input_correct = ((strlen($text) > $input_length_limit) || (strlen($text) == 0) || (!ctype_alpha($text))) ? false : true;
	
		}
		
		return $is_name_input_correct;
				
	}

	
	//validates mail by checking for @ and .
    function validate_mail($mail){
		
		switch($mail){
				
			case "Pickup":
            case "Regular Mailing":
            case "Early Mailing":
				
				return $is_mail_option_correct = true;

				break;
				
			default:
                
                return $is_mail_option_correct = false;
	
		}
				
	}

    //validates money by checking if its a correct monetary input
    function validate_money($money, $max_length = 5, $is_required = "not required"){
		
		switch($is_required){
				
			case "required":
                
                $is_money_correct = verify_money_input_for_validate_money_function($money, $max_length);
                
                break;
				
			default:
                
                if(empty($money)){
                    
                    return true;
                
                }else{
                    
                    $is_money_correct = verify_money_input_for_validate_money_function($money, $max_length);
                    
                }
	
		}
        
        return  $is_money_correct;
				
	}

    //validates money by checking for decimal placement and if input is a number
    function verify_money_input_for_validate_money_function($money, $max_length){
        
        if(strlen($money) > $max_length){ return false;}
                    
        for($i = 0; $i < strlen($money); $i++){
                       
            if(strlen($money) <= 2){
                            
                $is_money_correct = is_numeric($money[$i]) ? true : false;
                            
                if(!is_numeric($money[$i])){break;}
                            
            }else{
                            
                $decimal_placement_index = strlen($money) - 3;
                            
                if($i == $decimal_placement_index){
                                
                    $is_money_correct = ($money[$i] == ".") ? true : false;
                            
                    if($money[$i] != "."){break;}
                                   
                }else{
                                
                    $is_money_correct = is_numeric($money[$i]) ? true : false;
                            
                    if(!is_numeric($money[$i])){break;}
                                   
                }
                            
            }
                        
        }
        
        return $is_money_correct;
        
    }


	//validates input if it is a number, if its required, input limit,
	function validate_number($number, $input_length_limit, $length_must_equal_maxlength = true, $is_required = "not required"){
		
		switch($is_required){
				
			case "required":
				
				if(strlen($number) == 0){return false;}
				
				break;
			
			default:
				
				if(strlen($number) > $input_length_limit){return false;}
                
                if(empty($number)){return true;}
                
		}
	
		switch($length_must_equal_maxlength){
				
			case true:
                
                if(strlen($number) != $input_length_limit){return false;}
                
                for($i = 0; $i < $input_length_limit; $i++){
                    
                    if(!is_numeric($number[$i])){return false;}
                    
                }
			
				$is_number_input_correct = ((strlen($number) != $input_length_limit) && ($number != "")) ? false : true;
				
				break;
				
			default:
                
                for($i = 0; $i < $input_length_limit; $i++){
                    
                    if(!is_numeric($number[$i])){return false;}
                    
                }
				
				$is_number_input_correct = true;
				
		}
        
		return $is_number_input_correct;
				
	}


	//validates phone number, if its required, 
	function validate_phone_number($phone_number, $is_required = "not required"){

		if($is_required == "required"){
				
			if(strlen($phone_number) != 12){return false;}
				
		}
		
		switch(strlen($phone_number)){
			
			case 0:
			
				return true;
			
				break;
			
			case 12:
			
				if(($phone_number[3] != "-") || ($phone_number[7] != "-")){return false;}
			
				break;
			
			default:
			
				return false;
			
		}
		
		for($i = 0; $i < 12; $i++){
		
			if(($i == 3) || ($i == 7)){continue;}
			
			if(!is_numeric($phone_number[$i])){return false;}
		}
			
		return true;
				
	}

	//validates money input to make sure it's proper format
	function validate_time($time, $is_required = "not required"){

		if($is_required == "required"){
				
			if(strlen($time) != 5){return false;}
				
		}
		
		switch(strlen($time)){
			
			case 0:
			
				return true;
			
				break;
			
			case 5:
			
				if(($time[2] != ":")){return false;}
			
				break;
			
			default:
			
				return false;
			
		}

        for($i = 0; $i < 5; $i++){
		
			if($i == 2){continue;}
			
			if(!is_numeric($time[$i])){
                
                return false;
            
            }
            
		}
        
        if(convert_time_to_number($time) > 2359){return false;}
        	
		return true;
				
	}

	//validates date input to make sure its proper format
    function validate_date($start_date, $is_required = "required"){

		if($is_required == "required"){

			if(strlen($start_date) != 10){return false;}

		}
		
		switch(strlen($start_date)){
			
			case 0:
			
				return true;
				
				break;
			
			case 10:
			
				if(($start_date[4] != "-") || ($start_date[7] != "-")){return false;}
                
				break;
			
			default:
			
				return false;
			
		}
		
		for($i = 0; $i < 10; $i++){
		
			if(($i == 4) || ($i == 7)){continue;}
			
			if(!is_numeric($start_date[$i])){return false;}
		}
		
		return true;
				
	}

	//checks to make sure there is a clockin and clockout
    function validate_clockin_and_clockout($in_and_out_set){
        
        foreach ($in_and_out_set as $in_and_out){
            
            if(empty($in_and_out["in"]) && !empty($in_and_out["out"])){
                
                return false;
                
            }else if(!empty($in_and_out["in"]) && empty($in_and_out["out"])){
                
                return false;
                
            }
            
        }
        
        return true;
        
    }

	//validates textarea input
	function validate_textarea($textarea, $input_length_limit = 300, $is_required = "not required"){

		switch($is_required){
				
			case "required":
				
				if(strlen($textarea) == 0){return false;}
				
			default:
				
				$is_textarea_input_correct = (strlen($textarea) > $input_length_limit) ? false : true;
				
		}
		
		return $is_textarea_input_correct;
				
	}

    //checks to make sure time is valid miltary time
    function convert_time_to_number($time) {
        
         for($i = 0; $i < 5; $i++){
		
			if($i == 2){continue;}
			
			if(!is_numeric($time[$i])){
                
                return false;
            
            }
            
		}

        $time_array = explode(":",$time);
            
        $hour = $time_array[0] * 100;
            
        $min = $time_array[1];
        
        $converted_time = $hour + $min;
        //echo "<script>alert('convert function: ".$converted_time."')</script>";   
        return $converted_time;
        
    }

	//creates sql for time input in fitler for table
    function sql_for_time_filter($in_or_out, $value){
        
        return "(sun_".$in_or_out." LIKE '%".$value."%' OR mon_".$in_or_out." LIKE '%".$value."%' OR tues_".$in_or_out." LIKE '%".$value."%' OR wed_".$in_or_out." LIKE '%".$value."%' OR thurs_".$in_or_out." LIKE '%".$value."%' OR fri_".$in_or_out." LIKE '%".$value."%' OR sat_".$in_or_out." LIKE '%".$value."%')";
       
    }

	//if session is not active app redirects to login page 
    function validate_session(){

        if(!isset($_SESSION["username"]) || empty($_SESSION["username"]) || !isset($_SESSION["table_indentifier"]) || empty($_SESSION["table_indentifier"])){
            
            $params = session_get_cookie_params();
    
            setcookie(session_name(), "", time() - 1000000, $params["path"], $params["domain"], $params["secure"], $params["httponly"]);
        
            session_unset();
        
            session_destroy();
        
            redirect_to(url_for("/"));
        
        }
        
    }
	
	//creates unique table for users
    function create_tables_for_user($table_indentifier){
        
        create_user_table("clients", $table_indentifier);
        
        create_user_table("schedules", $table_indentifier);
        
        create_user_table("staff", $table_indentifier);
        
    }

	// destroys unique session table on logout
    function drop_all_current_tables_on_logout(){
           
        drop_current_table_on_logout("clients");
    
        drop_current_table_on_logout("schedules");
           
        drop_current_table_on_logout("staff");
         
    }
	
	//redirects if request is not ajax
    function redirect_if_not_ajax_request($location) {
        
        if(!strtolower($_SERVER["HTTP_X_REQUESTED_WITH"]) == "xmlhttprequest"){
        
            redirect_to(url_for("/".$location));
        
        }
        
    }
	
	//checks if session is still active 
    function check_session_time() {
        
        if(!array_key_exists("username", $_SESSION)){
            
            return false; 
        
        }else{
            
            return true;
            
        }
        
    }

	//verfiies and initializes mysql in one function
    function initialize_and_verify_stmt($db, $sql){
        
        $stmt = mysqli_stmt_init($db);
        
        if(!mysqli_stmt_prepare($stmt, $sql)){
            
            exit("database error");
        }
        
        return $stmt;
    
    }

	//checks for conflictiong schedule when user is trying to enter a new schedule
    function create_conflicting_schdule_values($conflicting_schedule){

        if(!empty($conflicting_schedule)){

            $conflicting_schedule_values = array($conflicting_schedule["id"], $conflicting_schedule["client"], $conflicting_schedule["staff"], $conflicting_schedule["day"], $conflicting_schedule["in"], $conflicting_schedule["out"]);
            
            return $conflicting_schedule_values;

        }
        
    }

	//creates shorter version for real string escape
    function e($var){
        
        global $db;
        
        return mysqli_real_escape_string($db, $var);
    }
    
?>
