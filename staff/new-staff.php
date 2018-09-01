<?php

    session_start();

    //constant variable can't be set here like footer and header becasue initalize.php are where the constants were defined
    require_once("../private/initialize.php");

    redirect_if_not_ajax_request("staff");

    $is_session_active = check_session_time();
    
    $input_border = "";
	$incorrect_input = "";

	$new_staff = [];
	
	$new_staff["evv_id"] = "";
	$new_staff["first_name"] = "";
	$new_staff["last_name"] = "";
	$new_staff["mail"] = "";
	$new_staff["pay_rate"] = "";
	$new_staff["phone_number"] = "";
	$new_staff["comments"] = "";

    $evv_id_border = "";
    $first_name_border = "";
    $last_name_border = "";
    $pay_rate_border = "";
    $phone_number_border = "";
    $comments_border = "";
    $mail_border = "";

    $form_id = "new-staff";
    $modal_title ="add new staff";
    require_once(SHARED_PATH."/modal-header.php");
?>
<div id="new-staff-modal-body" class="modal-body modal-form-body">
<?php
        
    require_once(SHARED_PATH."/staff-content/new-staff-form-content.php");
    
?>
</div>
<script type="text/javascript" src="<?php echo url_for("/scripts/modal.js"); ?>" async></script>