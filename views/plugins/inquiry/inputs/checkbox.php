<?php
/**
 * Checkbox input template.
 *
 * @author Alejandro Mostajo
 * @copyright 10Quality
 * @package Inquiry
 * @version 1.0.0
 */
?>
<div class="checkbox">
    <label>
        <input type="checkbox"
            id="inputs[<?php echo $index ?>]"
            name="inputs[<?php echo $index ?>]"
            value="<?php echo $input['default'] ?>"
        /> <?php echo $input['label'] ?>
    </label>
</div>