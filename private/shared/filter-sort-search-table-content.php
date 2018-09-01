<?php 

     $is_sort_asc = h($_GET["is_sort_asc"]);
		
    switch($is_sort_asc){
			
        case "true":
				
            $sort_type = "ASC";
				
            break;
				
        case "false":
				
            $sort_type = "DESC";
				
            break;
				
        default:
				
            $sort_type = "";
				
    }

    $search = h($_GET["search"]);

    $empty_count = 0;

    $inner_join = ($table == "schedules".$_SESSION["table_indentifier"]) ? " INNER JOIN staff".$_SESSION["table_indentifier"]." ON schedules".$_SESSION["table_indentifier"].".staff_id = staff".$_SESSION["table_indentifier"].".id INNER JOIN clients".$_SESSION["table_indentifier"]." ON schedules".$_SESSION["table_indentifier"].".client_id = clients".$_SESSION["table_indentifier"].".id" : "";

    foreach($filter_set as $key => $value){
        
        if(($key != "time_in" && $key != "time_out" && $key != "client_id" && $key != "staff_id") || (!empty($filter_set["id"]) && $table == "clients".$_SESSION["table_indentifier"] && ($key == "id" || $key == "first_name" || $key == "last_name"))){
        
            if(empty($value)){$empty_count++;}
            
        }
        
    }

    $columns_for_search = "";
        
    $is_there_search = false;
        
    if((strlen($search) <= 100) && (!empty($search))){$is_there_search = true;}
        
    foreach ($filter_set as $key => $value) {
       
        if(empty($value) && $is_there_search == true){
               
            if($key != "time_in" && $key != "time_out" && $key != "client_id" && $key != "staff_id"){
                
                $period = ($key == "clients".$_SESSION["table_indentifier"].".last_name" || $key == "clients".$_SESSION["table_indentifier"].".first_name" || $key == "staff".$_SESSION["table_indentifier"].".last_name" || $key == "staff".$_SESSION["table_indentifier"].".first_name") ? "" : ".";
                
                $table_for_search = ($key == "clients".$_SESSION["table_indentifier"].".last_name" || $key == "clients".$_SESSION["table_indentifier"].".first_name" || $key == "staff".$_SESSION["table_indentifier"].".last_name" || $key == "staff".$_SESSION["table_indentifier"].".first_name") ? "" : $table;
                
                if(empty($columns_for_search)){
                    
                    $columns_for_search = " AND (WHERE ".$table_for_search.$period.$key." LIKE '%".e($search)."%'";
                    
                }else{

                    $columns_for_search .= ($empty_count == 1) ? " OR ".$table_for_search.$period.$key." LIKE '%".e($search)."%')" : " OR ".$table_for_search.$period.$key." LIKE '%".e($search)."%'";
                    
                }
                
            }
            
            if(($key != "time_in" && $key != "time_out" && $key != "client_id" && $key != "staff_id") || (!empty($filter_set["id"]) && $table == "clients" && ($key == "id" || $key == "first_name" || $key == "last_name"))){$empty_count--;}
            
        }else if(!empty($value)){
            
            $in_or_out = ($key == "time_in") ? "in" : "out";
            
            $time_filter = sql_for_time_filter($in_or_out, $value);
                
            if(empty($filtered_columns)){
                    
                $filtered_columns = ($key == "time_in" || $key == "time_out") ? "WHERE ".$time_filter : "WHERE ".$table.".".$key." = '".e($value)."'";
             
            }else{
                    
                $filtered_columns .= ($key == "time_in" || $key == "time_out") ? " AND ".$time_filter : " AND ".$table.".".$key." = '".e($value)."'";
                    
            } 
        
        }
            
    }

    $filtered_columns = empty($filtered_columns) ? "" : $filtered_columns;

    if(!empty($columns_for_search)){

        $columns_for_search = empty($filtered_columns) ? substr($columns_for_search, 6) : $columns_for_search;
        
        $columns_for_search = empty($filtered_columns) ? substr($columns_for_search, 0, -1) : $columns_for_search;
      
        $columns_for_search = !empty($filtered_columns) ? str_replace("WHERE ", "", $columns_for_search) : $columns_for_search;

    }

    $sql = empty($columns_for_search) ? $filtered_columns : $filtered_columns.$columns_for_search;
        
    $sql = "SELECT ".$table.".* FROM ".$table.$inner_join." ".$sql.$order_by_column_name.$sort_type;

?>