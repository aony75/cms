<div class="table-row" data-href="<?php echo url_for("staff/show-staff.php?id=".u($staff["id"])); ?>">
    <div class="table-cell checkbox-column">
        <div class="checkbox-wrapper">
            <input type="hidden" name="is_deleted" value="0">
            <input type="checkbox" name="is_deleted" value="1">
        </div>
    </div>
    <div class="table-cell evv-id-column" data-column-number="1">
        <div class="display-none<?php echo " ".h($staff["id"]); ?>">
            <?php echo h($staff["id"]); ?>
        </div>
        <div class="evv-id-cell">
            <?php echo empty(h($staff["evv_id"])) ? "not entered" : h($staff["evv_id"]); ?>
        </div>
    </div>
    <div class="table-cell name-column person" data-column-number="2">
        <?php echo h(ucwords($staff["last_name"])).", ".h(ucwords($staff["first_name"])); ?>
    </div>
    <div class="table-cell phone-number-column phone-number-cell" data-column-number="3">
        <?php echo ($staff["phone_number"] == "") ? "not entered" : h($staff["phone_number"]); ?>
    </div>
    <div class="table-cell mail-column mail-cell" data-column-number="4">
        <?php echo ( $staff["mail"] == "0") ? "not entered" : h($staff["mail"]); ?>
    </div>
    <div class="table-cell pay-rate-column pay-rate-cell" data-column-number="5">
        <?php echo ($staff["pay_rate"] == "0") ? "not entered" : h($staff["pay_rate"] ); ?>
    </div>
    <div class="table-cell delete-column delete-link">
        <a href="#"><i class="fa fa-trash-o trash-icon"></i></a>
    </div>
</div>