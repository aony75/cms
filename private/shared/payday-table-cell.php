<?php
    
    //if pay day month is not set it will automatically just be a space
    if(!isset($pay_day_month)){
        $pay_day_month = "";
    }
?>

<tr>
    <td><?php echo ucfirst($pay_day_month)." "; ?></td>
</tr>