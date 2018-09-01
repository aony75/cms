<!--template for client row-->
<div class="table-row" data-href="<?php echo url_for("/clients/show-client.php?id=".u($client["id"])); ?>">
    <div class="table-cell checkbox-column">
        <div class="checkbox-wrapper">
            <input type="hidden" name="is_deleted" value="0">
            <input type="checkbox" name="is_deleted" value="1">
        </div>
    </div>
    <div class="table-cell evv-id-column" data-column-number="1">
        <div class="display-none<?php echo " ".h($client["id"]); ?>">
            <?php echo h($client["id"]); ?>
        </div>
        <div class="evv-id-cell">
            <?php echo h($client["evv_id"]); ?>
        </div>
    </div>
    <div class="table-cell name-column person" data-column-number="2">
        <?php echo h(ucwords($client["last_name"])).", ".h(ucwords($client["first_name"])); ?>
    </div>
    <div class="table-cell amerigroup-id-column amerigroup-cell" data-column-number="3">
        <?php echo ( $client["amerigroup_number"] == 0) ? "not entered" : h($client["amerigroup_number"]); ?>
    </div>
    <div class="table-cell medicaid-id-column medicaid-cell" data-column-number="4">
        <?php echo ($client["medicaid_id"] == 0) ? "not entered" : h($client["medicaid_id"] ); ?>
    </div>
    <div class="table-cell phone-number-column phone-number-cell" data-column-number="5">
        <?php echo ($client["phone_number"] == "") ? "not entered" : h($client["phone_number"]); ?>
    </div>
    <div class="table-cell delete-column delete-link">
        <a href="#"><i class="fa fa-trash-o trash-icon"></i></a>
    </div>
</div>