<?php 
    
    session_start();

    //constant variable can't be set here like footer and header becasue initalize.php are where the constants were defined
    require_once("../private/initialize.php");

    redirect_if_not_ajax_request("staff");

    if(check_session_time() == true){

        $table = "staff".$_SESSION["table_indentifier"];

        $filter_set = [];

        $filter_set["first_name"] = "";
        $filter_set["last_name"] = "";

        if((array_key_exists("staff", $_GET)) && (array_key_exists("current_filter_staff", $_GET))){

            $filter_set["id"] = empty(h($_GET["staff"])) ? h($_GET["current_filter_staff"]) : h($_GET["staff"]);

            $filter_set["pay_rate"] = empty(h($_GET["pay_rate"])) ? h($_GET["current_filter_pay_rate"]) : h($_GET["pay_rate"]);

            $filter_set["mail"] = empty(h($_GET["mail"])) ? h($_GET["current_filter_mail"]) : h($_GET["mail"]);

            $filter_set["phone_number"] = empty(h($_GET["phone_number"])) ? h($_GET["current_filter_phone_number"]) : h($_GET["phone_number"]);

            $filter_set["evv_id"] = empty(h($_GET["evv_id"])) ? h($_GET["current_filter_evv_id"]) : h($_GET["evv_id"]);

        }else if((!array_key_exists("staff", $_GET)) && (array_key_exists("current_filter_staff", $_GET))){

            $filter_set["id"] = h($_GET["current_filter_staff"]);

            $filter_set["pay_rate"] = h($_GET["current_filter_pay_rate"]);

            $filter_set["mail"] = h($_GET["current_filter_mail"]);

            $filter_set["phone_number"] = h($_GET["current_filter_phone_number"]);

            $filter_set["evv_id"] = h($_GET["current_filter_evv_id"]);

        }else{

            $filter_set["id"] = "";

            $filter_set["pay_rate"] = "";

            $filter_set["mail"] = "";

            $filter_set["phone_number"] = "";

            $filter_set["evv_id"] = "";

        }

        $column_name = h($_GET["column_name"]);

        switch($column_name){

            case "ID":

                $order_by_column_name = " ORDER BY evv_id ";

                break;

            case "Staff":

                $order_by_column_name = " ORDER BY last_name ";

                break;

            case "Pay Rate":

                $order_by_column_name = " ORDER BY pay_rate ";

                break;

            case "Mail":

                $order_by_column_name = " ORDER BY mail ";

                break;

            case "Phone Number":

                $order_by_column_name = " ORDER BY phone_number ";

                break;

            default:

                $order_by_column_name = " ORDER BY last_name ASC";

        }

        require_once(SHARED_PATH."/filter-sort-search-table-content.php");

        //echo "<script>alert('".$sql."')</script>";

        $staff_set = filter_sort_search_table($sql);

        if(mysqli_num_rows($staff_set) == 0){

                echo "<p class='no-results'>no results found</p>";

            }else{

                while($staff = mysqli_fetch_assoc($staff_set)){

                    require(SHARED_PATH."/staff-content/staff-row.php");

            }

            /*frees space being used to hold the result of the query from 	mysql_query($db, $sql)*/
            mysqli_free_result($staff_set);

        }
        
    }

?>
