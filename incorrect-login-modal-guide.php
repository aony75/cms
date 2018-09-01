<?php 
    
    session_start();

    //constant variable can't be set here like footer and header becasueinitalize.php are where the constants were defined
    require_once("private/initialize.php"); 

    redirect_if_not_ajax_request("");

    require_once(SHARED_PATH."/modal-guide-content/modal-guide-image-wrapper.php");

?>
<h1>
    Having Trouble?
</h1>
<p>
    Try copying the username and password below the submit button and pasting them into their corresponding fields.
</p>
<p>
    That should do the trick :)
</p>
