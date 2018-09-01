<?php 
    
    session_start();

    //constant variable can't be set here like footer and header becasueinitalize.php are where the constants were defined
    require_once("../private/initialize.php"); 

    redirect_if_not_ajax_request("/payroll");

    require_once(SHARED_PATH."/modal-guide-content/modal-guide-image-wrapper.php");

?>
<h1>
    Payroll Calendar
</h1>
<h2>
    Things To Know:
</h2>
<ul>
    <li>
        <span class="bold">PRINT FRIENDLY:</span> You can print the calendar with the print icon located in the top right corner. 
    </li>
    <li>
        <span class="bold">COLOR CODE LEGEND:</span> The color code legend for the calendar is specified at the of the page. 
    </li>
</ul>
