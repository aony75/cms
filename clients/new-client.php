<?php
    
    session_start();

    //constant variable can't be set here like footer and header becasue initalize.php are where the constants were defined
    require_once("../private/initialize.php");
    
    redirect_if_not_ajax_request("clients");

    $is_session_active = check_session_time();
	
	$input_border = "";
	$incorrect_input = "";

	$new_client = [];
	
	$new_client["evv_id"] = "";
	$new_client["first_name"] = "";
	$new_client["last_name"] = "";
	$new_client["amerigroup_number"] = "";
	$new_client["medicaid_id"] = "";
	$new_client["phone_number"] = "";
	$new_client["comments"] = "";

    $evv_id_border = "";
    $first_name_border = "";
    $last_name_border = "";
    $amerigroup_number_border = "";
    $phone_number_border = "";
    $comments_border = "";
    $medicaid_id_border = "";

	if(is_POST_request()){
		
		$new_client["evv_id"] = h($_POST["evv_id"]);
		$new_client["first_name"] = h($_POST["first_name"]);
		$new_client["last_name"] = h($_POST["last_name"]);
		$new_client["amerigroup_number"] = h($_POST["amerigroup_number"]);
		$new_client["medicaid_id"] = h($_POST["medicaid_id"]);
		$new_client["phone_number"] = h($_POST["phone_number"]);
		$new_client["comments"] = h($_POST["comments"]);
		$incorrect_input = 0;
		
		$new_client["first_name"] = ucwords($new_client["first_name"]);
		$new_client["last_name"] = ucwords($new_client["last_name"]);
		
		$input_border = "incorrect-border";
		
		if(validate_client_id($new_client["evv_id"]) !== true){
			
			$incorrect_input++;
				
			$evv_id_border = $input_border;
			
			$new_client["evv_id"] = "";
		}

		if(validate_text_only($new_client["first_name"]) !== true){
			
			$incorrect_input++;
			
			$first_name_border = $input_border;
			
			$new_client["first_name"] = "";
			
		}

		if(validate_text_only($new_client["last_name"]) !== true){
			
			$incorrect_input++;
				
			$last_name_border = $input_border;
			
			$new_client["last_name"] = "";
		
		}
		
		if(validate_number($new_client["amerigroup_number"], 9) !== true){
			
			$incorrect_input++;
				
			$amerigroup_number_border = $input_border;
			
			$new_client["amerigroup_number"] = "";
			
		}
		
		if(validate_number($new_client["medicaid_id"], 9) !== true){
			
			$incorrect_input++;
				
			$medicaid_id_border = $input_border;
			
			$new_client["medicaid_id"] = "";
				
		}
		
		if(validate_phone_number($new_client["phone_number"]) !== true){
			
			$incorrect_input++;
				
			$phone_number_border = $input_border;
			
			$new_client["phone_number"] = "";
		
		}

		if(validate_textarea($new_client["comments"]) !== true){
			
			$incorrect_input++;
				
			$comments_border = $input_border;
			
			$new_client["comments"] = "";
		
		}
		
	}

	$form_id = "new-client";
    $modal_title ="add new client";
    require_once(SHARED_PATH."/modal-header.php");

?>
<div id="new-client-modal-body" class="modal-body modal-form-body">
<?php 
    
    require_once(SHARED_PATH."/client-content/new-client-form-content.php");
    
?>
</div>
<script type="text/javascript" src="<?php echo url_for("/scripts/modal.js"); ?>" async></script>