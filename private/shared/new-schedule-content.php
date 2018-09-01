<?php
    //constant variable can't be set here like footer and header becasue initalize.php are where the constants were defined
    require_once("../../private/initialize.php"); 
    
    $form_id = "new-schedule";
    $modal_title ="add new schedule";
    require_once(SHARED_PATH."/modal-header.php");

?>
<div id="new-schedule-modal-body" class="modal-body modal-form-body">
	<div class="edit-wrapper">
		<a id="back-bttn" href="#">&laquo;Back to&nbsp;</a>
    </div>
    <form id="<?php echo $form_id; ?>" class="modal-form" method="post" action="">
    	<section>
        	<div id="new-or-existing-wrapper" class="input-label-wrapper">
            	<label class="long-label">Is this a new schedule or exisiting schedule?<span> *</span></label>
				<select name="new_or_existing" id="new-or-existing-schedule-select" class="select" required>
					<option value="new schedule">new schedule</option>
					<option value="existing schedule">existing schedule</option>
				</select>
			</div>
        </section>
       	<section>
        	<div class="input-label-wrapper">
            	<label>Start Date:<span> *</span></label>
                <input type="date" name="start_date">
			</div>
        </section>
        <section>
        	<div class="input-label-wrapper">
            	<label>Client:<span> *</span></label>
               	<select class="select long-length" required>
                    <option class="placeholder" value="">Select Client</option>
                    <?php

                        $client_name_set = find_all_names("clients");

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
				<label>Staff:<span> *</span></label>
				<select class="select long-length" required>
					<option class="placeholder" value="">Select Staff</option>
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
       </section>
       <section id="schedule-section-wrapper">
       		<div class="total-weekly-hours">
            	<label class="long-label">Total Hours for the Week:</label>
                <p>make sure all times are in hhmm format</p>
           	</div>
            <div class="schedule-time-wrapper">
            	<div class="weekday-wrapper">
                	<label>Monday:</label>
                </div>
                <input class="short-length clockin" type="text" name="mon_in">
                <p> to </p>
                <input class="short-length clockout" type="text" name="mon_out">
				<p class="hrs-for-day"></p>
           	</div>
            <div class="schedule-time-wrapper">
            	<div class="weekday-wrapper">
                	<label>Tuesday:</label>
                </div>
                <input class="short-length clockin" type="text" name="tues_in">
                <p> to </p>
                <input class="short-length clockout" type="text" name="tues_out">
				<p class="hrs-for-day"></p>
         	</div>
            <div class="schedule-time-wrapper">
            	<div class="weekday-wrapper">
              		<label>Wednesday:</label>
                </div>
                <input class="short-length clockin" type="text" name="wed_in">
                <p> to </p>
                <input class="short-length clockout" type="text" name="wed_out">
				<p class="hrs-for-day"></p>
            </div>
            <div class="schedule-time-wrapper">
            	<div class="weekday-wrapper">
                	<label>Thursday:</label>
               	</div>
          		<input class="short-length clockin" type="text" name="thurs_in">
                <p> to </p>
                <input class="short-length clockout" type="text" name="thurs_out">
				<p class="hrs-for-day"></p>
          	</div>
            <div class="schedule-time-wrapper">
            	<div class="weekday-wrapper">
                	<label>Friday:</label>
               	</div>
                <input class="short-length clockin" type="text" name="fri_in">
                <p> to </p>
                <input class="short-length clockout" type="text" name="fri_out">
				<p class="hrs-for-day"></p>
             </div>
             <div class="schedule-time-wrapper">
             	<div class="weekday-wrapper">
                	<label>Saturday:</label>
                </div>
                <input class="short-length clockin" type="text" name="sat_in">
                <p> to </p>
                <input class="short-length clockout" type="text" name="sat_out">
				<p class="hrs-for-day"></p>
             </div>
             <div class="schedule-time-wrapper">
             	<div class="weekday-wrapper">
                	<label>Sunday:</label>
                </div>
                <input class="short-length clockin" type="text" name="sun_in">
               	<p> to </p>
                <input class="short-length clockout" type="text" name="sun_out">
				<p class="hrs-for-day"></p>
             </div>
             <div class="total-weekly-hours">
             	<label class="long-label">Total Hours for the Week:</label>
                <p>make sure all times are in hhmm format</p>
             </div>
      	</section>
		<section>
			<div id="comments-input-label-wrapper" class="input-label-wrapper">
                <textarea maxlength="300" placeholder="Comments" name="comments"></textarea>
                <span>
                    <p>Characters Remaining:&nbsp;</p>
                    <p class="character-count"></p>
                </span>
            </div>
		</section>
	</form>
</div>
<script type="text/javascript" src="<?php echo url_for("/scripts/modal.js"); ?>" async></script>
<script type="text/javascript" src="<?php echo url_for("/scripts/new-schedule.js"); ?>" async></script>