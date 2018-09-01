<?php
   
    session_start();

    //constant variable can't be set here like footer and header becasue initalize.php are where the constants were defined
    require_once("../private/initialize.php");

    redirect_if_not_ajax_request("clients");

    if(check_session_time() == true){

        $table = "clients".$_SESSION["table_indentifier"];

        $filter_set = [];

        $filter_set["first_name"] = "";
        $filter_set["last_name"] = "";

        if((array_key_exists("client", $_GET)) && (array_key_exists("current_filter_client", $_GET))){

            $filter_set["id"] = empty(h($_GET["client"])) ? h($_GET["current_filter_client"]) : h($_GET["client"]);

            $filter_set["amerigroup_number"] = empty(h($_GET["amerigroup_number"])) ? h($_GET["current_filter_amerigroup_number"]) : h($_GET["amerigroup_number"]);

            $filter_set["medicaid_id"] = empty(h($_GET["medicaid_id"])) ? h($_GET["current_filter_medicaid_id"]) : h($_GET["medicaid_id"]);

            $filter_set["phone_number"] = empty(h($_GET["phone_number"])) ? h($_GET["current_filter_phone_number"]) : h($_GET["phone_number"]);

            $filter_set["evv_id"] = empty(h($_GET["evv_id"])) ? h($_GET["current_filter_evv_id"]) : h($_GET["evv_id"]);

        }else if((!array_key_exists("client", $_GET)) && (array_key_exists("current_filter_client", $_GET))){

            $filter_set["id"] = h($_GET["current_filter_client"]);

            $filter_set["amerigroup_number"] = h($_GET["current_filter_amerigroup_number"]);

            $filter_set["medicaid_id"] = h($_GET["current_filter_medicaid_id"]);

            $filter_set["phone_number"] = h($_GET["current_filter_phone_number"]);

            $filter_set["evv_id"] = h($_GET["current_filter_evv_id"]);

        }else{

            $filter_set["id"] = "";

            $filter_set["amerigroup_number"] = "";

            $filter_set["medicaid_id"] = "";

            $filter_set["phone_number"] = "";

            $filter_set["evv_id"] = "";

        }

        $column_name = h($_GET["column_name"]);

        switch($column_name){

            case "ID":

                $order_by_column_name = " ORDER BY evv_id ";

                break;

            case "Client":

                $order_by_column_name = " ORDER BY last_name ";

                break;

            case "Amerigroup Number":

                $order_by_column_name = " ORDER BY amerigroup_number ";

                break;

            case "Medicaid ID":

                $order_by_column_name = " ORDER BY medicaid_id ";

                break;

                case "Phone Number":

                $order_by_column_name = " ORDER BY phone_number ";

                break;

            default:

                $order_by_column_name = " ORDER BY last_name ASC";

        }

        require_once(SHARED_PATH."/filter-sort-search-table-content.php");

        //echo "<script>alert('".$sql."')</script>";

        $client_set = filter_sort_search_table($sql);

        if(mysqli_num_rows($client_set) == 0){

                echo "<p class='no-results'>no results found</p>";

            }else{

                while($client = mysqli_fetch_assoc($client_set)){

                    require(SHARED_PATH."/client-content/client-row.php");

            }

            /*frees space being used to hold the result of the query from 	mysql_query($db, $sql)*/
            mysqli_free_result($client_set);

        }
        
    }

?>
