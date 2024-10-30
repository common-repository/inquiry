<div class="inquiry">
    <?php foreach ( $inquiry->data as $slug => $input ) : ?>
        <?php if ( $input['inres'] == 1 ) : ?>
            <div class="input <?php echo $slug ?>">
                <span class="label"><?php echo $input['label'] ?></span> 
                <span class="value">
                    <?php if ( $input['type'] == 'checkbox' ) : ?>
                        <?php if ( $input['value'] == 0 ) : ?>
                            <?php _e( 'No', 'inquiry' ) ?>
                        <?php else : ?>
                            <?php _e( 'Yes', 'inquiry' ) ?>
                        <?php endif ?>
                    <?php elseif ( $input['type'] == 'email' ) : ?>
                        <a href="mailto:<?php echo $input['value'] ?>">
                            <?php echo $input['value'] ?>
                        </a>
                    <?php else : ?>
                        <?php echo $input['value'] ?>
                    <?php endif ?>
                </span>
            </div>
        <?php endif ?>
    <?php endforeach ?>
</div>