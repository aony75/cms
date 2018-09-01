<?php 
    //constant variable can't be set here like footer and header becasue initalize.php are where the constants were defined
    require_once("../../private/initialize.php"); 

    $is_session_active = check_session_time();

    $input_border = "";
	$incorrect_input = "";

    $evv_id_border = "";
    $first_name_border = "";
    $last_name_border = "";
    $pay_rate_border = "";
    $phone_number_border = "";
    $comments_border = "";
    $mail_border = "";

    if($is_session_active == true){

        if(is_GET_request()){

            $id = h($_GET["id"]);

            $staff = find_staff_info($id);

        }
        
    }

    if($is_session_active == true){

        $form_id = "show-staff";
        $modal_title = "staff - ".h($staff["last_name"]).", ".h($staff["first_name"]);
        require_once(SHARED_PATH."/modal-header.php");

    }

?>
<div id="show-staff-modal-body" class="modal-body modal-form-body show-content show-person-content">
	<div class="edit-wrapper">
		<button class="table-bttn delete-bttn">Delete <i class="fa fa-trash-o trash-icon"></i></button>
    	<label id="edit-label">Edit:</label>
        <input type="checkbox">
    </div>
    <form id="<?php echo $form_id; ?>" class="modal-form">
    <?php
    
        require_once(SHARED_PATH."/staff-content/show-staff-form-content-actual.php");
    
    ?>
    </form>
</div>
<script type="text/javascript" src="<?php echo url_for("/scripts/show.js"); ?>" async></script>
<script type="text/javascript" src="<?php echo url_for("/scripts/modal.js"); ?>" async></script>