<?php 
    
    session_start();

    //constant variable can't be set here like footer and header becasue initalize.php are where the constants were defined
    require_once("../private/initialize.php"); 

    redirect_if_not_ajax_request("/clients");

    require_once(SHARED_PATH."/modal-guide-content/modal-guide-image-wrapper.php");

    require_once(SHARED_PATH."/modal-guide-content/modal-guide-templates/add-new-modal-guide-template.php");

?>
