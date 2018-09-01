<?
    //constant variable can't be set here like footer and header becasue initalize.php are where the constants were defined
    require_once("../../private/initialize.php")

?>
<div id="new-schedule-modal-body" class="modal-body modal-form-body">
    <div class="edit-wrapper">
		<a id="back-bttn" href="#">&laquo;Back to&nbsp;</a>
    </div>
    <form id="<?php echo $form_id; ?>" class="modal-form">
    <?php
        
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
        $start_date_border = "";
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
        
        if(is_GET_request()){
            
            if(array_key_exists("client_id", $_GET)){
                
                $new_schedule["client_id"] = h($_GET["client_id"]);
                
            }else if(array_key_exists("staff_id", $_GET)){
                
                $new_schedule["staff_id"] = h($_GET["staff_id"]);
                
            }
            
            $id = "";
            
        }
        
        require_once(SHARED_PATH."/schedules-content/schedule-form-actual.php");
    
    ?>
    </form>
</div>
<script type="text/javascript" src="<?php echo url_for("/scripts/new-schedule.js"); ?>" async></script>
<script type="text/javascript" src="<?php echo url_for("/scripts/modal.js"); ?>" async></script>