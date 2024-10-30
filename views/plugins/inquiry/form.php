<?php
/**
 * Inquiry main form template (view).
 *
 * @author Alejandro Mostajo
 * @copyright 10Quality
 * @package Inquiry
 * @version 1.0.0
 */
 ?>
<!-- #inquiry must be present -->
<section id="inquiry">
    <form method="POST"
        action="<?php echo $ajax ?>"
    >
        <!-- Action must be present -->
        <input type="hidden" name="action" value="inquiry_submit"/>
        <?php inquiry()->inputs( $inquiry ) ?>
        <div class="loader">
            <?php _e( 'Loading...', 'inquiry' ) ?>
        </div>
        <div class="response"></div>
        <button type="submit"
            class="button"
        >
            <?php echo $inquiry->button_text ?>
        </button>
    </form>
</section>