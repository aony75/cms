<script type="text/javascript" src="<?php echo url_for("/scripts/script-functions.js"); ?>"></script>
<div id="modal-header-bar">
    <input type="submit" value="Save" class="<?php if(!isset($input_submit_class)){$input_submit_class = "";} echo $input_submit_class; ?>" form="<?php if(!isset($form_id)){$form_id = "";} echo $form_id; ?>">
    <h4>
        <?php 
        if(!isset($modal_title)){$modal_title = "";}
        
        echo ucwords($modal_title); 
        ?>
    </h4>
    <a href="#" class="modal-close-icon">&#10006;</a>
</div>