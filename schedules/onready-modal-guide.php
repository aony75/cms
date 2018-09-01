<?php 
    
    session_start();

    //constant variable can't be set here like footer and header becasueinitalize.php are where the constants were defined
    require_once("../private/initialize.php"); 

    redirect_if_not_ajax_request("/schedules");

    require_once(SHARED_PATH."/modal-guide-content/modal-guide-image-wrapper.php");

?>
<h1>
    Schedules Page
</h1>
<ul>
    <li>
        <span class="bold">CLIENTS & STAFF LINKS:</span> Just click on the link and it will take you to that person's record.
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