<?
    //constant variable can't be set here like footer and header becasue initalize.php are where the constants were defined
    require_once("../../private/initialize.php");

   

?>
<div id="show-schedule-modal-body" class="modal-body modal-form-body show-content">
	<div class="edit-wrapper">
		<a id="back-bttn" href="#">&laquo;Back to&nbsp;</a>
		<button class="table-bttn delete-bttn">Delete <i class="fa fa-trash-o trash-icon"></i></button>
        <label id="edit-label">Edit:&nbsp;</label>
        <input type="checkbox">
    </div>
    <form id="<?php echo $form_id; ?>" class="modal-form">
    <?php
        
        $is_session_active = check_session_time();
        
        $input_border = "";
        $incorrect_input = "";

        $new_schedule = [];

        $new_schedule["client"] = "";
        $new_schedule["staff"] = "";
        $new_schedule["start_date"] = "";
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
            
        }
        
        if($is_session_active == true){
            
            if(is_GET_request()){

                $id = h($_GET["id"]);

                $new_schedule = find_schedule_info($id);

            }
            
        }
        
        require_once(SHARED_PATH."/schedules-content/schedule-form-actual.php");
    
    ?>
    </form>
</div>
<script type="text/javascript" src="<?php echo url_for("/scripts/new-schedule.js"); ?>" async></script>
<script type="text/javascript" src="<?php echo url_for("/scripts/modal.js"); ?>" async></script>
<script type="text/javascript" src="<?php echo url_for("/scripts/show.js"); ?>" async></script>