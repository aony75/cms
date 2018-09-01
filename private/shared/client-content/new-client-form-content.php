<!--template for new client form-->
<?php 

    $form_id = !isset($form_id) ? "" : $form_id
        
?>
<form data-active="<?php echo $is_session_active?>" data-incorrect-input="<?php echo $incorrect_input; ?>" id="<?php echo $form_id; ?>" class="modal-form number-of-correct-inputs">
		<?php 
			if(($incorrect_input == 0) && (is_POST_request())){
				echo "<p class='correct-statement'>".$correct_statement."<p>";
			}
		?>
        <div class="input-label-wrapper">
			<label>ID:<span> *</span></label>
            <input class="<?php echo $evv_id_border; ?>" type="text" name="evv_id" maxlength="11" placeholder="ex. 1234567-MCD" <?php echo "value='".$new_client["evv_id"]."'"; ?> required>
		</div>
		<div class="input-label-wrapper">
            <label>First Name:<span> *</span></label>
            <input class="<?php echo $first_name_border; ?>" type="text" name="first_name" maxlength="30"  placeholder="ex. james" <?php echo "value='".$new_client["first_name"]."'"; ?> required>
		</div>
		<div class="input-label-wrapper">
            <label>Last Name:<span> *</span></label>
            <input class="<?php echo $last_name_border; ?>" type="text" name="last_name" maxlength="30" placeholder="ex. smith" <?php echo "value='".$new_client["last_name"]."'"; ?> required>
		</div>
		<div class="input-label-wrapper">
            <label>Ameriset Number:</label>
            <input class="<?php echo $amerigroup_number_border; ?>" type="text" name="amerigroup_number" placeholder="must be 9 numbers" maxlength="9" <?php echo "value='".$new_client["amerigroup_number"]."'"; ?>>
		</div>
		<div class="input-label-wrapper">
            <label>Mediset ID:</label>
            <input class="<?php echo $medicaid_id_border; ?>" type="text" name="medicaid_id" placeholder="must be 9 numbers" maxlength="9" <?php echo "value='".$new_client["medicaid_id"]."'"; ?>>
		</div>
		<div class="input-label-wrapper">
            <label>Phone Number:</label>
            <input class="<?php echo $phone_number_border; ?>" type="text" placeholder="ex. 123-456-7890" maxlength="12" name="phone_number" <?php echo "value='".$new_client["phone_number"]."'"; ?>>
		</div>
		<div id="comments-input-label-wrapper" class="input-label-wrapper">
            <textarea class="<?php echo $comments_border; ?>" maxlength="300" placeholder="Comments" name="comments"><?php echo $new_client["comments"]; ?></textarea>
			<span>
				<p>Characters Remaining:&nbsp;</p>
				<p class="character-count"></p>
			</span>
		</div>
    </form>