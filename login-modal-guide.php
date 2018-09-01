<?php 
    
    session_start();

    //constant variable can't be set here like footer and header becasue initalize.php are where the constants were defined
    require_once("private/initialize.php"); 

    redirect_if_not_ajax_request("");

    require_once(SHARED_PATH."/modal-guide-content/modal-guide-image-wrapper.php");

?>
<h1>
    Welcome To My Content Management System!
</h1>
<h2>
    Things To Know Before Starting:
</h2>
<ul>
    <li>
        <span class="bold">LOGIN INFO:</span> Right below the submit button.
    </li>
    <li>
        <span class="bold">HOW TO TURN ME OFF:</span> Go to the bottom of me and press the "Stop Guide" button and I will not show up again.
    </li>
    <li>
        <span class="bold">HOW TO CLOSE ME:</span> Go to the bottom of me and press the "Got It!" button once you've read the information, but I will continue to appear as you continue to tour my web application.
    </li>
    <li>
        <span class="bold">HOW TO MOVE ME:</span> Move me out of the way by clicking and dragging me anywhere on the screen.
    </li>
</ul>
 <p>
     <span class="bold">MY RECOMMENDATION:</span> Keep me open so you can look back at the information I've given you. Just click and drag me out of the way as needed.
</p>