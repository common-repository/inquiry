<?php

namespace Inquiry\Controllers;

use WP_User;
use Inquiry\Main as Software;
use Inquiry\Models\Inquiry;
use Inquiry\Models\InquirySettings;
use Amostajo\LightweightMVC\Controller;
use Amostajo\LightweightMVC\Request;
use Amostajo\WPPluginCore\Cache;
use Amostajo\WPPluginCore\Log;

/**
 * Handles admin methods.
 *
 * @author Alejandro Mostajo <http://about.me/amostajo>
 * @copyright 10Quality <http://www.10quality.com>
 * @package Inquiry
 * @version 1.1.0
 */
class AdminController extends Controller
{
    /**
     * Enqueues and registers scripts.
     * @since 1.0.0
     */
    public function enqueue()
    {
        wp_register_style(
            'inquiry-admin',
            asset_url( '/../css/admin.css', __FILE__ ),
            [],
            '1.0.0'
        );
    }

    /**
     * Registers admin menus.
     * @since 1.0.0
     */
    public function menu()
    {
        add_submenu_page(
            'options-general.php',
            __( 'Inquiry Settings', 'inquiry' ),
            'Inquiry',
            'manage_options',
            Software::ADMIN_MENU_SETTINGS,
            [ &$this, 'view_settings' ]
        );
    }

    /**
     * Displays admin settings.
     * @since 1.0.0
     * @since 1.1.0 Added security key init.
     */
    public function view_settings()
    {
        wp_enqueue_style(
            'inquiry-admin-settings',
            asset_url( '/../css/admin-settings.css', __FILE__ ),
            [],
            '1.0.0'
        );
        wp_enqueue_script(
            'inquiry-admin-settings',
            asset_url( '/../js/admin-settings.js', __FILE__ ),
            [ 'jquery-ui-sortable' ],
            '1.0.0',
            true
        );
        $inquiry = InquirySettings::find();
        if (!$inquiry->security_key)
            $inquiry->security_key = uniqid();
        $this->view->show( 'plugins.inquiry.admin.settings', [
            'notice'        => $this->save( $inquiry ),
            'error'         => Request::input( 'error' ),
            'tab'           => Request::input( 'tab', 'general' ),
            'tabs'          => apply_filters( 'inquiry_settings_tabs', [
                                'general'   => __( 'General', 'inquiry' ),
                                'form'      => __( '<i class="fa fa-cogs" aria-hidden="true"></i> Form Builder', 'inquiry' ),
                                'mail'      => __( '<i class="fa fa-envelope" aria-hidden="true"></i> Mailing', 'inquiry' ),
                                'docs'      => __( '<i class="fa fa-book" aria-hidden="true"></i> Documentation', 'inquiry' ),
                            ] ),
            'view'          => $this->view,
            'inquiry'       => $inquiry,
        ] );
    }

    /**
     * Saves settings.
     * Returns flag indicating success operation
     * @since 1.0.0
     * @since 1.1.0 Added SMTP alternative.
     *
     * @param object $socialFeeder Social Feeder model
     */
    protected function save( &$model )
    {
        $notice = Request::input( 'notice' );
        // Check action
        if ( !empty( $notice ) ) return $notice;
        // Save form
        if ( $_POST ) {
            try {
                
                // General tab and mail information
                $model->is_notification_enabled = Request::input( 'is_notification_enabled', 0 );
                $model->can_admin_edit          = Request::input( 'can_admin_edit', 0 );
                $model->notification_email      = Request::input( 'notification_email' );
                $model->notification_subject    = Request::input( 'notification_subject', 'Inquiry sent to you.' );
                $model->title_format            = Request::input( 'title_format', 'F j, Y h:i a' );
                $model->button_text             = Request::input( 'button_text', __( 'Submit', 'inquiry' ) );
                $model->can_enqueue             = Request::input( 'can_enqueue', 0 );
                $model->engine                  = Request::input( 'engine', 'wp' );
                $model->smtp_host               = Request::input( 'smtp_host' );
                $model->smtp_auth               = Request::input( 'smtp_auth', 0 );
                $model->smtp_username           = Request::input( 'smtp_username' );
                $model->smtp_port               = Request::input( 'smtp_port' );
                $model->smtp_security           = Request::input( 'smtp_security' );
                $model->smtp_from               = Request::input( 'smtp_from' );
                $model->security_key            = Request::input( 'security_key', uniqid() );
                $model->set_smtp_password( Request::input( 'smtp_password' ) );

                // Input generator
                $input = [
                    'indexes'       => Request::input( 'inputs', [] ),
                    'labels'        => Request::input( 'input_labels', [] ),
                    'types'         => Request::input( 'input_types', [] ),
                    'defaults'      => Request::input( 'input_defaults', [] ),
                    'placeholders'  => Request::input( 'input_placeholders', [] ),
                    'display'       => Request::input( 'input_display', [] ),
                    'required'      => Request::input( 'input_required', [] ),
                    'inresults'     => Request::input( 'input_inresults', [] ),
                    'filters'       => Request::input( 'input_filters', [] ),
                    
                ];
                $model->inputs = [];
                foreach ( $input['indexes'] as $index ) {
                    $model->inputs[] = [
                        'label'         => $input['labels'][$index],
                        'type'          => $input['types'][$index],
                        'default'       => $input['defaults'][$index],
                        'placeholder'   => $input['placeholders'][$index],
                        'display'       => isset( $input['display'][$index] ) ? $input['display'][$index] : 0,
                        'required'      => isset( $input['required'][$index] ) ? $input['required'][$index] : 0,
                        'inresults'     => isset( $input['inresults'][$index] ) ? $input['inresults'][$index] : 0,
                        'filters'       => isset( $input['filters'][$index] ) ? $input['filters'][$index] : 0,
                        'isOpened'      => 0,
                    ];
                }

                /**
                 * Apply filters to settings model before it is saved.
                 * @since 1.0.0
                 */
                $model = apply_filters( 'inquiry_settings_before_save', $model );

                $model->save();

                // Clear cache
                Cache::forget( 'inquiry' );
                Cache::forget( 'inquiry_form_builder' );

                return __( 'Settings saved.', 'inquiry' );

            } catch (Exception $e) {
                Log::error($e);
            }
        }
        return;
    }
    
    /**
     * JSON ajax call that returns current form generated.
     * @since 1.0.0
     */
    public function ajax_form_builder()
    {
        header('Content-type: application/json');
        echo json_encode(
            Cache::remember( 'inquiry_form_builder', 43200, function() {
                $inquiry = InquirySettings::find();
                return is_array( $inquiry->inputs ) ? $inquiry->inputs : [];
            } )
        );
        die;
    }
}