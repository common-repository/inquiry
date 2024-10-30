<div class="heading item-{{ index }}">
    <div class="actions">
        <button type="button"
            @click.prevent="toggleInput(index)"
        >
            <i class="fa fa-angle-down"
                aria-hidden="true"
                v-show="!input.isOpened"
            ></i>
            <i class="fa fa-angle-up"
                aria-hidden="true"
                v-show="input.isOpened"
            ></i>
            <span><?php _e( 'Details', 'inquiry' ) ?></span>
        </button>
        <button type="button"
            class="remove"
            @click.prevent="removeInput(index)"
        >
            <i class="fa fa-trash" aria-hidden="true"></i>
        </button>
    </div>
    <div class="name">
        #{{ index }} | {{ input.label }} | {{ input.type }}
    </div>
</div>
<div class="details">
    <input type="hidden"
        name="inputs[]"
        value="{{ index }}"
    />
    <table class="form-table">
        <tr valign="top">
            <th scope="row"><?php _e( 'Label', 'inquiry' ) ?></th>
            <td>
                <input type="text"
                    name="input_labels[{{ index }}]"
                    class="regular-text"
                    v-model="input.label"
                    placeholder="<?php _e( 'Label to display in form.', 'inquiry' ) ?>"
                />
            </td>
        </tr>
        <tr valign="top">
            <th scope="row"><?php _e( 'Type', 'inquiry' ) ?></th>
            <td>
                <select name="input_types[{{ index }}]"
                    class="regular-text"
                    v-model="input.type"
                >
                    <option value="text">
                        Text
                    </option>
                    <option value="email">
                        Email
                    </option>
                    <option value="textarea">
                        Textarea
                    </option>
                    <option value="checkbox">
                        Checkbox
                    </option>
                    <option value="hidden">
                        Hidden
                    </option>
                </select>
            </td>
        </tr>
        <tr valign="top">
            <th scope="row"><?php _e( 'Default value', 'inquiry' ) ?></th>
            <td>
                <input type="text"
                    class="regular-text"
                    name="input_defaults[{{ index }}]"
                    placeholder="<?php _e( 'Default value', 'inquiry' ) ?>"
                    v-model="input.default"
                />
            </td>
        </tr>
        <tr valign="top"
            v-show="input.type != 'hidden'"
        >
            <th scope="row"><?php _e( 'Placeholder', 'inquiry' ) ?></th>
            <td>
                <input type="text"
                    class="regular-text"
                    name="input_placeholders[{{ index }}]"
                    v-model="input.placeholder"
                    placeholder="<?php _e( 'Placeholder text, like this one you are reading now.', 'inquiry' ) ?>"
                />
            </td>
        </tr>
        <tr valign="top"
            v-show="input.type != 'hidden'"
        >
            <th scope="row"><?php _e( 'Required', 'inquiry' ) ?></th>
            <td>
                <input type="checkbox"
                    name="input_required[{{ index }}]"
                    value="1"
                    v-model="input.required"
                />
                <br>
                <span class="description">
                    <?php _e( 'Whether or not input is required.', 'inquiry' ) ?>
                </span>
            </td>
        </tr>
        <tr valign="top"
            v-show="input.type != 'hidden'"
        >
            <th scope="row"><?php _e( 'Display label', 'inquiry' ) ?></th>
            <td>
                <input type="checkbox"
                    name="input_display[{{ index }}]"
                    value="1"
                    v-model="input.display"
                />
                <br>
                <span class="description">
                    <?php _e( 'Whether or not to display the label in form.', 'inquiry' ) ?>
                </span>
            </td>
        </tr>
        <tr valign="top"
            v-show="input.type != 'hidden'"
        >
            <th scope="row"><?php _e( 'Show in results', 'inquiry' ) ?></th>
            <td>
                <input type="checkbox"
                    name="input_inresults[{{ index }}]"
                    value="1"
                    v-model="input.inresults"
                />
                <br>
                <span class="description">
                    <?php _e( 'Whether or not to display the input and value in the Inquiries "Insight" column, located when browsing for inquiries at the dashboard.', 'inquiry' ) ?>
                </span>
            </td>
        </tr>
        <tr valign="top">
            <th scope="row"><?php _e( 'Apply filters', 'inquiry' ) ?></th>
            <td>
                <input type="checkbox"
                    name="input_filters[{{ index }}]"
                    value="1"
                    v-model="input.filters"
                />
                <br>
                <span class="description">
                    <?php _e( 'Whether or not to apply security filters.', 'inquiry' ) ?>
                </span>
                <br>
                <span class="description">
                    <?php _e( 'Read more', 'inquiry' ) ?> 
                    <a href="http://www.w3schools.com/php/php_form_validation.asp">
                        <?php _e( 'here', 'inquiry' ) ?>
                    </a>
                </span>
            </td>
        </tr>
    </table>
</div>