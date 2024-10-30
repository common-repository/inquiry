<?php
/**
 * Text input template.
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

    <input type="text"
        class="form-control"
        id="inputs[<?php echo $index ?>]"
        name="inputs[<?php echo $index ?>]"
        placeholder="<?php echo $input['placeholder'] ?>"
        value="<?php echo $input['default'] ?>"
        <?php if ( $input['required'] ) : ?>
            data-required="1"
        <?php endif ?>
    />

</div>