<section id="admin-app" class="mail"
    <?php if ( $tab != 'mail' ) : ?>style="display: none;"<?php endif ?>
>
    <h3>
        <?php _e( 'Mail', 'inquiry' ) ?>
    </h3>

    <table class="form-table">

        <tr valign="top">
            <th scope="row"><?php _e( 'Engine', 'inquiry' ) ?></th>
            <td>
                <input type="hidden"
                    name="engine"
                    v-model="settings.engine"
                    value="<?php echo $inquiry->engine ?>"
                />
                <input type="radio"
                    v-model="settings.engine"
                    value="wp"
                /> Wordpress mail (<a href="https://developer.wordpress.org/reference/functions/wp_mail/">wp_mail</a>)
                <br>
                <input type="radio"
                    v-model="settings.engine"
                    value="smtp"
                /> SMTP
                <br>
                <span class="description">
                    <?php _e( 'Mailing enging used to send emails.', 'inquiry' ) ?>
                </span>
            </td>
        </tr>

    </table>

    <h4 v-if="settings.engine == 'smtp'">
        <?php _e( 'SMTP settings', 'inquiry' ) ?>
    </h4>

    <table class="form-table" v-if="settings.engine == 'smtp'">

        <tr valign="top">
            <th scope="row"><?php _e( 'Host', 'inquiry' ) ?></th>
            <td>
                <input type="text"
                    name="smtp_host"
                    class="regular-text"
                    placeholder="<?php _e( 'i.e. smtp1.domain.com', 'inquiry' ) ?>"
                    value="<?php echo $inquiry->smtp_host ?>"
                />
            </td>
        </tr>

        <tr valign="top">
            <th scope="row"><?php _e( 'Authentication', 'inquiry' ) ?></th>
            <td>
                <input type="checkbox"
                    name="smtp_auth"
                    value="1"
                    <?php if ( $inquiry->smtp_auth ) : ?>checked<?php endif ?>
                />
                <br>
                <span class="description">
                    <?php _e( 'Authentication required?', 'inquiry' ) ?>
                </span>
            </td>
        </tr>

        <tr valign="top">
            <th scope="row"><?php _e( 'Username', 'inquiry' ) ?></th>
            <td>
                <input type="text"
                    name="smtp_username"
                    class="regular-text"
                    value="<?php echo $inquiry->smtp_username ?>"
                />
            </td>
        </tr>

        <tr valign="top">
            <th scope="row"><?php _e( 'Password', 'inquiry' ) ?></th>
            <td>
                <input type="password"
                    name="smtp_password"
                    class="regular-text"
                    value="<?php echo $inquiry->smtp_raw_password ?>"
                />
                <br>
                <span class="description">
                    <?php _e( 'Password is encrypted when stored.', 'inquiry' ) ?>
                </span>
            </td>
        </tr>

        <tr valign="top">
            <th scope="row"><?php _e( 'Port', 'inquiry' ) ?></th>
            <td>
                <input type="number"
                    name="smtp_port"
                    class="regular-text"
                    value="<?php echo $inquiry->smtp_port ?>"
                />
            </td>
        </tr>

        <tr valign="top">
            <th scope="row"><?php _e( 'Security', 'inquiry' ) ?></th>
            <td>
                <input type="hidden"
                    name="smtp_security"
                    v-model="settings.security"
                    value="<?php echo $inquiry->smtp_security ?>"
                />
                <select v-model="settings.security">
                    <option value="">None</option>
                    <option value="tls">TLS</option>
                    <option value="sll">SSL</option>
                </select>
            </td>
        </tr>

        <tr valign="top">
            <th scope="row"><?php _e( 'From address', 'inquiry' ) ?></th>
            <td>
                <input type="email"
                    name="smtp_from"
                    class="regular-text"
                    value="<?php echo $inquiry->smtp_from ?>"
                    placeholder="<?php _e( 'i.e. no-reply@domain.com', 'inquiry' ) ?>"
                />
            </td>
        </tr>

    </table>

    <?php do_action( 'inquery_settings_general_mail' ) ?>

</section>