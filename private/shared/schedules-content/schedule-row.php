<div class="table-row" data-href="<?php echo url_for("schedules/show-schedule.php?id=".u($schedule["id"])); ?>">
    <div class="table-cell checkbox-column">
        <div class="checkbox-wrapper">
            <input type="hidden" name="is_deleted" value="0">
            <input type="checkbox" name="is_deleted" value="1">
        </div>
    </div>
    <div class="table-cell id-column" data-column-number="1">
        <div class="display-none<?php echo " ".h($schedule["id"]); ?> schedule-id">
            <?php echo h($schedule["id"]); ?>
        </div>
        <div class="id-cell">
            <?php echo h($schedule["id"]); ?>
        </div>
    </div>
    <div class="table-cell staff-name-column person" data-column-number="2">
        <a class="person-link" data-person-description="Staff" href="<?php echo "show-staff.php?id=".h($schedule["staff_id"]); ?>">
            <?php
                                
                $name_set = find_single_name("staff", h($schedule["staff_id"]));
        
                echo h($name_set["last_name"]).", ".h($name_set["first_name"]);
                            
            ?>
        </a>
    </div>
    <div class="table-cell client-name-column person" data-column-number="3">
        <a class="person-link" data-person-description="Client" href="<?php echo "show-client.php?id=".h($schedule["client_id"]); ?>">
            <?php
                            
                $name_set = find_single_name("clients", h($schedule["client_id"]));
                            
                echo h($name_set["last_name"]).", ".h($name_set["first_name"]);
                    
            ?>
        </a>
    </div>
    <div class="table-cell sun-column sun-cell" data-column-number="4">
        <?php 
                            
            if(!empty(h($schedule["sun_in"])) && !empty(h($schedule["sun_out"]))){
                                
                echo h($schedule["sun_in"])."-".h($schedule["sun_out"]);
                                
            }
    
        ?>
    </div>
    <div class="table-cell mon-column mon-cell" data-column-number="5">
        <?php 
                            
            if(!empty(h($schedule["mon_in"])) && !empty(h($schedule["mon_out"]))){
                                
                echo h($schedule["mon_in"])."-".h($schedule["mon_out"]);
                                
            }
    
        ?>
    </div>
    <div class="table-cell tues-column tues-cell" data-column-number="6">
        <?php 
                            
            if(!empty(h($schedule["tues_in"])) && !empty(h($schedule["tues_out"]))){
                                
                echo h($schedule["tues_in"])."-".h($schedule["tues_out"]);
                                
            }
    
        ?>
    </div>
    <div class="table-cell wed-column wed-cell" data-column-number="7">
        <?php 
                            
            if(!empty(h($schedule["wed_in"])) && !empty(h($schedule["wed_out"]))){
                                
                echo h($schedule["wed_in"])."-".h($schedule["wed_out"]);
                                
            }
    
        ?>
    </div>
    <div class="table-cell thurs-column thurs-cell" data-column-number="8">
        <?php 
                            
            if(!empty(h($schedule["thurs_in"])) && !empty(h($schedule["thurs_out"]))){
                                
                echo h($schedule["thurs_in"])."-".h($schedule["thurs_out"]);
                                
            }
    
        ?>
    </div>
    <div class="table-cell fri-column fri-cell" data-column-number="9">
        <?php 
                            
            if(!empty(h($schedule["fri_in"])) && !empty(h($schedule["fri_out"]))){
                                
                echo h($schedule["fri_in"])."-".h($schedule["fri_out"]);
                                
            }
    
        ?>
    </div>
    <div class="table-cell sat-column sat-cell" data-column-number="10">
        <?php 
                            
            if(!empty(h($schedule["sat_in"])) && !empty(h($schedule["sat_out"]))){
                                
                echo h($schedule["sat_in"])."-".h($schedule["sat_out"]);
                                
            }
    
        ?>
    </div>
    <div class="table-cell delete-column delete-link">
        <a href="#"><i class="fa fa-trash-o trash-icon"></i></a>
    </div>
</div>