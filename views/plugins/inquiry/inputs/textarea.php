<?php
/**
 * Email input template.
 *
 * @author Alejandro Mostajo
 * @copyright 10Quality
 * @package Inquiry
 * @version 1.0.0
 */
?>
<div class="form-group">

    <?php if ( $input['display'] ) : ?>
        <label for="inputs[<?php echo $index ?>]">
            <?php echo $input['label'] ?>
        </label>
    <?php endif ?>

    <textarea class="form-control"
        id="inputs[<?php echo $index ?>]"
        name="inputs[<?php echo $index ?>]"
        placeholder="<?php echo $input['placeholder'] ?>"
        <?php if ( $input['required'] ) : ?>
            data-required="1"
        <?php endif ?>
    /><?php echo $input['default'] ?></textarea>

</div>