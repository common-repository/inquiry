<?php
/**
 * Inquiry notification email template.
 *
 * @author Alejandro Mostajo
 * @copyright 10Quality
 * @package Inquiry
 * @version 1.0.0
 */
 ?>
<html>
    <head>
        <title><?php echo $settings->notification_subject ?></title>
    </head>
    <body>
        <h1><?php echo $settings->notification_subject ?></h1>
        <p><?php _e( 'The following inquiry has been submitted:', 'inquiry' ) ?></p>
        <?php foreach ( $inquiry->data as $slug => $input ) : ?>
            <h2>
                <?php echo $input['label'] ?>
            </h2>
            <?php if ( $input['type'] == 'checkbox' ) : ?>
                <p>
                    <?php if ( $input['value'] == 0 ) : ?>
                        <?php _e( 'No', 'inquiry' ) ?>
                    <?php else : ?>
                        <?php _e( 'Yes', 'inquiry' ) ?>
                    <?php endif ?>
                </p>
            <?php elseif ( $input['type'] == 'textarea' ) : ?>
                <p>
                    <?php echo nl2br( $input['value'] ) ?>
                </p>
            <?php else : ?>
                <p>
                    <?php echo $input['value'] ?>
                </p>
            <?php endif ?>
        <?php endforeach ?>
    </body>
</html>