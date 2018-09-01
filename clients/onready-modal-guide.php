<?php 
    
    session_start();

    //constant variable can't be set here like footer and header becasueinitalize.php are where the constants were defined
    require_once("../private/initialize.php"); 

    redirect_if_not_ajax_request("/clients");

    require_once(SHARED_PATH."/modal-guide-content/modal-guide-image-wrapper.php");

?>
<h1>
    Clients Page
</h1>
<h2>
    Navigation:
</h2>
<?php
    require_once(SHARED_PATH."/modal-guide-content/navigation-info.php");
?>
<h2>
    Table Buttons & Search Bar:
</h2>
<?php
    require_once(SHARED_PATH."/modal-guide-content/table-buttons-and-search-bar-info.php");
?>
<h2>
    Table:
</h2>
<?php
    require_once(SHARED_PATH."/modal-guide-content/table-info.php");
?>