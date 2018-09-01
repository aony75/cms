<?php
    
    session_start();

    //constant variable can't be set here like footer and header becasue initalize.php are where the constants were defined
    require_once("../private/initialize.php");
    
    redirect_if_not_ajax_request("clients");

    $schedule_form_type = "new";
    require_once(SHARED_PATH."/schedules-content/schedule-form-content.php");
?>