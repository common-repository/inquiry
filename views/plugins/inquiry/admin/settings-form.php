<section id="form-builder"
    data-ajax="<?php echo admin_url( 'admin-ajax.php' ) ?>"
    data-method="GET"
    <?php if ( $tab != 'form' ) : ?>style="display: none;"<?php endif ?>
>
    <h3>
        <?php _e( 'Form Builder', 'inquiry' ) ?>
    </h3>

    <div class="container">

        <div class="options">

            <span class="loader"
                v-show="isLoading"
            >
                <i class="fa fa-spinner fa-spin"></i>
            </span>

            <a href="#add-input"
                class="button"
                @click.prevent="addInput"
            >
                <i class="fa fa-plus-circle" aria-hidden="true"></i> <?php _e( 'Add Input', 'inquiry' ) ?>
            </a>

        </div>

        <div class="sortable"
            v-show="isReady"
            style="display: none;"
        >

            <div class="input"
                v-for="(index, input) in inputs"
                :class="{'open': input.isOpened}"
            >
                <?php $view->show( 'plugins.inquiry.admin.builder-input' ) ?>
            </div>

        </div>

    </div>

    <table class="form-table">

        <tr valign="top">
            <th scope="row"><?php _e( 'Button text', 'inquiry' ) ?></th>
            <td>
                <input type="text"
                    name="button_text"
                    value="<?php echo $inquiry->button_text ?>"
                />
                <br>
                <span class="description">
                    <?php _e( 'Text to be displayed within the submit button.', 'inquiry' ) ?>
                </span>
            </td>
        </tr>

        <tr valign="top">
            <th scope="row"><?php _e( 'Enqueue styles', 'inquiry' ) ?></th>
            <td>
                <input type="checkbox"
                    name="can_enqueue"
                    value="1"
                    <?php if ( $inquiry->can_enqueue ) : ?>checked<?php endif ?>
                />
                <br>
                <span class="description">
                    <?php _e( 'Indicates whether or not to enqueue default styles when displaying generated form.', 'inquiry' ) ?>
                </span>
            </td>
        </tr>

    </table>

</section>