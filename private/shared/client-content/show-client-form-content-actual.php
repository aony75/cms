<?php
	
    if(($incorrect_input == 0) && (is_POST_request())){
        echo "<p class='correct-statement'>".$correct_statement."<p>";
    }

?>
<p data-active="<?php echo $is_session_active; ?>" data-incorrect-input="<?php echo $incorrect_input; ?>" class="display-none number-of-correct-inputs"><?php echo $id; ?></p>
<?php if($is_session_active == true){ ?>
<section>
    <div class="input-label-wrapper">
        <label>ID:<span> *</span></label>
        <input maxlength="11" class="<?php echo $evv_id_border; ?>" placeholder="ex. 1234567-MCD" type="text" name="evv_id" value="<?php echo h($client["evv_id"]); ?>" required disabled>
    </div>
    <div class="input-label-wrapper">
        <label>First Name:<span> *</span></label>
        <input maxlength="30" class="<?php echo $first_name_border; ?>" placeholder="ex. james" type="text" value="<?php echo h($client["first_name"]); ?>" name="first_name" required disabled>
    </div>
    <div class="input-label-wrapper">
        <label>Last Name:<span> *</span></label>
        <input maxlength="30" class="<?php echo $last_name_border; ?>" placeholder="ex. smith" type="text" name="last_name" value="<?php echo h($client["last_name"]); ?>" required disabled>
    </div>
    <div class="input-label-wrapper">
        <label>Ameriset Number:</label>
        <input maxlength="9" class="<?php echo $amerigroup_number_border; ?>" placeholder="must be 9 numbers" type="text" name="amerigroup_number" value="<?php echo ($client["amerigroup_number"] =="0") ? "" : h($client["amerigroup_number"]); ?>" disabled>
    </div>
    <div class="input-label-wrapper">
        <label>Mediset ID:</label>
        <input maxlength="9" class="<?php echo $medicaid_id_border; ?>" placeholder="must be 9 numbers" type="text" name="medicaid_id" value="<?php echo ($client["medicaid_id"] =="0") ? "" : h($client["medicaid_id"]); ?>" disabled>
    </div>
    <div class="input-label-wrapper">
        <label>Phone Number:</label>
        <input maxlength="12" class="<?php echo $phone_number_border; ?>" placeholder="ex. 123-456-7890" type="text" name="phone_number" value="<?php echo h($client["phone_number"]); ?>" disabled>
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
                    
                $schedule_set = find_schedule_by_client_or_staff_id("staff_id", "client_id", $id);
                    
                if(empty($schedule_set)){
                        
                    echo "<p class='no-results'>no schedules found</p>";
                    
                }else{
                        
                    foreach($schedule_set as $schedule){
                    
            ?>
            <div class="table-row"  data-schedule-id="<?php echo h($schedule["id"]); ?>" data-href="<?php echo url_for("schedules/show-schedule.php?id=".u($schedule["id"])); ?>">
                <?php
                        
                    $name_set = find_single_name("staff", $schedule["staff_id"]);
                   
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
        <textarea class="<?php echo $comments_border; ?>" maxlength="300" placeholder="Comments" name="comments" disabled><?php echo h($client["comments"]); ?></textarea>
        <span>
            <p>Characters Remaining:&nbsp;</p>
            <p class="character-count"></p>
        </span>
    </div>
</section>
<?php } ?>