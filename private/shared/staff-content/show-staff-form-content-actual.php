<?php 
    if(($incorrect_input == 0) && (is_POST_request())){
        echo "<p class='correct-statement'>".$correct_statement."<p>";
    }

	$MAIL_SET = array("Pickup", "Early Mailing", "Regular Mailing");

    $MAIL_COLOR_CLASS = array("pickup-color", "early-mailing-color", "regular-mailing-color");

?>
<p data-active="<?php echo $is_session_active; ?>" data-incorrect-input="<?php echo $incorrect_input; ?>" class="display-none number-of-correct-inputs"><?php echo $id; ?></p>
<?php if($is_session_active == true){ ?>
<section>
    <div class="input-label-wrapper">
        <label>ID:<span> *</span></label>
        <input maxlength="5" class="<?php echo $evv_id_border; ?>" placeholder="ex. 00123" type="text" name="evv_id" value="<?php echo h($staff["evv_id"]); ?>" disabled>
    </div>
    <div class="input-label-wrapper">
        <label>First Name:<span> *</span></label>
        <input maxlength="30" class="<?php echo $first_name_border; ?>" placeholder="ex. james" type="text" value="<?php echo h($staff["first_name"]); ?>" name="first_name" required disabled>
    </div>
    <div class="input-label-wrapper">
        <label>Last Name:<span> *</span></label>
        <input maxlength="30" class="<?php echo $last_name_border; ?>" placeholder="ex. smith" type="text" name="last_name" value="<?php echo h($staff["last_name"]); ?>" required disabled>
    </div>
    <div class="input-label-wrapper">
        <label>Phone Number:</label>
        <input maxlength="12" type="text" name="phone_number" placeholder="ex. 123-456-7890" value="<?php echo $staff["phone_number"]; ?>" disabled>
    </div>
    <div class="input-label-wrapper">
        <label>Mail:</label>
        <select name="mail" class="select <?php echo $mail_border; ?>" disabled>
            <?php foreach($MAIL_SET as $mail){ ?>
            <option value="<?php echo $mail; ?>" <?php if($staff["mail"] == $mail){echo "selected";}?>><?php echo $mail; ?></option>
            <?php } ?>
        </select>
    </div>
    <div class="input-label-wrapper">
        <label>Pay Rate:</label>
        <input class="<?php echo $pay_rate_border; ?>" type="text" name="pay_rate" placeholder="ex. 7.50" maxlength="5" <?php echo "value='".$staff["pay_rate"]."'"; ?> disabled>
    </div>
</section>
<section>
    <div id="schedule-input-label-wrapper" class="input-label-wrapper">
        <span>
            <label id="schedule-label">Schedules: </label>
            <a id="add-new-schedule" href="#"><i class="fa fa-plus"></i></a>
        </span>
        <div id="schedule-table-wrapper" class="table-part-2">
            <?php
                    
                $schedule_set = find_schedule_by_client_or_staff_id("client_id", "staff_id", $id);
                    
                if(empty($schedule_set)){
                        
                    echo "<p class='no-results'>no schedules found</p>";
                    
                }else{
                        
                    foreach($schedule_set as $schedule){
                    
            ?>
            <div class="table-row" data-schedule-id="<?php echo h($schedule["id"]); ?>" data-href="<?php echo url_for("schedules/show-schedule.php?id=".u($schedule["id"])); ?>">
                <?php
                        
                    $name_set = find_single_name("clients", $schedule["client_id"]);
                   
                    echo "<p>";
                        
                    echo $name_set["last_name"].", ".$name_set["first_name"];
                        
                    echo"</p>";

                ?>
            </div>
            <?php 
                    }
                        
                }
                
            ?>
        </div>
    </div>
    <div id="comments-input-label-wrapper" class="input-label-wrapper">
        <textarea maxlength="300" placeholder="Comments" name="comments" disabled><?php echo $staff["comments"]; ?></textarea>
        <span>
            <p>Characters Remaining:&nbsp;</p>
            <p class="character-count"></p>
        </span>
    </div>
</section>
<?php } ?>