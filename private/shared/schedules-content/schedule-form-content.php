<?php 

    //constant variable can't be set here like footer and header becasue initalize.php are where the constants were defined
    require_once("../../private/initialize.php");

    $is_session_active = check_session_time();
    
    $input_border = "";
	$incorrect_input = "";
    
	$new_schedule = [];

	$new_schedule["client"] = "";
	$new_schedule["staff"] = "";
	$new_schedule["comments"] = "";
    
    $new_schedule["mon_in"] = "";
    $new_schedule["mon_out"] = "";
    $new_schedule["tues_in"] = "";
    $new_schedule["tues_out"] = "";
    $new_schedule["wed_in"] = "";
    $new_schedule["wed_out"] = "";
    $new_schedule["thurs_in"] = "";
    $new_schedule["thurs_out"] = "";
    $new_schedule["fri_in"] = "";
    $new_schedule["fri_out"] = "";
    $new_schedule["sat_in"] = "";
    $new_schedule["sat_out"] = "";
    $new_schedule["sun_in"] = "";
    $new_schedule["sun_out"] = "";

    $client_border = "";
    $staff_border = "";
    $comments_border = "";

    $mon_in_border = "";
    $mon_out_border = "";
    $tues_in_border = "";
    $tues_out_border = "";
    $wed_in_border = "";
    $wed_out_border = "";
    $thurs_in_border = "";
    $thurs_out_border = "";
    $fri_in_border = "";
    $fri_out_border = "";
    $sat_in_border = "";
    $sat_out_border = "";
    $sun_in_border = "";
    $sun_out_border = "";

	if(is_POST_request()){
        
        if(array_key_exists("id", $_POST)){
            
            $id = h($_POST["id"]);
        
             $new_schedule["id"] = h($_POST["id"]);
            
        }else{
            
           $id = ""; 
            
        }

        $new_schedule["client"] = h($_POST["client"]);
        $new_schedule["staff"] = h($_POST["staff"]);
        $new_schedule["comments"] = h($_POST["comments"]);;

        $new_schedule["mon_in"] = h($_POST["mon_in"]);
        $new_schedule["mon_out"] = h($_POST["mon_out"]);
        $new_schedule["tues_in"] = h($_POST["tues_in"]);
        $new_schedule["tues_out"] = h($_POST["tues_out"]);
        $new_schedule["wed_in"] = h($_POST["wed_in"]);
        $new_schedule["wed_out"] = h($_POST["wed_out"]);
        $new_schedule["thurs_in"] = h($_POST["thurs_in"]);
        $new_schedule["thurs_out"] = h($_POST["thurs_out"]);
        $new_schedule["fri_in"] = h($_POST["fri_in"]);
        $new_schedule["fri_out"] = h($_POST["fri_out"]);
        $new_schedule["sat_in"] = h($_POST["sat_in"]);
        $new_schedule["sat_out"] = h($_POST["sat_out"]);
        $new_schedule["sun_in"] = h($_POST["sun_in"]);
        $new_schedule["sun_out"] = h($_POST["sun_out"]);
        
        $in_and_out_set = [
            
            ["in" => $new_schedule["sun_in"], "out" => $new_schedule["sun_out"]], ["in" => $new_schedule["mon_in"], "out" => $new_schedule["mon_out"]], ["in" => $new_schedule["tues_in"], "out" => $new_schedule["tues_out"]], ["in" => $new_schedule["wed_in"], "out" => $new_schedule["wed_out"]], ["in" => $new_schedule["thurs_in"], "out" => $new_schedule["thurs_out"]], ["in" => $new_schedule["fri_in"], "out" => $new_schedule["fri_out"]], ["in" => $new_schedule["sat_in"], "out" => $new_schedule["sat_out"]]
            
        ];
        
        $incorrect_input = 0;
		
		$input_border = "incorrect-border";
        
		if(!is_numeric($new_schedule["client"])){
			
			$incorrect_input++;
				
			$client_border = $input_border;
			
			$new_schedule["client"] = "";
		}
       
        if(!is_numeric($new_schedule["staff"])){
			
			$incorrect_input++;
				
			$staff_border = $input_border;
			
			$new_schedule["staff"] = "";
		}
        
        if(validate_textarea($new_schedule["comments"]) !== true){
			
			$incorrect_input++;
				
			$comments_border = $input_border;
			
			$new_schedule["comments"] = "";
		
		}
        
        if(validate_time($new_schedule["mon_in"]) !== true){
			
			$incorrect_input++;
				
			$mon_in_border = $input_border;
			
			$new_schedule["mon_in"] = "";
		
		}
        
        if(validate_time($new_schedule["mon_out"]) !== true){
			
			$incorrect_input++;
				
			$mon_out_border = $input_border;
			
			$new_schedule["mon_out"] = "";
		
		}
        
        if(validate_time($new_schedule["mon_out"]) !== true){
			
			$incorrect_input++;
				
			$mon_out_border = $input_border;
			
			$new_schedule["mon_out"] = "";
		
		}
        
        if(validate_time($new_schedule["tues_in"]) !== true){
			
			$incorrect_input++;
				
			$tues_in_border = $input_border;
			
			$new_schedule["tues_in"] = "";
		
		}
        
        if(validate_time($new_schedule["tues_out"]) !== true){
			
			$incorrect_input++;
				
			$tues_out_border = $input_border;
			
			$new_schedule["tues_out"] = "";
		
		}
        
        if(validate_time($new_schedule["wed_in"]) !== true){
			
			$incorrect_input++;
				
			$wed_in_border = $input_border;
			
			$new_schedule["wed_in"] = "";
		
		}
        
        if(validate_time($new_schedule["wed_out"]) !== true){
			
			$incorrect_input++;
				
			$wed_out_border = $input_border;
			
			$new_schedule["wed_out"] = "";
		
		}
        
        if(validate_time($new_schedule["thurs_in"]) !== true){
			
			$incorrect_input++;
				
			$thurs_in_border = $input_border;
			
			$new_schedule["thurs_in"] = "";
		
		}
        
        if(validate_time($new_schedule["thurs_out"]) !== true){
			
			$incorrect_input++;
				
			$thurs_out_border = $input_border;
			
			$new_schedule["thurs_out"] = "";
		
		}
        
        if(validate_time($new_schedule["fri_in"]) !== true){
			
			$incorrect_input++;
				
			$fri_in_border = $input_border;
			
			$new_schedule["fri_in"] = "";
		
		}
        
        if(validate_time($new_schedule["fri_out"]) !== true){
			
			$incorrect_input++;
				
			$fri_out_border = $input_border;
			
			$new_schedule["fri_out"] = "";
		
		}
        
        if(validate_time($new_schedule["sat_in"]) !== true){
			
			$incorrect_input++;
				
			$sat_in_border = $input_border;
			
			$new_schedule["sat_in"] = "";
		
		}
        
        if(validate_time($new_schedule["sat_out"]) !== true){
			
			$incorrect_input++;
				
			$sat_out_border = $input_border;
			
			$new_schedule["sat_out"] = "";
		
		}
        
        if(validate_time($new_schedule["sun_in"]) !== true){
			
			$incorrect_input++;
				
			$sun_in_border = $input_border;
			
			$new_schedule["sun_in"] = "";
		
		}
        
        if(validate_time($new_schedule["sun_out"]) !== true){
			
			$incorrect_input++;
				
			$sun_out_border = $input_border;
			
			$new_schedule["sun_out"] = "";
		
		}
        
        if(validate_clockin_and_clockout($in_and_out_set) !== true){
			
			$incorrect_input = 50;
		
		}
        
        if(empty($new_schedule["mon_in"]) && empty($new_schedule["mon_out"]) && empty($new_schedule["tues_in"]) && empty($new_schedule["tues_out"]) && empty($new_schedule["wed_in"]) && empty($new_schedule["wed_out"]) && empty($new_schedule["thurs_in"]) && empty($new_schedule["thurs_out"]) && empty($new_schedule["fri_in"]) && empty($new_schedule["fri_out"]) && empty($new_schedule["sat_in"]) && empty($new_schedule["sat_out"]) && empty($new_schedule["sun_in"]) && empty($new_schedule["sun_out"]) && $incorrect_input == 0){
            
            $incorrect_input = 100;
            
        }
        
        
        
        foreach($in_and_out_set as $key => $value) {

            switch($key){
                    
                case 0:
                
                    $key_in = "sun_in";
                    $key_out = "sun_out";
                    $day = ucwords("sunday");
                    
                    break;
                    
                case 1:
                
                    $key_in = "mon_in";
                    $key_out = "mon_out";
                    $day = ucwords("monday");
                    
                    break;
                    
                case 2:
                
                    $key_in = "tues_in";
                    $key_out = "tues_out";
                    $day = ucwords("tuesday");
                    
                    break;
                    
                case 3:
                
                    $key_in = "wed_in";
                    $key_out = "wed_out";
                    $day = ucwords("wednesday");
                    
                    break;
                    
                case 4:
                
                    $key_in = "thurs_in";
                    $key_out = "thurs_out";
                    $day = ucwords("thursday");
                    
                    break;
                    
                case 5:
                
                    $key_in = "fri_in";
                    $key_out = "fri_out";
                    $day = ucwords("friday");
                    
                    break;
                    
                case 6:
                
                    $key_in = "sat_in";
                    $key_out = "sat_out";
                    $day = ucwords("saturday");
                    
                    break;
                    
            }
            
            if($is_session_active == true){
            
                if($schedule_form_type == "new"){

                     $current_id = empty($id) ? find_last_id("schedules") + 1 : $id;

                }else{

                     $current_id = empty($id) ? "" : $id;

                }
            
                $selected_time = find_in_and_out_from_schedules_by_person($key_in, $key_out, "client_id", "staff_id", $new_schedule["staff"]);

                /*echo "<script>alert('day: ".$key_in.", actual in: ".$value["in"]."')</script>";
                echo "<script>alert('actual out: ".$value["out"]."')</script>";
                echo "<script>alert('selected in: ".$selected_time["in"]."')</script>";
                echo "<script>alert('selected out: ".$selected_time["out"]."')</script>";*/

                $conflicting_schedule = [];

                if(!empty($selected_time["in"]) && !empty($selected_time["out"])){

                    if(($value["in"] == $selected_time["in"] || $value["in"] == $selected_time["out"] || $value["out"] == $selected_time["in"] || $value["out"] == $selected_time["out"]) && ($selected_time["id"] != $current_id)){

                        $incorrect_input = 200;

                        $conflicting_schedule["id"] = $selected_time["id"];

                        $staff_name = find_single_name("staff", $selected_time["staff_id"]);

                        $conflicting_schedule["staff"] = $staff_name["last_name"].", ".$staff_name["first_name"];

                        $client_name = find_single_name("clients", $selected_time["client_id"]);

                        $conflicting_schedule["client"] = $client_name["last_name"].", ".$client_name["first_name"];

                        $conflicting_schedule["day"] = $day;
                        $conflicting_schedule["in"] = $selected_time["in"];
                        $conflicting_schedule["out"] = $selected_time["out"];
                        
                        $conflicting_schedule_values = create_conflicting_schdule_values($conflicting_schedule);
                        
                        break;

                    }

                    $value_in = empty($value["in"]) ? 0 : convert_time_to_number($value["in"]);

                    $value_out = empty($value["out"]) ? 0 : convert_time_to_number($value["out"]);

                    $selected_time_in = convert_time_to_number($selected_time["in"]);

                    $selected_time_out = convert_time_to_number($selected_time["out"]);

                    if((($value_in > $selected_time_in && $value_in < $selected_time_out) || ($value_out < $selected_time_out && $value_out > $selected_time_in)) && ($selected_time["id"] != $current_id)){

                        $incorrect_input = 200;

                        $conflicting_schedule["id"] = $selected_time["id"];

                        $staff_name = find_single_name("staff", $selected_time["staff_id"]);
                        $conflicting_schedule["staff"] = $staff_name["last_name"].", ".$staff_name["first_name"];

                        $client_name = find_single_name("clients", $selected_time["client_id"]);
                        $conflicting_schedule["client"] = $client_name["last_name"].", ".$client_name["first_name"];

                        $conflicting_schedule["day"] = $day;
                        $conflicting_schedule["in"] = $selected_time["in"];
                        $conflicting_schedule["out"] = $selected_time["out"];
                        
                        $conflicting_schedule_values = create_conflicting_schdule_values($conflicting_schedule);
                       
                        break;

                    }

                }

                $selected_time = find_in_and_out_from_schedules_by_person($key_in, $key_out, "staff_id", "client_id", $new_schedule["client"]);

                if(!empty($selected_time["in"]) && !empty($selected_time["out"])){

                    if(($value["in"] == $selected_time["in"] || $value["in"] == $selected_time["out"] || $value["out"] == $selected_time["in"] || $value["out"] == $selected_time["out"]) && ($selected_time["id"] != $current_id)){

                        $incorrect_input = 200;

                        $conflicting_schedule["id"] = $selected_time["id"];

                        $staff_name = find_single_name("staff", $selected_time["staff_id"]);
                        $conflicting_schedule["staff"] = $staff_name["last_name"].", ".$staff_name["first_name"];

                        $client_name = find_single_name("clients", $selected_time["client_id"]);
                        $conflicting_schedule["client"] = $client_name["last_name"].", ".$client_name["first_name"];

                        $conflicting_schedule["day"] = $day;
                        $conflicting_schedule["in"] = $selected_time["in"];
                        $conflicting_schedule["out"] = $selected_time["out"];
                        
                        $conflicting_schedule_values = create_conflicting_schdule_values($conflicting_schedule);
                        
                        break;

                    }

                    $value_in = empty($value["in"]) ? 0 : convert_time_to_number($value["in"]);

                    $value_out = empty($value["out"]) ? 0 : convert_time_to_number($value["out"]);

                    $selected_time_in = convert_time_to_number($selected_time["in"]);

                    $selected_time_out = convert_time_to_number($selected_time["out"]);

                    if((($value_in > $selected_time_in && $value_in < $selected_time_out) || ($value_out < $selected_time_out && $value_out > $selected_time_in)) && ($selected_time["id"] != $current_id)){

                        $incorrect_input = 200;

                        $conflicting_schedule["id"] = $selected_time["id"];

                        $staff_name = find_single_name("staff", $selected_time["staff_id"]);
                        $conflicting_schedule["staff"] = $staff_name["last_name"].", ".$staff_name["first_name"];

                        $client_name = find_single_name("clients", $selected_time["client_id"]);
                        $conflicting_schedule["client"] = $client_name["last_name"].", ".$client_name["first_name"];

                        $conflicting_schedule["day"] = $day;
                        $conflicting_schedule["in"] = $selected_time["in"];
                        $conflicting_schedule["out"] = $selected_time["out"];
                        
                        $conflicting_schedule_values = create_conflicting_schdule_values($conflicting_schedule);
             
                        break;

                    }

                }
                
                if($incorrect_input == 0){

                    if($schedule_form_type == "new"){

                        $is_query_successful = create_new_schedule($new_schedule);

                    }else if($schedule_form_type = "show"){

                        $is_query_successful = update_schedule($new_schedule);

                    }else{

                        $incorrect_input == 150;

                    }

                    $correct_statement = ($is_query_successful != true) ? $is_query_successful : ($schedule_form_type == "new") ? "Schedule Successfully Added" : "Schedule Successfully Updated";
                    
                    break;

                }
        
            }else{

                $correct_statement = "";
                
                break;
                
            }
		
	   }
        
    }

    require_once(SHARED_PATH."/schedules-content/schedule-form-actual.php");
    
?>