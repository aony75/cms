<?php 
    
    session_start();

    //constant variable can't be set here like footer and header becasue initalize.php are where the constants were defined
    require_once("../private/initialize.php");

    redirect_if_not_ajax_request("schedules");

    if(check_session_time() == true){

        $table = "schedules".$_SESSION["table_indentifier"];

        /*foreach($_GET as $key => $value){

            echo "<script>alert('key: ".$key." value: ".$value."');</script>";
        }*/

        $filter_set = [];

        $filter_set["sun_in"] = "";
        $filter_set["sun_out"] = "";

        $filter_set["mon_in"] = "";
        $filter_set["mon_out"] = "";

        $filter_set["tues_in"] = "";
        $filter_set["tues_out"] = "";

        $filter_set["wed_in"] = "";
        $filter_set["wed_out"] = "";

        $filter_set["thurs_in"] = "";
        $filter_set["thurs_out"] = "";

        $filter_set["fri_in"] = "";
        $filter_set["fri_out"] = "";

        $filter_set["sat_in"] = "";
        $filter_set["sat_out"] = "";

        $filter_set["clients".$_SESSION["table_indentifier"].".last_name"] = "";
        $filter_set["clients".$_SESSION["table_indentifier"].".first_name"] = "";

        $filter_set["staff".$_SESSION["table_indentifier"].".last_name"] = "";
        $filter_set["staff".$_SESSION["table_indentifier"].".first_name"] = "";


        if((array_key_exists("schedule_id", $_GET)) && (array_key_exists("current_filter_schedule_id", $_GET))){

            $filter_set["time_in"] = empty(h($_GET["time_in"])) ? h($_GET["current_filter_time_in"]) : h($_GET["time_in"]);

            $filter_set["time_out"] = empty(h($_GET["time_out"])) ? h($_GET["current_filter_time_out"]) : h($_GET["time_out"]);

            $filter_set["id"] = empty(h($_GET["schedule_id"])) ? h($_GET["current_filter_schedule_id"]) : h($_GET["schedule_id"]);

            $filter_set["staff_id"] = empty(h($_GET["staff"])) ? h($_GET["current_filter_staff"]) : h($_GET["staff"]);

            $filter_set["client_id"] = empty(h($_GET["client"])) ? h($_GET["current_filter_client"]) : h($_GET["client"]);

        }else if((!array_key_exists("schedule_id", $_GET)) && (array_key_exists("current_filter_schedule_id", $_GET))){

            $filter_set["time_in"] = h($_GET["current_filter_time_in"]);

            $filter_set["time_out"] = h($_GET["current_filter_time_out"]);

            $filter_set["id"] = h($_GET["current_filter_schedule_id"]);

            $filter_set["staff_id"] = h($_GET["current_filter_staff"]);

            $filter_set["client_id"] = h($_GET["current_filter_client"]);

        }else{

            $filter_set["time_in"] = "";

            $filter_set["time_out"] = "";

            $filter_set["id"] = "";

            $filter_set["staff_id"] = "";

            $filter_set["client_id"] = "";

        }

        $column_name = h($_GET["column_name"]);

        switch($column_name){

            case "ID":

                $order_by_column_name = " ORDER BY id ";

                break;

            case "Staff":

                $order_by_column_name = " ORDER BY staff".$_SESSION["table_indentifier"].".last_name ";

                break;

            case "Client":

                $order_by_column_name = " ORDER BY clients".$_SESSION["table_indentifier"].".last_name ";

                break;

            case "Sun":

                $order_by_column_name = " ORDER BY sun_in ";

                break;

            case "Mon":

                $order_by_column_name = " ORDER BY mon_in ";

                break;

            case "Tues":

                $order_by_column_name = " ORDER BY tues_in ";

                break;

            case "Wed":

                $order_by_column_name = " ORDER BY wed_in ";

                break;

            case "Thurs":

                $order_by_column_name = " ORDER BY thurs_in ";

                break;

            case "Fri":

                $order_by_column_name = " ORDER BY fri_in ";

                break;

            case "Sat":

                $order_by_column_name = " ORDER BY sat_in ";

                break;

            default:

                $order_by_column_name = " ORDER BY id ASC";

        }

        require_once(SHARED_PATH."/filter-sort-search-table-content.php");

        //echo "<script>alert('".$sql."')</script>";

        $schedule_set = filter_sort_search_table($sql);

        if(mysqli_num_rows($schedule_set) == 0){

                echo "<p class='no-results'>no results found</p>";

        }else{

            while($schedule = mysqli_fetch_assoc($schedule_set)){

                require(SHARED_PATH."/schedules-content/schedule-row.php");

            }

            /*frees space being used to hold the result of the query from 	mysql_query($db, $sql)*/
            mysqli_free_result($schedule_set);

        }
        
    }

?>
