<?php 
    
    session_start();

    //constant variable can't be set here like footer and header becasue initalize.php are where the constants were defined
    require_once("../private/initialize.php"); 

    redirect_if_not_ajax_request("schedules");

    $is_session_active = check_session_time();

    $table = "schedules";

?>
<form data-active="<?php echo $is_session_active; ?>">
    <?php if($is_session_active == true ){ ?>
    <div class="input-label-wrapper">
        <label>ID</label>
        <select name="schedule_id">
            <option></option>
            <?php

               $id_set = find_all_ids($table);

               while($id = mysqli_fetch_array($id_set)){
                   
            ?>
            <option value="<?php echo $id["id"]; ?>"><?php echo $id["id"]; ?></option>
            <?php

                }

                mysqli_free_result($id_set);
            ?>
        </select>
    </div>
    <div class="input-label-wrapper">
        <label>Staff</label>
        <select name="staff" class="option-data-text">
            <option></option>
            <?php

               $staff_name_set = find_all_names("staff");

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
        <label>Client</label>
        <select name="client" class="option-data-text">
            <option></option>
            <?php

               $client_name_set = find_all_names("clients");

               while($client = mysqli_fetch_assoc($client_name_set)){
                   
                    $evv_id = empty($client["evv_id"]) ? "" : " - ".$client["evv_id"];

            ?>
            <option value="<?php echo $client["id"]; ?>"><?php echo $client["last_name"].", ".$client["first_name"].$evv_id; ?></option>
            <?php

                }

                mysqli_free_result($client_name_set);
            ?>
        </select>
    </div>
    <div class="input-label-wrapper filter-time">
        <label>In</label>
        <input name="time_in" type="text" maxlength="5">
        <label>Out</label>
        <input name="time_out" type="text" maxlength="5">
    </div>
    <?php } ?>
</form>