<?php
    
    session_start();

    //constant variable can't be set here like footer and header becasue initalize.php are where the constants were defined
    require_once("../private/initialize.php"); 

    redirect_if_not_ajax_request("clients");

    $is_session_active = check_session_time();

    $table = "clients";

?>
<form data-active="<?php echo $is_session_active; ?>">
    <?php if($is_session_active == true ){ ?>
    <div class="input-label-wrapper">
        <label>ID</label>
        <select name="evv_id">
            <option></option>
            <?php

               $evv_id_set = find_all_evv_ids($table);

               while($evv_id = mysqli_fetch_array($evv_id_set)){

            ?>
            <option value="<?php echo $evv_id["evv_id"]; ?>"><?php echo $evv_id["evv_id"]; ?></option>
            <?php

                }

                mysqli_free_result($evv_id_set);
            ?>
        </select>
    </div>
    <div class="input-label-wrapper">
        <label>Client</label>
        <select name="client" class="option-data-text">
            <option></option>
            <?php

               $client_name_set = find_all_names($table);

               while($client = mysqli_fetch_assoc($client_name_set)){

            ?>
            <option value="<?php echo $client["id"]; ?>"><?php echo $client["last_name"].", ".$client["first_name"]." - ".$client["evv_id"]; ?></option>
            <?php

                }

                mysqli_free_result($client_name_set);
            ?>
        </select>
    </div>
    <div class="input-label-wrapper">
        <label>Amerigroup Number</label>
        <select name="amerigroup_number">
            <option></option>
            <?php

               $amerigroup_number_set = find_all_amerigroup_numbers();

               while($amerigroup_number = mysqli_fetch_array($amerigroup_number_set)){

                   if($amerigroup_number["amerigroup_number"] == 0){continue;}

            ?>
            <option value="<?php echo $amerigroup_number["amerigroup_number"]; ?>"><?php echo $amerigroup_number["amerigroup_number"]; ?></option>
            <?php

                }

                mysqli_free_result($amerigroup_number_set);
            ?>
        </select>
    </div>
    <div class="input-label-wrapper">
        <label>Medicaid ID</label>
        <select name="medicaid_id">
            <option></option>
            <?php

               $medicaid_id_set = find_all_medicaid_ids();

               while($medicaid_id = mysqli_fetch_array($medicaid_id_set)){

                   if($medicaid_id["medicaid_id"] == 0){continue;}

            ?>
            <option value="<?php echo $medicaid_id["medicaid_id"]; ?>"><?php echo $medicaid_id["medicaid_id"]; ?></option>
            <?php

                }

                mysqli_free_result($medicaid_id_set);
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