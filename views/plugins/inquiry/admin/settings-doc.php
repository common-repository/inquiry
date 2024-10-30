<section id="documentation"
    <?php if ( $tab != 'docs' ) : ?>style="display: none;"<?php endif ?>
>
    <h1 id="top"><?php _e( 'Documentation', 'inquiry' ) ?></h1>

    <div>
        <ol>
            <li>
                <a href="#" class="scroll-to" data-marker="#builder"><?php _e( 'Form Builder', 'inquiry' ) ?></a>
                <ol>
                    <li>
                        <a href="#" class="scroll-to" data-marker="#add-input"><?php _e( 'Add input', 'inquiry' ) ?></a>
                    </li>
                    <li>
                        <a href="#" class="scroll-to" data-marker="#remove-input"><?php _e( 'Remove input', 'inquiry' ) ?></a>
                    </li>
                    <li>
                        <a href="#" class="scroll-to" data-marker="#toggle-input"><?php _e( 'Input details', 'inquiry' ) ?></a>
                    </li>
                    <li>
                        <a href="#" class="scroll-to" data-marker="#sort-input"><?php _e( 'Sort inputs', 'inquiry' ) ?></a>
                    </li>
                </ol>
            </li>
            <li>
                <a href="#" class="scroll-to" data-marker="#usage"><?php _e( 'Form Usage', 'inquiry' ) ?></a>
                <ol>
                    <li>
                        <a href="#" class="scroll-to" data-marker="#widget"><?php _e( 'Widget', 'inquiry' ) ?></a>
                    </li>
                    <li>
                        <a href="#" class="scroll-to" data-marker="#shortcode"><?php _e( 'Shortcode', 'inquiry' ) ?></a>
                    </li>
                    <li>
                        <a href="#" class="scroll-to" data-marker="#in-templates"><?php _e( 'In templates', 'inquiry' ) ?></a>
                    </li>
                </ol>
            </li>
            <li>
                <a href="#" class="scroll-to" data-marker="#customization"><?php _e( 'Customization', 'inquiry' ) ?></a>
                <ol>
                    <li>
                        <a href="#" class="scroll-to" data-marker="#example"><?php _e( 'Example', 'inquiry' ) ?></a>
                    </li>
                </ol>
            </li>
        </ol>
    </div>

    <div class="container">

        <div id="builder">
            <h2>
                <?php _e( 'Form Builder', 'inquiry' ) ?>
                <?php $view->show( 'plugins.inquiry.admin.settings-doc-backtotop' ) ?>
            </h2>

            <p><?php _e( '"Form Builder" is the built-in form generator that comes with Inquiry. It lets you create a custom inquiry form based on your needs.', 'inquiry' ) ?></p>

            <h3 id="add-input">
                <?php _e( 'Add input', 'inquiry' ) ?>
                <?php $view->show( 'plugins.inquiry.admin.settings-doc-backtotop' ) ?>
            </h3>
            <p>
                <img src="<?php echo asset_url( '/../../../../img/documentation/builder-input-add.jpg', __FILE__ )?>" alt="add input"/>
            </p>
            <p>
                <?php _e( 'To add a new input simply click the "Add Input" button located at the "Form Builder" tab in the settings page.', 'inquiry' ) ?> 
                <?php _e( 'An new custom input will be created below the button with the details expanded.', 'inquiry' ) ?>
            </p>
            <p>
                <img src="<?php echo asset_url( '/../../../../img/documentation/builder-input-sample.jpg', __FILE__ )?>" alt="input example"/>
            </p>
            <p>
                <?php _e( 'A list of options will appear in the expanded details section.', 'inquiry' ) ?>
            </p>
            <p>
                <ul>
                    <li>
                        <?php _e( '<strong>Label</strong>: The label of the input. Acts as identifier of the input, try not to leave this field empty.', 'inquiry' ) ?>
                    </li>
                    <li>
                        <?php _e( '<strong>Type</strong>: Type of input.', 'inquiry' ) ?>
                    </li>
                    <li>
                        <?php _e( '<strong>Default value</strong>: Used to set a default value. Useful for checkboxes.', 'inquiry' ) ?>
                    </li>
                    <li>
                        <?php _e( '<strong>Placeholder</strong>: Input placeholder.', 'inquiry' ) ?>
                    </li>
                    <li>
                        <?php _e( '<strong>Required</strong>: Whether or not the field is required, meaning that users cannot leave it empty.', 'inquiry' ) ?>
                    </li>
                    <li>
                        <?php _e( '<strong>Display label</strong>: Whether or not to display label in form.', 'inquiry' ) ?>
                    </li>
                    <li>
                        <?php _e( '<strong>Show in results</strong>: Indicates if this field will be displayed in the "insight" column in the Dashboard.', 'inquiry' ) ?>
                    </li>
                    <li>
                        <?php _e( '<strong>Apply filters</strong>: Whether or not to apply security filters.', 'inquiry' ) ?>
                    </li>
                </ul>
            </p>

            <h3 id="remove-input">
                <?php _e( 'Remove input', 'inquiry' ) ?>
                <?php $view->show( 'plugins.inquiry.admin.settings-doc-backtotop' ) ?>
            </h3>
            <p>
                <img src="<?php echo asset_url( '/../../../../img/documentation/builder-input-remove.jpg', __FILE__ )?>" alt="input remove"/> 
                <?php _e( 'Click on the remove button to delete an input from the "Form Builder".', 'inquiry' ) ?>
            </p>

            <h3 id="toggle-input">
                <?php _e( 'Input details', 'inquiry' ) ?>
                <?php $view->show( 'plugins.inquiry.admin.settings-doc-backtotop' ) ?>
            </h3>
            <p>
                <img src="<?php echo asset_url( '/../../../../img/documentation/builder-input-toggle.jpg', __FILE__ )?>" alt="input remove"/> 
                <?php _e( 'Click on the details toggle button to hide or show the details of an input.', 'inquiry' ) ?>
            </p>

            <h3 id="sort-input">
                <?php _e( 'Sort inputs', 'inquiry' ) ?>
                <?php $view->show( 'plugins.inquiry.admin.settings-doc-backtotop' ) ?>
            </h3>
            <p>
                <img src="<?php echo asset_url( '/../../../../img/documentation/builder-input-sort.jpg', __FILE__ )?>" alt="add input"/>
            </p>
            <p>
                <?php _e( 'Drag-and-drop an input to the desired vertical position to change its sort order.', 'inquiry' ) ?>
            </p>
        </div>

        <div id="usage">
            <h2>
                <?php _e( 'Form Usage', 'inquiry' ) ?>
                <?php $view->show( 'plugins.inquiry.admin.settings-doc-backtotop' ) ?>
            </h2>

            <p><?php _e( 'There are multiple ways to use or display the form generated with the "Form Builder":', 'inquiry' ) ?></p>

            <h3 id="widget">
                <?php _e( 'Widget', 'inquiry' ) ?>
                <?php $view->show( 'plugins.inquiry.admin.settings-doc-backtotop' ) ?>
            </h3>
            <p>
                <img src="<?php echo asset_url( '/../../../../img/documentation/usage-widget-wpmenu.jpg', __FILE__ )?>" alt="widget step 1"/>
            </p>
            <p>
                <?php _e( 'Head to Wordpress\' widgets section, locate <strong>Inquiry Form</strong> widget and drag-and-drop it to the theme\'s sidebar of your choice.', 'inquiry' ) ?>
            </p>
            <p>
                <img src="<?php echo asset_url( '/../../../../img/documentation/usage-widget-selection.jpg', __FILE__ )?>" alt="widget step 2"/>
            </p>

            <h3 id="shortcode">
                <?php _e( 'Shortcode', 'inquiry' ) ?>
                <?php $view->show( 'plugins.inquiry.admin.settings-doc-backtotop' ) ?>
            </h3>
            <p><?php _e( 'Add the following shortcode within the content of a post to display the form:', 'inquiry' ) ?></p>
            <pre>
                [inquiry_form]
            </pre>

            <h3 id="in-templates">
                <?php _e( 'In templates', 'inquiry' ) ?>
                <?php $view->show( 'plugins.inquiry.admin.settings-doc-backtotop' ) ?>
            </h3>
            <p><?php _e( 'Add the following line of code within your template to display the form:', 'inquiry' ) ?></p>
            <code>
                &lt;?php the_inquiry_form() ?&gt;
            </code>
        </div>

        <div id="customization">
            <h2>
                <?php _e( 'Customization', 'inquiry' ) ?>
                <?php $view->show( 'plugins.inquiry.admin.settings-doc-backtotop' ) ?>
            </h2>
            <p>
                <?php _e( 'Inquiry lets you customize all its templates (views) in a very friendly way.', 'inquiry' ) ?> 
                <?php _e( 'Just copy a selected template (view) file from:', 'inquiry' ) ?>
            </p>
            <p>
                <code>
                    wp-content/plugins/inquiry/views
                </code>
            </p>
            <p>
                <?php _e( 'Into your theme\'s folder:', 'inquiry' ) ?>
            </p>
            <p>
                <code>
                    wp-content/themes/[your-theme-name]/views
                </code>
            </p>

            <h3 id="example">
                <?php _e( 'Example', 'inquiry' ) ?>
                <?php $view->show( 'plugins.inquiry.admin.settings-doc-backtotop' ) ?>
            </h3>
            <p>
                <?php _e( 'In the following example, we want to customize the generated form view and the textarea input displayed inside.', 'inquiry' ) ?>
            </p>
            <p>
                <?php _e( 'First we locate and copy the wanted files inside the plugin\'s folder:', 'inquiry' ) ?>
            </p>
            <p>
                <img src="<?php echo asset_url( '/../../../../img/documentation/customization-example1.jpg', __FILE__ )?>" alt="example 1"/>
            </p>
            <p>
                <?php _e( 'Then we paste them over (with the same path structure) into our theme:', 'inquiry' ) ?>
            </p>
            <p>
                <img src="<?php echo asset_url( '/../../../../img/documentation/customization-example2.jpg', __FILE__ )?>" alt="example 2"/>
            </p>
        </div>

    </div>

    <div class="credits text-center">
        <p><?php _e( 'Brought to you by', 'inquiry' ) ?> </p>
        <a href="http://www.10quality.com">
            <img src="<?php echo asset_url( '/../../../../img/10quality-logo-x65.png', __FILE__ )?>"
                alt="10 Quality - Software Development Studio"
            />
        </a>
    </div>

</section>