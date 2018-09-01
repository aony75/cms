<?php
    
    session_start();

    //constant variable can't be set here like footer and header becasue initalize.php are where the constants were defined
    require_once("../private/initialize.php");

    redirect_if_not_ajax_request("staff");
    
    $is_session_active = check_session_time();

    if($is_session_active == true){

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

        $modal_title = "mailing list";
        $hide_save_bttn_value = 0;
        require_once(SHARED_PATH."/modal-header.php");
        
    }

?>
<div data-active="<?php echo $is_session_active; ?>" id="mailing-list-modal-body" class="modal-body">
    <?php if($is_session_active){ ?>
        <div id="mailing-color-code">
            <span>
                <p>Early Mailing</p>
                <input class="early-mailing-color" read-only>
            </span>
            <span>
                <p>Pickup</p>
                 <input class="pickup-color" read-only>
            </span>
            <span>
                <p>Regular Mailing</p>
                <input class="regular-mailing-color" read-only>
            </span>
        </div>
    <table id="printer-list">
    <?php
        
        $staff_set = filter_sort_search_table($sql);
	
		$MAIL_SET = array("Pickup", "Early Mailing", "Regular Mailing");

    	$MAIL_COLOR_CLASS = array("pickup-color", "early-mailing-color", "regular-mailing-color");

        while($staff = mysqli_fetch_assoc($staff_set)){
                    
            $mail_count = 0;
                    
            foreach($MAIL_SET as $mail) {
                        
                if($staff["mail"] == $MAIL_SET[$mail_count]){
                            
                    $class_for_color = $MAIL_COLOR_CLASS[$mail_count];
                            
                }
                        
                $mail_count++;
                        
            }
                        
    ?>
        <tr class="<?php echo $class_for_color; ?>">
            <td>
                <?php echo h(ucwords($staff["last_name"])).", ".h(ucwords($staff["first_name"])); ?>
            </td>
            <td>
                <?php echo h($staff["mail"]); ?>
            </td>
        </tr>
    <?php
                    
        }
             
        mysqli_free_result($staff_set);
			
    ?>
    </table>
    <?php } ?>
</div>
<script type="text/javascript" src="<?php echo url_for("/scripts/modal.js"); ?>" async></script>