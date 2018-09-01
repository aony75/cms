<?php

    if(($incorrect_input == 0) && (is_POST_request())){
        echo "<p class='correct-statement'>".$correct_statement."<p>";
    }

?>
<p data-active="<?php echo $is_session_active; ?>" data-conflicting-schedule="<?php if(is_POST_request() && $incorrect_input == 200){echo implode(";", $conflicting_schedule_values);} ?>" data-incorrect-input="<?php echo $incorrect_input; ?>" class="display-none number-of-correct-inputs"><?php echo $id; ?></p>
<?php if($is_session_active == true){ ?>
<section>
    <div class="input-label-wrapper">
        <label>Client:<span> *</span></label>
        <select name="client" class="select long-length <?php echo $client_border; ?>" required>
            <option value="">Select Client</option>
            <?php

                $client_name_set = find_all_names("clients");

                while($client = mysqli_fetch_assoc($client_name_set)){
                    
                    if(is_POST_request()){
                    
                        $selected = ($new_schedule["client"] == $client["id"]) ? "selected" : "";
                                     
                    }
                    
                    if(is_GET_request()){
                        
                        $selected = ($new_schedule["client_id"] == $client["id"]) ? "selected" : "";
                        
                    }

            ?>
            <option value="<?php echo $client["id"]; ?>" <?php echo $selected; ?>><?php echo $client["last_name"].", ".$client["first_name"]." - ".$client["evv_id"]; ?></option>
                <?php

                    }

                mysqli_free_result($client_name_set);
                    
            ?>
        </select>
    </div>
    <div class="input-label-wrapper">
        <label>Staff:<span> *</span></label>
        <select name="staff" class="select long-length <?php echo $staff_border; ?>" required>
            <option class="placeholder" value="">Select Staff</option>
            <?php

                $staff_name_set = find_all_names("staff");

                while($staff = mysqli_fetch_assoc($staff_name_set)){
                   
                    $evv_id = empty($staff["evv_id"]) ? "" : " - ".$staff["evv_id"];
                    
                    if(is_POST_request()){
                        
                        $selected = ($new_schedule["staff"] == $staff["id"]) ? "selected" : "";
                    }
                    
                    if(is_GET_request()){
                        
                        $selected = ($new_schedule["staff_id"] == $staff["id"]) ? "selected" : "";
                    
                    }

            ?>
            <option value="<?php echo $staff["id"]; ?>" <?php echo $selected; ?>><?php echo $staff["last_name"].", ".$staff["first_name"].$evv_id; ?></option>
            <?php

                    }

                mysqli_free_result($staff_name_set);
                    
            ?>
        </select>
    </div>
</section>
<section id="mass-schedule-input">
    <label>Mass Schedule Input</label>
    <div class="schedule-time-wrapper">
        <input maxlength="5" class="short-length clockin" type="text">
        <p> to </p>
        <input maxlength="5" class="short-length clockout" type="text">
    </div>
    <div class="input-label-wrapper">
        <label>sun</label>
        <input class="sun-time" type="checkbox">
    </div>
    <div class="input-label-wrapper">
        <label>mon</label>
        <input class="mon-time" type="checkbox">
    </div>
    <div class="input-label-wrapper">
        <label>tues</label>
        <input class="tues-time" type="checkbox">
    </div>
    <div class="input-label-wrapper">
        <label>wed</label>
        <input class="wed-time" type="checkbox">
    </div>
    <div class="input-label-wrapper">
        <label>thurs</label>
        <input class="thurs-time" type="checkbox">
    </div>
    <div class="input-label-wrapper">
        <label>fri</label>
        <input class="fri-time" type="checkbox">
    </div>
    <div class="input-label-wrapper">
        <label>sat</label>
        <input class="sat-time" type="checkbox">
    </div>
</section>
<section id="schedule-section-wrapper">
    <div class="total-weekly-hours">
        <label class="long-label">Total Hours for the Week:</label>
        <p>make sure all times are in hh:mm format</p>
    </div>
    <div class="schedule-time-wrapper sun-time">
        <div class="weekday-wrapper">
            <label>Sunday:</label>
        </div>
        <input maxlength="5" class="short-length clockin <?php echo $sun_in_border; ?>" type="text" name="sun_in" value="<?php echo $new_schedule["sun_in"]; ?>">
        <p> to </p>
        <input maxlength="5" class="short-length clockout <?php echo $sun_out_border; ?>" type="text" name="sun_out" value="<?php echo $new_schedule["sun_out"]; ?>">
        <p class="hrs-for-day"></p>
    </div>
    <div class="schedule-time-wrapper mon-time">
        <div class="weekday-wrapper">
            <label>Monday:</label>
        </div>
        <input maxlength="5" class="short-length clockin <?php echo $mon_in_border; ?>" type="text" name="mon_in" value="<?php echo $new_schedule["mon_in"]; ?>">
        <p> to </p>
        <input maxlength="5" class="short-length clockout <?php echo $mon_out_border; ?>" type="text" name="mon_out" value="<?php echo $new_schedule["mon_out"]; ?>">
        <p class="hrs-for-day"></p>
    </div>
    <div class="schedule-time-wrapper tues-time">
        <div class="weekday-wrapper">
            <label>Tuesday:</label>
        </div>
        <input maxlength="5" class="short-length clockin <?php echo $tues_in_border; ?>" type="text" name="tues_in" value="<?php echo $new_schedule["tues_in"]; ?>">
        <p> to </p>
        <input maxlength="5" class="short-length clockout <?php echo $tues_out_border; ?>" type="text" name="tues_out" value="<?php echo $new_schedule["tues_out"]; ?>">
        <p class="hrs-for-day"></p>
    </div>
    <div class="schedule-time-wrapper wed-time">
        <div class="weekday-wrapper">
            <label>Wednesday:</label>
        </div>
        <input maxlength="5" class="short-length clockin <?php echo $wed_in_border; ?>" type="text" name="wed_in" value="<?php echo $new_schedule["wed_in"]; ?>">
        <p> to </p>
        <input maxlength="5" class="short-length clockout <?php echo $wed_out_border; ?>" type="text" name="wed_out" value="<?php echo $new_schedule["wed_out"]; ?>">
        <p class="hrs-for-day"></p>
    </div>
    <div class="schedule-time-wrapper thurs-time">
        <div class="weekday-wrapper">
            <label>Thursday:</label>
        </div>
        <input maxlength="5" class="short-length clockin <?php echo $thurs_in_border; ?>" type="text" name="thurs_in" value="<?php echo $new_schedule["thurs_in"]; ?>">
        <p> to </p>
        <input maxlength="5" class="short-length clockout <?php echo $thurs_out_border; ?>" type="text" name="thurs_out" value="<?php echo $new_schedule["thurs_out"]; ?>">
        <p class="hrs-for-day"></p>
    </div>
    <div class="schedule-time-wrapper fri-time">
        <div class="weekday-wrapper">
            <label>Friday:</label>
        </div>
        <input maxlength="5" class="short-length clockin <?php echo $fri_in_border; ?>" type="text" name="fri_in" value="<?php echo $new_schedule["fri_in"]; ?>">
        <p> to </p>
        <input maxlength="5" class="short-length clockout <?php echo $fri_out_border; ?>" type="text" name="fri_out" value="<?php echo $new_schedule["fri_out"]; ?>">
        <p class="hrs-for-day"></p>
    </div>
    <div class="schedule-time-wrapper sat-time">
        <div class="weekday-wrapper">
            <label>Saturday:</label>
        </div>
        <input maxlength="5" class="short-length clockin <?php echo $sat_in_border; ?>" type="text" name="sat_in" value="<?php echo $new_schedule["sat_in"]; ?>">
        <p> to </p>
        <input maxlength="5"class="short-length clockout <?php echo $sat_out_border; ?>" type="text" name="sat_out" value="<?php echo $new_schedule["sat_out"]; ?>">
        <p class="hrs-for-day"></p>
    </div>
    <div class="total-weekly-hours">
        <label class="long-label">Total Hours for the Week:</label>
        <p>make sure all times are in hh:mm format</p>
    </div>
</section>
<section>
    <div id="comments-input-label-wrapper" class="input-label-wrapper <?php echo $comments_border; ?>">
        <textarea maxlength="300" placeholder="Comments" name="comments"><?php echo $new_schedule["comments"]; ?></textarea>
        <span>
            <p>Characters Remaining:&nbsp;</p>
            <p class="character-count"></p>
        </span>
    </div>
</section>
<?php } ?>