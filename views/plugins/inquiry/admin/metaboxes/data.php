<section class="data">

    <?php foreach ( $inquiry->data as $slug => $input ) : ?>
        
        <div class="input type-<?php echo $input['type'] ?> input-<?php echo $slug ?>">

            <?php if ( $input['label'] ) : ?>
                <h3 class="label">
                    <?php echo $input['label'] ?>
                </h3>
            <?php endif ?>

            <?php if ( $input['type'] == 'checkbox' ) : ?>
                <div class="value checkbox-<?php echo $input['value'] ?>">
                    <?php if ( $input['value'] == 0 ) : ?>
                        <?php _e( 'No', 'inquiry' ) ?>
                    <?php else : ?>
                        <?php _e( 'Yes', 'inquiry' ) ?>
                    <?php endif ?>
                </div>
            <?php elseif ( $input['type'] == 'email' ) : ?>
                <div class="value">
                    <a href="mailto:<?php echo $input['value'] ?>">
                        <?php echo $input['value'] ?>
                    </a>
                </div>
            <?php elseif ( $input['type'] == 'textarea' ) : ?>
                <div class="value">
                    <?php echo nl2br( $input['value'] ) ?>
                </div>
            <?php else : ?>
                <div class="value">
                    <?php echo $input['value'] ?>
                </div>
            <?php endif ?>

        </div>

    <?php endforeach ?>

</section>