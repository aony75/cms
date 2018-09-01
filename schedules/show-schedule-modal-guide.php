<?php 
    
    session_start();

    //constant variable can't be set here like footer and header becasueinitalize.php are where the constants were defined
    require_once("../private/initialize.php"); 

    redirect_if_not_ajax_request("/schedules");

    require_once(SHARED_PATH."/modal-guide-content/modal-guide-image-wrapper.php");

    require_once(SHARED_PATH."/modal-guide-content/modal-guide-templates/show-schedule-modal-guide-template.php");

?>