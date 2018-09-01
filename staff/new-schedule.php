<?php
    
    session_start();

    //constant variable can't be set here like footer and header becasue initalize.php are where the constants were defined
    require_once("../private/initialize.php"); 

    redirect_if_not_ajax_request("staff");

    $form_id = "new-schedule";
    $modal_title ="add new schedule";
    require_once(SHARED_PATH."/modal-header.php");
    
    require_once(SHARED_PATH."/schedules-content/new-schedule-content.php");

?>
