<?php 
    
    session_start();
    
    //constant variable can't be set here like footer and header becasue initalize.php are where the constants were defined
    require_once("../private/initialize.php"); 

    redirect_if_not_ajax_request("staff");

    $is_session_active = check_session_time();

    $table = "staff";

?>
<form  data-active="<?php echo $is_session_active; ?>">
    <?php if($is_session_active == true ){ ?>
    <div class="input-label-wrapper">
        <label>ID</label>
        <select name="evv_id">
            <option></option>
            <?php

               $evv_id_set = find_all_evv_ids($table);

               while($evv_id = mysqli_fetch_array($evv_id_set)){
                   
                  if(empty($evv_id["evv_id"])){continue;}

            ?>
            <option value="<?php echo $evv_id["evv_id"]; ?>"><?php echo $evv_id["evv_id"]; ?></option>
            <?php

                }

                mysqli_free_result($evv_id_set);
            ?>
        </select>
    </div>
    <div class="input-label-wrapper">
        <label>Staff</label>
        <select name="staff" class="option-data-text">
            <option></option>
            <?php

               $staff_name_set = find_all_names($table);

               while($staff = mysqli_fetch_assoc($staff_name_set)){
                   
                    $evv_id = empty($staff["evv_id"]) ? "" : " - ".$staff["evv_id"];

            ?>
            <option value="<?php echo $staff["id"]; ?>"><?php echo $staff["last_name"].", ".$staff["first_name"].$evv_id; ?></option>
            <?php

                }

                mysqli_free_result($staff_name_set);
            ?>
        </select>
    </div>
    <div class="input-label-wrapper">
        <label>Mail:</label>
        <select name="mail" class="select">
            <option></option>
            <?php foreach(MAIL_SET as $mail){ ?>
            <option value="<?php echo $mail; ?>"><?php echo $mail; ?></option>
            <?php } ?>
        </select>
    </div>
    <div class="input-label-wrapper">
        <label>Pay Rate</label>
        <select name="pay_rate">
            <option></option>
            <?php

               $pay_rate_set = find_all_pay_rate_values();

               while($pay_rate = mysqli_fetch_array($pay_rate_set)){

                   if($pay_rate["pay_rate"] == 0){continue;}

            ?>
            <option value="<?php echo $pay_rate["pay_rate"]; ?>"><?php echo $pay_rate["pay_rate"]; ?></option>
            <?php

                }

                mysqli_free_result($pay_rate_set);
            ?>
        </select>
    </div>
    <div class="input-label-wrapper">
        <label>Phone Number</label>
        <select name="phone_number">
            <option></option>
            <?php

               $phone_number_set = find_all_phone_numbers($table);

               while($phone_number = mysqli_fetch_array( $phone_number_set)){

                   if($phone_number["phone_number"] == ""){continue;}

            ?>
            <option value="<?php echo $phone_number["phone_number"]; ?>"><?php echo $phone_number["phone_number"]; ?></option>
            <?php

                }

                mysqli_free_result($phone_number_set);
            ?>
        </select>
    </div>
    <?php } ?>
</form>