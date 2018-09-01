<?php
        //constant variable can't be set here like footer and header becasue initalize.php are where the constants were defined
        require_once("../../private/initialize.php"); 
        
        $form_id = "schedule assigned";
		$input_submit_class = "display-none";
        require_once(SHARED_PATH."/modal-header.php");

?>
<div id="show-schedule-modal-body" class="modal-body modal-form-body show-content">
	<div class="edit-wrapper">
		<a id="back-bttn" href="#">&laquo;Back to&nbsp;</a>
		<button class="table-bttn delete-bttn">Delete <i class="fa fa-trash-o trash-icon"></i></button>
        <label id="edit-label">Edit:&nbsp;</label>
        <input type="checkbox">
    </div>
    <form id="<?php echo $form_id; ?>" class="modal-form" method="post" action="">
		<section>
        	<div class="input-label-wrapper">
            	<label>Client:<span> *</span></label>
               	<select class="select long-length" required>
                    <option value=""></option>
                </select>
			</div>
           	<div class="input-label-wrapper">
				<label>Staff:<span> *</span></label>
				<select class="select long-length" required>
					<option value=""></option>
				</select>
			</div>
		</section>
    	<section id="schedule-section-wrapper">
        	<div class="total-weekly-hours">
            	<label class="total-weekly-hours-label long-label">Total Weekly for the Week:</label>
                <p>make sure all times are in hhmm format</p>
            </div>
  			<div class="schedule-time-wrapper">
            	<div class="weekday-wrapper">
                	<label>Monday:</label>
                </div>
                <input type="text" name="mon_clockin" disabled>
                <p> to </p>
                <input  type="text" name="mon_clockout" disabled>
           	</div>
            <div class="schedule-time-wrapper">
            	<div class="weekday-wrapper">
                	<label>Tuesday:</label>
                </div>
                <input class="short-length" type="text" name="tues_clockin" disabled>
               	<p> to </p>
                <input class="short-length" type="text" name="tues_clockout" disabled>
           	</div>
           	<div class="schedule-time-wrapper">
            	<div class="weekday-wrapper">
                	<label>Wednesday:</label>
                </div>
                <input class="short-length" type="text" name="wed_clockin" disabled>
                <p> to </p>
                <input class="short-length" type="text" name="wed_clockout" disabled>
           	</div>
            <div class="schedule-time-wrapper">
            	<div class="weekday-wrapper">
                	<label>Thursday:</label>
                </div>
                <input class="short-length" type="text" name="thurs_clockin" disabled>
                <p> to </p>
                <input class="short-length" type="text" name="thurs_clockout" disabled>
           	</div>
            <div class="schedule-time-wrapper">
            	<div class="weekday-wrapper">
                	<label>Friday:</label>
                </div>
                <input class="short-length" type="text" name="fri_clockin" disabled>
                <p> to </p>
                <input class="short-length" type="text" name="fri_clockout" disabled>
          	</div>
           	<div class="schedule-time-wrapper">
            	<div class="weekday-wrapper">
                	<label>Saturday:</label>
                </div>
                <input class="short-length" type="text" name="sat_clockin" disabled>
                <p> to </p>
                <input class="short-length" type="text" name="sat_clockout" disabled>
          	</div>
            <div class="schedule-time-wrapper">
            	<div class="weekday-wrapper">
                	<label>Sunday:</label>
                </div>
                <input class="short-length" type="text" name="sun_clockin" disabled>
                <p> to </p>
                <input class="short-length" type="text" name="sun_clockout" disabled>
            </div>
			<div class="total-weekly-hours">
            	<label class="total-weekly-hours-label long-label">Total Weekly for the Week:</label>
                <p>make sure all times are in hhmm format</p>
            </div>
  		</section>
       	<section>
        	<div id="comments-input-label-wrapper" class="input-label-wrapper">
                <textarea minlength="1" maxlength="300" placeholder="Comments" name="comments" disabled></textarea>
                <span>
				    <p>Characters Remaining:&nbsp;</p>
				    <p class="character-count"></p>
				</span>
        	</div>
     	</section>
 	</form>
</div>
<script type="text/javascript" src="<?php echo url_for("/scripts/show.js"); ?>" async></script>
<script type="text/javascript" src="<?php echo url_for("/scripts/modal.js"); ?>" async></script>
<script type="text/javascript" src="<?php echo url_for("/scripts/new-schedule.js"); ?>" async></script>