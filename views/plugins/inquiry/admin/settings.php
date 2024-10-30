<?php use Inquiry\Main as Software ?>
<div class="wrap">

    <h2><?php _e( 'Inquiry Settings', 'inquiry' ) ?></h2>

    <?php if ( $notice ) : ?>
        <div id="setting-error-settings_updated" class="updated settings-error notice is-dismissible"> 
            <p><strong><?php echo $notice ?></strong></p>
            <button type="button" class="notice-dismiss">
                <span class="screen-reader-text"><?php _e( 'Dismiss this notice.', 'inquiry' ) ?></span>
            </button>
        </div>
    <?php endif ?>

    <?php if ( $error ) : ?>
        <div id="setting-error-settings_updated" class="error settings-error notice is-dismissible"> 
            <p><strong><?php echo $error ?></strong></p>
            <button type="button" class="notice-dismiss">
                <span class="screen-reader-text"><?php _e( 'Dismiss this notice.', 'inquiry' ) ?></span>
            </button>
        </div>
    <?php endif ?>

    <form method="POST">

        <h3 class="nav-tab-wrapper">
            <?php foreach ( $tabs as $key => $name ) : ?>
                <a class="nav-tab <?php if ( $tab == $key ) :?>nav-tab-active<?php endif ?>"
                    href="<?php echo admin_url( 'options-general.php?page=' . Software::ADMIN_MENU_SETTINGS . '&tab=' . $key ) ?>"
                >
                    <?php echo $name ?>
                </a>
            <?php endforeach ?>
        </h3>

        <input type="hidden"
            name="security_key"
            value="<?php echo $inquiry->security_key ?>"
        />

        <?php $view->show( 'plugins.inquiry.admin.settings-general', [ 'tab' => $tab, 'inquiry' => $inquiry ] ) ?>

        <?php $view->show( 'plugins.inquiry.admin.settings-form', [ 'tab' => $tab, 'inquiry' => $inquiry, 'view' => $view ] ) ?>

        <?php $view->show( 'plugins.inquiry.admin.settings-mail', [ 'tab' => $tab, 'inquiry' => $inquiry ] ) ?>

        <?php do_action( 'inquiry_settings_view', $tab, $inquiry ) ?>

        <?php if ( $tab != 'docs' ) : ?>

            <?php submit_button() ?>

        <?php endif ?>

    </form>

    <?php $view->show( 'plugins.inquiry.admin.settings-doc', [ 'tab' => $tab, 'view' => $view ] ) ?>

</div>