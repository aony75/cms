<?php
	
	//finds all clients 
	function find_all_clients() {
        
        // calls $db from outside scope to use 
        global $db;
        
        /*preferred way of handling complex quueries
        $sql = "SELECT* FROM subjects";
        $sql .= "ORDER BY position ASC";
        */
        
        //assigns sql commmand to $sql
        $sql = "SELECT* FROM clients".$_SESSION["table_indentifier"]." ORDER BY last_name ASC";
        
        //assigns the mysqli_query() to $result
        $result = mysqli_query($db, $sql);
        
        //checks to make sure $result (mysqli_query()) returns a value. exit if it doesnt
        confirm_result_set($result);
        
        //returns result of the mysqli_query()
        return $result;
        
    }
    
	//drops any old tables that are not in use anymore
    function drop_all_old_tables_on_login(){
        
        // calls $db from outside scope to use 
        global $db;
        
        //assigns sql commmand to $sql
        $sql = "SHOW tables";
        
        //assigns the mysqli_query() to $result
        $result = mysqli_query($db, $sql);
        
        //checks to make sure $result (mysqli_query()) returns a value. exit if it doesnt
        confirm_result_set($result);
       
        while($table = mysqli_fetch_array($result)){
            
            if($table[0] == "clients" || $table[0] == "staff" || $table[0] == "schedules" || $table[0] == "users"){continue;}

            procedures_for_dropping_old_tables($table[0]);
            
        }
                 
        mysqli_free_result($result);
        
    }
	
	//this function is called in a loop and drops each table not in session
    function procedures_for_dropping_old_tables($table){
        
        global $db;
        
        $sql = "SELECT timestamp from ".$table." ORDER BY timestamp DESC LIMIT 1";
               
        //assigns the mysqli_query() to $result
        $result_2 = mysqli_query($db, $sql);
           
        //checks to make sure $result (mysqli_query()) returns a value. exit if it doesnt
        confirm_result_set($result_2);
               
        $timestamp = mysqli_fetch_array($result_2);

        mysqli_free_result($result_2);
            
        $timestamp_conversion = strtotime($timestamp[0]);
            
        $sql = "SELECT NOW()";

        $result_3 = mysqli_query($db, $sql);

        confirm_result_set($result_3);
            
        $current_time = mysqli_fetch_array($result_3);
            
        $current_time_conversion =strtotime($current_time[0]);
           
        mysqli_free_result($result_3);
            
        $is_table_an_hr_old = $current_time_conversion - $timestamp_conversion;
            
        if($is_table_an_hr_old > 3600){

            $sql = "DROP TABLE ".$table;

            $result_4 = mysqli_query($db, $sql);

            if(!$result_4){

                db_result_error($db);

            }
                    
        }
        
    }
	
	//drops old tables in each page besides login
    function drop_all_old_tables(){
        
        // calls $db from outside scope to use 
        global $db;
        
        //assigns sql commmand to $sql
        $sql = "SHOW tables";
        
        //assigns the mysqli_query() to $result
        $result = mysqli_query($db, $sql);
        
        //checks to make sure $result (mysqli_query()) returns a value. exit if it doesnt
        confirm_result_set($result);
       
        while($table = mysqli_fetch_array($result)){
            
            if($table[0] == "clients" || $table[0] == "staff" || $table[0] == "schedules" || $table[0] == "users" || $table[0] == "clients".$_SESSION["table_indentifier"] || $table[0] == "staff".$_SESSION["table_indentifier"] || $table[0] == "schedules".$_SESSION["table_indentifier"]){continue;}
           
            procedures_for_dropping_old_tables($table[0]);
            
        }
                 
        mysqli_free_result($result);
        
    }
	
	//drops all old tables not in use on logout
    function drop_current_table_on_logout($table){
        
        // calls $db from outside scope to use 
        global $db;
        
        //assigns sql commmand to $sql
        $sql = "DROP TABLE ".$table.$_SESSION["table_indentifier"];
        
        //assigns the mysqli_query() to $result
        $result = mysqli_query($db, $sql);
        
        if(!$result){

            db_result_error($db);

        }else{

            return true;
            
        }
       
    }
	
	//finds all staff
	function find_all_staff() {
        
        // calls $db from outside scope to use 
        global $db;
        
        /*preferred way of handling complex quueries
        $sql = "SELECT* FROM subjects";
        $sql .= "ORDER BY position ASC";
        */
        
        //assigns sql commmand to $sql
        $sql = "SELECT* FROM staff".$_SESSION["table_indentifier"]." ORDER BY last_name ASC";
        
        //assigns the mysqli_query() to $result
        $result = mysqli_query($db, $sql);
        
        //checks to make sure $result (mysqli_query()) returns a value. exit if it doesnt
        confirm_result_set($result);
        
        //returns result of the mysqli_query()
        return $result;
        
    }

    //finds all schedules 
    function find_all_schedules() {
        
        // calls $db from outside scope to use 
        global $db;
        
        /*preferred way of handling complex quueries
        $sql = "SELECT* FROM subjects";
        $sql .= "ORDER BY position ASC";
        */
        
        //assigns sql commmand to $sql
        $sql = "SELECT* FROM schedules".$_SESSION["table_indentifier"]." ORDER BY id ASC";
        
        //assigns the mysqli_query() to $result
        $result = mysqli_query($db, $sql);
        
        //checks to make sure $result (mysqli_query()) returns a value. exit if it doesnt
        confirm_result_set($result);
        
        //returns result of the mysqli_query()
        return $result;
        
    }

	//finds all evv_ids for select field
    function find_all_evv_ids($table){
        
        // calls $db from outside scope to use 
        global $db;
        
        //assigns sql commmand to $sql
        $sql = "SELECT DISTINCT evv_id FROM ".$table.$_SESSION["table_indentifier"]." ORDER BY evv_id ASC";
        
        //assigns the mysqli_query() to $result
        $result = mysqli_query($db, $sql);
        
        //checks to make sure $result (mysqli_query()) returns a value. exit if it doesnt
        confirm_result_set($result);
        
        //returns result of the mysqli_query()
        return $result;
        
    }
	
	//checks if evv_id is unique when creating new person
    function validate_unique_evv_id($evv_id, $table, $id = ""){
        
        // calls $db from outside scope to use 
        global $db;
        
        //assigns sql commmand to $sql
        $sql = empty($id) ? "SELECT evv_id FROM ".$table.$_SESSION["table_indentifier"]." WHERE evv_id = ?" : "SELECT evv_id FROM ".$table.$_SESSION["table_indentifier"]." WHERE evv_id = ? AND id <> ?";
        
        $stmt = initialize_and_verify_stmt($db, $sql);
        
        if(empty($id)){
            
            if($table == "clients"){
            
                mysqli_stmt_bind_param($stmt, "s", $evv_id);
                
            }else{
                
                mysqli_stmt_bind_param($stmt, "i", $evv_id);
                
            }
            
        }else{
            
            if($table == "clients"){
            
                mysqli_stmt_bind_param($stmt, "si", $evv_id, $id);
                
            }else{
                
                mysqli_stmt_bind_param($stmt, "ii", $evv_id, $id);
                 
            }
            
        }
        
        mysqli_stmt_execute($stmt);

        mysqli_stmt_bind_result($stmt, $evv_id_col);
		
		$result = mysqli_stmt_fetch($stmt);
        
        if(!empty($result)){
            
            mysqli_stmt_close($stmt);
            
            return false;
            
        }else{
             
            mysqli_stmt_close($stmt);
            
            return true;
              
        }
        
    }

    //finds all ids for select field 
    function find_all_ids($table){
        
        // calls $db from outside scope to use 
        global $db;
        
        //assigns sql commmand to $sql
        $sql = "SELECT id FROM ".$table.$_SESSION["table_indentifier"]." ORDER BY id ASC";
        
        //assigns the mysqli_query() to $result
        $result = mysqli_query($db, $sql);
        
        //checks to make sure $result (mysqli_query()) returns a value. exit if it doesnt
        confirm_result_set($result);
        
        //returns result of the mysqli_query()
        return $result;
        
    }

	//finds all medicaid ids for select field
    function find_all_medicaid_ids(){
        
        // calls $db from outside scope to use 
        global $db;
        
        //assigns sql commmand to $sql
        $sql = "SELECT DISTINCT medicaid_id FROM clients".$_SESSION["table_indentifier"]." ORDER BY medicaid_id ASC";
        
        //assigns the mysqli_query() to $result
        $result = mysqli_query($db, $sql);
        
        //checks to make sure $result (mysqli_query()) returns a value. exit if it doesnt
        confirm_result_set($result);
        
        //returns result of the mysqli_query()
        return $result;
        
    }

	//finds all phone number for select field
     function find_all_phone_numbers($table){
        
        // calls $db from outside scope to use 
        global $db;
        
        //assigns sql commmand to $sql
        $sql = "SELECT DISTINCT phone_number FROM ".$table.$_SESSION["table_indentifier"]." ORDER BY phone_number ASC";
        
        //assigns the mysqli_query() to $result
        $result = mysqli_query($db, $sql);
        
        //checks to make sure $result (mysqli_query()) returns a value. exit if it doesnt
        confirm_result_set($result);
        
        //returns result of the mysqli_query()
        return $result;
        
    }

	//finds all amerigroup numbers for select field 
    function find_all_amerigroup_numbers(){
        
        // calls $db from outside scope to use 
        global $db;
        
        //assigns sql commmand to $sql
        $sql = "SELECT DISTINCT amerigroup_number FROM clients".$_SESSION["table_indentifier"]." ORDER BY amerigroup_number ASC";
        
        //assigns the mysqli_query() to $result
        $result = mysqli_query($db, $sql);
        
        //checks to make sure $result (mysqli_query()) returns a value. exit if it doesnt
        confirm_result_set($result);
        
        //returns result of the mysqli_query()
        return $result;
        
    }

	//finds all pay rates for select field
    function find_all_pay_rate_values(){
        
        // calls $db from outside scope to use 
        global $db;
        
        //assigns sql commmand to $sql
        $sql = "SELECT DISTINCT pay_rate FROM staff".$_SESSION["table_indentifier"]." ORDER BY pay_rate ASC";
        
        //assigns the mysqli_query() to $result
        $result = mysqli_query($db, $sql);
        
        //checks to make sure $result (mysqli_query()) returns a value. exit if it doesnt
        confirm_result_set($result);
        
        //returns result of the mysqli_query()
        return $result;
        
    }

	//finds all names for select field
    function find_all_names($table){
        
        // calls $db from outside scope to use 
        global $db;
        
        //assigns sql commmand to $sql
        $sql = "SELECT last_name, first_name, id, evv_id FROM ".$table.$_SESSION["table_indentifier"]." ORDER BY last_name ASC";
        
        //assigns the mysqli_query() to $result
        $result = mysqli_query($db, $sql);
        
        //checks to make sure $result (mysqli_query()) returns a value. exit if it doesnt
        confirm_result_set($result);
        
        //returns result of the mysqli_query()
        return $result;
        
    }

	//finds single name
    function find_single_name($table, $id){
        
        // calls $db from outside scope to use 
        global $db;
        
        //assigns sql commmand to $sql
        $sql = "SELECT last_name, first_name FROM ".$table.$_SESSION["table_indentifier"]." WHERE id = '".$id."'";
        
        $result = mysqli_query($db, $sql);
		
		confirm_result_set($result);
        
        $name_set = mysqli_fetch_assoc($result);
		
		mysqli_free_result($result);
     
        return $name_set;
        
    }

	//finds last id from a table
     function find_last_id($table){
        
        // calls $db from outside scope to use 
        global $db;
        
        //quick query so mysqli_insert_id works
        $sql = "SELECT id FROM ".$table.$_SESSION["table_indentifier"]." ORDER BY id DESC LIMIT 1";
        
        //assigns the mysqli_query() to $result
        $result = mysqli_query($db, $sql);
        
        //checks to make sure $result (mysqli_query()) returns a value. exit if it doesnt
        confirm_result_set($result);
        
        $last_id = mysqli_fetch_array($result);
         
        mysqli_free_result($result);

        return $last_id[0];
        
    }


    //finds the data type of a field from table
    function find_data_type($key, $table){
        
        // calls $db from outside scope to use 
        global $db;
        
        //quick query so mysqli_insert_id works
        $sql = "SELECT ".$key." FROM ".$table.$_SESSION["table_indentifier"]." ORDER BY ".$key." DESC LIMIT 1";
        
        //assigns the mysqli_query() to $result
        $result = mysqli_query($db, $sql);
        
        //checks to make sure $result (mysqli_query()) returns a value. exit if it doesnt
        confirm_result_set($result);
        
        $column_metadata = mysqli_fetch_field($result);
            
        $data_type = $column_metadata->type; 
         
        mysqli_free_result($result);

        return $data_type;
        
    }


    //finds clockin and clockout by staff or client
     function find_in_and_out_from_schedules_by_person($key_in, $key_out, $person_column, $where_person, $where_person_id){
         
        // calls $db from outside scope to use 
        global $db;
        
        //assigns sql commmand to $sql
        $sql = "SELECT id, ".$key_in.", ".$key_out.", ".$person_column." FROM schedules".$_SESSION["table_indentifier"]." WHERE ".$where_person." = ?";
         
        $stmt = initialize_and_verify_stmt($db, $sql);
        
        mysqli_stmt_bind_param($stmt, "i", $where_person_id);
        
        mysqli_stmt_execute($stmt);
        
        mysqli_stmt_bind_result($stmt, $id_col, $key_in_col, $key_out_col, $person_col);
    
        mysqli_stmt_fetch($stmt);

        mysqli_stmt_close($stmt);
        
        $schedule_set = [];
        $schedule_set["id"] = $id_col;
        $schedule_set["in"] = $key_in_col;
        $schedule_set["out"] = $key_out_col;
         
        $schedule_set["staff_id"] = ($person_column == "staff_id") ? $person_col : $where_person_id;
         
        $schedule_set["client_id"] = ($person_column == "client_id") ? $person_col : $where_person_id;
         
        return $schedule_set;
        
    }

	//finds client info for one client
	function find_client_info($id){
        
        //makes $db a global variable so it can be called from initialize.php
        global $db;
        
        //performs query then assigns them to $result_set variable
        //MUST PUT SINGLE QUOTES AROUND VARIABLES BEING USED TO RETRIEVE DATA FROM DATABASE
        $sql = "SELECT first_name, last_name, evv_id, amerigroup_number, medicaid_id, phone_number, comments FROM clients".$_SESSION["table_indentifier"]." WHERE id= ?";
        
        $stmt = initialize_and_verify_stmt($db, $sql);
        
        mysqli_stmt_bind_param($stmt, "i", $id);
        
        mysqli_stmt_execute($stmt);
        
        mysqli_stmt_bind_result($stmt, $first_name_col, $last_name_col, $evv_id_col, $amerigroup_number_col, $medicaid_id_col, $phone_number_col, $comments_col);
        
        //assigns associative array to $user_info_set
        //once associative array is in $user_info_set, the memory is released
       	mysqli_stmt_fetch($stmt);
        
        mysqli_stmt_close($stmt);
        
        //assigns values to variables and uses h() to protect against special characters
        $first_name = h($first_name_col);
        $last_name = h($last_name_col);
		$evv_id = h($evv_id_col);
        $amerigroup_number = h($amerigroup_number_col);
		$medicaid_id = h($medicaid_id_col);
        $phone_number = h($phone_number_col);
		$comments = h($comments_col);
        
        //return associative array for use
        return array("first_name" => $first_name_col, "last_name" => $last_name_col, "evv_id" => $evv_id_col, "amerigroup_number" => $amerigroup_number_col, "medicaid_id" => $medicaid_id_col, "phone_number" => $phone_number_col, "comments" => $comments_col);
        
    }

	//finds staff info for one person
    function find_staff_info($id){
        
        //makes $db a global variable so it can be called from initialize.php
        global $db;
        
        //performs query then assigns them to $result_set variable
        //MUST PUT SINGLE QUOTES AROUND VARIABLES BEING USED TO RETRIEVE DATA FROM DATABASE
        $sql = "SELECT first_name, last_name, evv_id, mail, pay_rate, phone_number, comments FROM staff".$_SESSION["table_indentifier"]." WHERE id= ?";
        
        $stmt = initialize_and_verify_stmt($db, $sql);
        
        mysqli_stmt_bind_param($stmt, "i", $id);
        
        mysqli_stmt_execute($stmt);
        
        mysqli_stmt_bind_result($stmt, $first_name_col, $last_name_col, $evv_id_col, $mail_col, $pay_rate_col, $phone_number_col, $comments_col);
        
        //assigns associative array to $user_info_set
        //once associative array is in $user_info_set, the memory is released
        mysqli_stmt_fetch($stmt);
        
        mysqli_stmt_close($stmt);
        
        //assigns values to variables and uses h() to protect against special characters
        $first_name = h($first_name_col);
        $last_name = h($last_name_col);
		$evv_id = (h($evv_id_col) == 0) ? "" : h($staff_info_set["evv_id"]);
        $mail = h($mail_col);
		$pay_rate = h($pay_rate_col);
        $phone_number = h($phone_number_col);
		$comments = h($comments_col);
        
        //return associative array for use
        return array("first_name" => $first_name_col, "last_name" => $last_name_col, "evv_id" => $evv_id_col, "mail" => $mail_col, "pay_rate" => $pay_rate_col, "phone_number" => $phone_number_col, "comments" => $comments_col);
        
    }

	//finds schedule by client or staff
    function find_schedule_by_client_or_staff_id($column_name, $where_column_name, $id){
        
        //makes $db a global variable so it can be called from initialize.php
        global $db;
        
        //performs query then assigns them to $result_set variable
        //MUST PUT SINGLE QUOTES AROUND VARIABLES BEING USED TO RETRIEVE DATA FROM DATABASE
        $sql = "SELECT id, ".$column_name." FROM schedules".$_SESSION["table_indentifier"]." WHERE ".$where_column_name."= ?";
        
        $stmt = initialize_and_verify_stmt($db, $sql);
        
        mysqli_stmt_bind_param($stmt, "i", $id);
        
        mysqli_stmt_execute($stmt);
        
        mysqli_stmt_bind_result($stmt, $id_col, $id_name_col);
		
		$schedule_set = [];
		
		while(mysqli_stmt_fetch($stmt)){
			
			array_push($schedule_set, array("id" => $id_col, $column_name => $id_name_col));
			
		}
        
        mysqli_stmt_close($stmt);
      
        return $schedule_set;
        
    }

	//gets schedule info by id 
    function find_schedule_info($id){
        
        //makes $db a global variable so it can be called from initialize.php
        global $db;
        
        //performs query then assigns them to $result_set variable
        //MUST PUT SINGLE QUOTES AROUND VARIABLES BEING USED TO RETRIEVE DATA FROM DATABASE
        $sql = "SELECT client_id, staff_id, sun_in, sun_out, mon_in, mon_out, tues_in, tues_out, wed_in, wed_out, thurs_in, thurs_out, fri_in, fri_out, sat_in, sat_out, comments FROM schedules".$_SESSION["table_indentifier"]." WHERE id= ?";
        
        $stmt = initialize_and_verify_stmt($db, $sql);
       
        mysqli_stmt_bind_param($stmt, "i", $id);
        
        mysqli_stmt_execute($stmt);
        
        mysqli_stmt_bind_result($stmt, $client_id_col, $staff_id_col, $sun_in_col, $sun_out_col, $mon_in_col, $mon_out_col, $tues_in_col, $tues_out_col, $wed_in_col, $wed_out_col, $thurs_in_col, $thurs_out_col, $fri_in_col, $fri_out_col, $sat_in_col, $sat_out_col, $comments);
		
		mysqli_stmt_fetch($stmt);
        
        mysqli_stmt_close($stmt);
    
        //return associative array for use
        return array("client_id" => h($client_id_col), "staff_id" => h($staff_id_col), "sun_in" => h($sun_in_col), "sun_out" => h($sun_out_col), "mon_in" => h($mon_in_col), "mon_out" => h($mon_out_col), "tues_in" => h($tues_in_col), "tues_out" => h($tues_out_col), "wed_in" => h($wed_in_col), "wed_out" => h($wed_out_col), "thurs_in" => h($thurs_in_col), "thurs_out" => h($thurs_out_col), "fri_in" => h($fri_in_col), "fri_out" => h($fri_out_col), "sat_in" => h($sat_in_col), "sat_out" => h($sat_out_col), "comments" => h($comments));
        
    }

	//creates a new client
	function create_new_client($new_client){
        
        global $db;
		
        $sql = "INSERT INTO clients".$_SESSION["table_indentifier"]." ";
        $sql .= "(evv_id, first_name, last_name, amerigroup_number, medicaid_id, phone_number, comments) ";
        $sql .= "VALUE(?, ?, ?, ?, ?, ?, ?)";
        
        $stmt = initialize_and_verify_stmt($db, $sql);
        
        mysqli_stmt_bind_param($stmt, "sssiiss", $new_client["evv_id"], $new_client["first_name"], $new_client["last_name"], $new_client["amerigroup_number"], $new_client["medicaid_id"], $new_client["phone_number"], $new_client["comments"]);
        
        mysqli_stmt_execute($stmt);
        
		$affected_rows = mysqli_stmt_affected_rows($stmt);
		
        mysqli_stmt_close($stmt);
        
		if($affected_rows == 1){
			
        	return true;
			
		}else{
			
			return false;
			
		}
        
    }

	//creates a new staff
    function create_new_staff($new_staff){
        
        global $db;
		
        $sql = "INSERT INTO staff".$_SESSION["table_indentifier"]." ";
        $sql .= "(evv_id, first_name, last_name, pay_rate, mail, phone_number, comments) ";
        $sql .= "VALUE(?, ?, ?, ?, ?, ?, ?)";
        
        $stmt = initialize_and_verify_stmt($db, $sql);
       
        mysqli_stmt_bind_param($stmt, "issssss", $new_staff["evv_id"], $new_staff["first_name"], $new_staff["last_name"], $new_staff["pay_rate"], $new_staff["mail"], $new_staff["phone_number"], $new_staff["comments"]);
        
        mysqli_stmt_execute($stmt);
        
        $affected_rows = mysqli_stmt_affected_rows($stmt);
		
        mysqli_stmt_close($stmt);
        
		if($affected_rows == 1){
			
        	return true;
			
		}else{
			
			return false;
			
		}
        
    }
	
	//creates new schedule
    function create_new_schedule($new_schedule){
        
        global $db;
		
        $sql = "INSERT INTO schedules".$_SESSION["table_indentifier"]." ";
        $sql .= "(client_id, staff_id, sun_in, sun_out, mon_in, mon_out, tues_in, tues_out, wed_in, wed_out, thurs_in, thurs_out, fri_in, fri_out, sat_in, sat_out, comments)";
        $sql .= "VALUE(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        
        $stmt = initialize_and_verify_stmt($db, $sql);
       
        mysqli_stmt_bind_param($stmt, "iisssssssssssssss", $new_schedule["client"], $new_schedule["staff"], $new_schedule["sun_in"], $new_schedule["sun_out"], $new_schedule["mon_in"], $new_schedule["mon_out"], $new_schedule["tues_in"], $new_schedule["tues_out"], $new_schedule["wed_in"], $new_schedule["wed_out"], $new_schedule["thurs_in"], $new_schedule["thurs_out"], $new_schedule["fri_in"], $new_schedule["fri_out"], $new_schedule["sat_in"], $new_schedule["sat_out"], $new_schedule["comments"]);
        
        mysqli_stmt_execute($stmt);
        
        $affected_rows = mysqli_stmt_affected_rows($stmt);
		
        mysqli_stmt_close($stmt);
        
		if($affected_rows == 1){
			
        	return true;
			
		}else{
			
			return false;
			
		}
        
    }

	//edits info for client
	function update_client($client){
        
        global $db;
		
        $sql = "UPDATE clients".$_SESSION["table_indentifier"]." SET ";
        $sql .= "evv_id = ?, first_name = ?, last_name = ?, amerigroup_number = ?, medicaid_id = ?, phone_number = ?, comments = ? ";
        $sql .= "WHERE id = ?";
		
        $stmt = initialize_and_verify_stmt($db, $sql);
       
        mysqli_stmt_bind_param($stmt, "sssiissi", $client["evv_id"], $client["first_name"], $client["last_name"], $client["amerigroup_number"], $client["medicaid_id"], $client["phone_number"], $client["comments"], $client["id"]);
        
        mysqli_stmt_execute($stmt);
        
        $affected_rows = mysqli_stmt_affected_rows($stmt);
		
        mysqli_stmt_close($stmt);
        
		if($affected_rows == 1){
			
        	return true;
			
		}else{
			
			return false;
			
		}
        
    }

	//edits staff info by id 
    function update_staff($staff){
        
        global $db;
		
        $sql = "UPDATE staff".$_SESSION["table_indentifier"]." SET ";
        $sql .= "evv_id = ?, first_name = ?, last_name = ?, mail = ?, pay_rate = ?, phone_number = ?, comments = ? ";
        $sql .= "WHERE id = ?";
		
        $stmt = initialize_and_verify_stmt($db, $sql);
       
        mysqli_stmt_bind_param($stmt, "ssssdssi", $staff["evv_id"], $staff["first_name"], $staff["last_name"], $staff["mail"], $staff["pay_rate"], $staff["phone_number"], $staff["comments"], $staff["id"]);
        
        mysqli_stmt_execute($stmt);
        
        $affected_rows = mysqli_stmt_affected_rows($stmt);
		
        mysqli_stmt_close($stmt);
        
		if($affected_rows == 1){
			
        	return true;
			
		}else{
			
			return false;
			
		}
        
    }

	//edits schedule by id
    function update_schedule($schedule){
        
        global $db;
		
        $sql = "UPDATE schedules".$_SESSION["table_indentifier"]." SET ";
        $sql .= "client_id = ?, staff_id = ?, sun_in = ?, sun_out = ?, mon_in = ?, mon_out = ?, tues_in = ?, tues_out = ?, wed_in = ?, wed_out = ?, thurs_in = ?, thurs_out = ?, fri_in = ?, fri_out = ?, sat_in = ?, sat_out = ?, comments = ? ";
        $sql .= "WHERE id = ?";
		
        $stmt = initialize_and_verify_stmt($db, $sql);
       
        mysqli_stmt_bind_param($stmt, "iisssssssssssssssi", $schedule["client"], $schedule["staff"], $schedule["sun_in"], $schedule["sun_out"], $schedule["mon_in"], $schedule["mon_out"], $schedule["tues_in"], $schedule["tues_out"], $schedule["wed_in"], $schedule["wed_out"], $schedule["thurs_in"], $schedule["thurs_out"], $schedule["fri_in"], $schedule["fri_out"], $schedule["sat_in"], $schedule["sat_out"], $schedule["comments"], $schedule["id"]);
        
        mysqli_stmt_execute($stmt);
        
        $affected_rows = mysqli_stmt_affected_rows($stmt);
		
        mysqli_stmt_close($stmt);
        
		if($affected_rows == 1){
			
        	return true;
			
		}else{
			
			return false;
			
		}
        
    }



	 //deletes single record
    //takes table and id as parameters and deletes according to $table and $id
    function delete_query($table, $id) {
        
        global $db;
 
        if($table == "clients" || $table == "staff"){
           
            $column_name = ($table == "clients") ? "client_id" : "staff_id";
           
             //creates query command and executes it with mysqli_query()
            $sql = "DELETE FROM schedules".$_SESSION["table_indentifier"]." WHERE ".$column_name." = ? LIMIT 1";

            $stmt = initialize_and_verify_stmt($db, $sql);
       
            mysqli_stmt_bind_param($stmt, "i", $id);
        
            mysqli_stmt_execute($stmt);
        
            mysqli_stmt_close($stmt);
            
        }
        
        //creates query command and executes it with mysqli_query()
        $sql = "DELETE FROM ".$table.$_SESSION["table_indentifier"]." WHERE id= ? LIMIT 1";

        $stmt = initialize_and_verify_stmt($db, $sql);
       
        mysqli_stmt_bind_param($stmt, "i", $id);
        
        mysqli_stmt_execute($stmt);
        
        $affected_rows = mysqli_stmt_affected_rows($stmt);
		
        mysqli_stmt_close($stmt);
        
		if($affected_rows == 1){
			
        	return true;
			
		}else{
			
			return false;
			
		}
        
    }


	//deletes multiple records
    //takes table and id as parameters and deletes according to $table and $id
    function delete_multiple_query($table, $id_set) {
       
        global $db;
         
        if($table == "clients" || $table == "staff"){
           
            $column_name = ($table == "clients") ? "client_id" : "staff_id";
            
            //creates query command and executes it with mysqli_query()
            $sql = "DELETE FROM schedules".$_SESSION["table_indentifier"]." WHERE ".$column_name." IN(".$id_set.")";
            
             $result = mysqli_query($db, $sql);
  
            //if result is false error will print on screen, close database connection, and exit out of php and mysql
            if(!$result){

               db_result_error($db);

            }
            
        }
        
        //creates query command and executes it with mysqli_query()
        $sql = "DELETE FROM ".$table.$_SESSION["table_indentifier"]." WHERE id IN(".$id_set.")";

        $result = mysqli_query($db, $sql);
  
        //if result is false error will print on screen, close database connection, and exit out of php and mysql
        if(!$result){
			
           db_result_error($db);
			
        }else{
			
            return true;
        }
        
    }

	//performs sql for filter, sort, and search based on user input
    function filter_sort_search_table($sql) {
        
        // calls $db from outside scope to use 
        global $db;
        
        //assigns the mysqli_query() to $result
        $result = mysqli_query($db, $sql);
		
		if(!$result){
			
			 db_result_error($db);
			
		}else{
			
			//checks to make sure $result (mysqli_query()) returns a value. exit if it doesnt
        	confirm_result_set($result);
        
        	//returns result of the mysqli_query()
        	return $result;
			
		}
		
    }
	
	//finds salt for password by user
    function find_salt_for_user($username) {
        
        // calls $db from outside scope to use 
        global $db;
        
        $sql = "SELECT salt FROM users WHERE username = ?";
        
        $stmt = initialize_and_verify_stmt($db, $sql);
       
        mysqli_stmt_bind_param($stmt, "s", $username);
        
        mysqli_stmt_execute($stmt);
        
        mysqli_stmt_bind_result($stmt, $salt_col);
            
        while(mysqli_stmt_fetch($stmt)){
			
			$salt = $salt_col;
			
		}
		
		mysqli_stmt_close($stmt);
        
        //returns result of the mysqli_query()
        return $salt;
		
    }
	
	//verifies passsword
    function validate_password($username, $password) {
        
        // calls $db from outside scope to use 
        global $db;
        
        $sql = "SELECT password FROM users WHERE username = ?";
        
        $stmt = initialize_and_verify_stmt($db, $sql);
       
        mysqli_stmt_bind_param($stmt, "s", $username);
        
        mysqli_stmt_execute($stmt);
		
		mysqli_stmt_bind_result($stmt, $password_col);
        
		while(mysqli_stmt_fetch($stmt)){
			
			$retrieved_password = $password_col;
			
		}
        
        mysqli_stmt_close($stmt);
            
        $salt = find_salt_for_user($username);
            
        $hashed_password = hash("sha512", $salt.$password.$salt);
        
        if($hashed_password == $retrieved_password){
                
            return true;
                
        }else{
                
            return false;
                
        }

    }
	
	//creates user table 
    function create_user_table($table, $table_indentifier){
        
        global $db;
		
        $sql = "CREATE TABLE ".$table.$table_indentifier." LIKE ".$table;
        
        //insert statements will return true or false
        $result = mysqli_query($db, $sql);
        
        //if result is false error will print on screen, close database connection, and exit out of php and mysql
        if(!$result){
			
           db_result_error($db);
			
        }
        
        $sql = "INSERT ".$table.$table_indentifier." SELECT * FROM ".$table;
        
        //insert statements will return true or false
        $result = mysqli_query($db, $sql);
        
        //if result is false error will print on screen, close database connection, and exit out of php and mysql
        if(!$result){
			
           db_result_error($db);
			
        }
        
        $sql = "UPDATE ".$table.$table_indentifier." SET timestamp = NOW()";
        
        //insert statements will return true or false
        $result = mysqli_query($db, $sql);
        
        //if result is false error will print on screen, close database connection, and exit out of php and mysql
        if(!$result){
			
           db_result_error($db);
			
        }
        
    }

?>