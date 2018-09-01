<?php 

    $form_id = !isset($form_id) ? "" : $form_id;
		
	$MAIL_SET = array("Pickup", "Early Mailing", "Regular Mailing");

    $MAIL_COLOR_CLASS = array("pickup-color", "early-mailing-color", "regular-mailing-color");
        
?>
<form data-active="<?php echo $is_session_active?>" data-incorrect-input="<?php echo $incorrect_input; ?>" id="<?php echo $form_id; ?>" class="modal-form number-of-correct-inputs">
    <?php 
        if(($incorrect_input == 0) && (is_POST_request())){
            echo "<p class='correct-statement'>".$correct_statement."<p>";
        }
    ?>
    <div class="input-label-wrapper">
        <label>ID:<span> *</span></label>
        <input class="<?php echo $evv_id_border; ?>" type="text" name="evv_id" maxlength="5" placeholder="ex. 00123" <?php echo "value='".$new_staff["evv_id"]."'"; ?> required>
    </div>
    <div class="input-label-wrapper">
        <label>First Name:<span> *</span></label>
        <input class="<?php echo $first_name_border; ?>" type="text" name="first_name" maxlength="30" placeholder="ex. james" <?php echo "value='".$new_staff["first_name"]."'"; ?> required>
    </div>
    <div class="input-label-wrapper">
        <label>Last Name:<span> *</span></label>
        <input class="<?php echo $last_name_border; ?>" type="text" name="last_name" maxlength="30" placeholder="ex. smith" <?php echo "value='".$new_staff["last_name"]."'"; ?> required>
    </div>
    <div class="input-label-wrapper">
        <label>Phone Number:</label>
        <input class="<?php echo $phone_number_border; ?>" type="text" placeholder="ex. 123-456-7890" maxlength="12" name="phone_number" <?php echo "value='".$new_staff["phone_number"]."'"; ?>>
    </div>
    <div class="input-label-wrapper">
        <label>Mail:</label>
        <select name="mail" class="select <?php echo $mail_border; ?>">
            <?php foreach($MAIL_SET as $mail){ ?>
            <option value="<?php echo $mail; ?>" <?php if($new_staff["mail"] == $mail){echo "selected";}?>><?php echo $mail; ?></option>
            <?php } ?>
        </select>
    </div>
    <div class="input-label-wrapper">
        <label>Pay Rate:</label>
        <input class="<?php echo $pay_rate_border; ?>" type="text" name="pay_rate" placeholder="ex. 7.50" maxlength="5" <?php echo "value='".$new_staff["pay_rate"]."'"; ?>>
    </div>
    <div id="comments-input-label-wrapper" class="input-label-wrapper">
        <textarea class="<?php echo $comments_border; ?>" maxlength="300" placeholder="Comments" name="comments"><?php echo $new_staff["comments"]; ?></textarea>
        <span>
            <p>Characters Remaining:&nbsp;</p>
            <p class="character-count"></p>
        </span>
    </div>
</form>