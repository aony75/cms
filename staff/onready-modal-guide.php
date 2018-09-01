<?php 
    
    session_start();

    //constant variable can't be set here like footer and header becasueinitalize.php are where the constants were defined
    require_once("../private/initialize.php"); 

    redirect_if_not_ajax_request("/staff");

    require_once(SHARED_PATH."/modal-guide-content/modal-guide-image-wrapper.php");

?>
<h1>
    Staff Page
</h1>
<ul>
    <li>
        <span class="bold">GENERATE MAILING LIST:</span> This button is used to generate a list of mailing preferences for the staff to ensure paychecks arrive on time. 
    </li>
    <li>
        <?php
            require_once(SHARED_PATH."/modal-guide-content/title-link-info.php");
        ?>
    </li>
</ul>
<div class="info-container">
    <h2 class="show-info-link">
        Navigation:
    </h2>
    <div class="info-wrapper display-none">
        <?php
            require_once(SHARED_PATH."/modal-guide-content/navigation-info.php");
        ?>
    </div>
</div>
<div class="info-container">
    <h2 class="show-info-link">
        Table Buttons & Search Bar:
    </h2>
    <div class="info-wrapper display-none">
        <?php
            require_once(SHARED_PATH."/modal-guide-content/table-buttons-and-search-bar-info.php");
        ?>
    </div>
</div>
<div class="info-container">
    <h2 class="show-info-link">
        Table:
    </h2>
    <div class="info-wrapper display-none">
        <?php
            require_once(SHARED_PATH."/modal-guide-content/table-info.php");
        ?>
    </div>
</div>