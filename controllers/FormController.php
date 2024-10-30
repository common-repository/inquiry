<?php

namespace Inquiry\Controllers;

use PHPMailer;
use Inquiry\Main as Software;
use Inquiry\Models\Inquiry;
use Inquiry\Models\InquirySettings;
use Amostajo\LightweightMVC\Controller;
use Amostajo\LightweightMVC\Request;
use Amostajo\WPPluginCore\Cache;
use Amostajo\WPPluginCore\Log;
use Inquiry\Exceptions\RequiredException;

/**
 * Form controller.
 *
 * @author Alejandro Mostajo <http://about.me/amostajo>
 * @copyright 10Quality
 * @package Inquiry
 * @version 1.0.0
 */
class FormController extends Controller
{
    /**
     * Displays the form.
     * @since 1.0.0
     */
    public function display()
    {
        // Get settings object
        $inquiry = apply_filters(
            'inquiry_object',
            Cache::remember( 'inquiry', 43200, function() {
                return InquirySettings::find();
            } )
        );
        wp_enqueue_script( 'inquiry' );
        // Check if styles should be enqueued
        if ( $inquiry->can_enqueue )
            wp_enqueue_style( 'inquiry' );
        return $this->view->get( 'plugins.inquiry.form', [
            'ajax'      => admin_url( 'admin-ajax.php' ),
            'inquiry'   => $inquiry,
        ] );
    }

    /**
     * Displays the form inputs.
     * @since 1.0.0
     *
     * @param object $inquiry Inquiry settings.
     */
    public function display_inputs( InquirySettings $inquiry )
    {
        $output = '';
        foreach ( $inquiry->inputs as $index => $input ) {
            switch ( $input['type'] ) {
                case 'text':
                    $output .= $this->view->get(
                        'plugins.inquiry.inputs.text',
                        [ 'index' => $index, 'input' => $input ]
                    );
                    break;
                case 'hidden':
                    $output .= $this->view->get(
                        'plugins.inquiry.inputs.hidden',
                        [ 'index' => $index, 'input' => $input ]
                    );
                    break;
                case 'checkbox':
                    $output .= $this->view->get(
                        'plugins.inquiry.inputs.checkbox',
                        [ 'index' => $index, 'input' => $input ]
                    );
                    break;
                case 'email':
                    $output .= $this->view->get(
                        'plugins.inquiry.inputs.email',
                        [ 'index' => $index, 'input' => $input ]
                    );
                    break;
                case 'textarea':
                    $output .= $this->view->get(
                        'plugins.inquiry.inputs.textarea',
                        [ 'index' => $index, 'input' => $input ]
                    );
                    break;
            }
        }
        return $output;
    }

    /**
     * Submits via ajax call.
     * @since 1.0.0
     * @since 1.1.0 Mailing engines returned message changed.
     */
    public function submit()
    {
        $output = [
            'error'     => false,
            'message'   => __( 'Inquiry sent.', 'inquiry' ),
        ];

        try {
            // Get inquity settings
            $settings = Cache::remember( 'inquiry', 43200, function() {
                return InquirySettings::find();
            } );

            // Perform required / empty validations
            // Prepare inputs.
            $errors = '';
            $inputs = Request::input( 'inputs', [] );
            foreach ( $settings->inputs as $index => $input ) {
                // Validations
                if ( $input['required']
                    && ( ! isset( $inputs[$index] ) || $inputs[$index] == '' )
                ) {
                    $errors .= sprintf(
                        __( '<div class="error"><strong>%s</strong> cannot be empty.</div>', 'inquiry' ),
                        $input['label']
                    );
                }
                if ( $input['type'] == 'email'
                    && ! empty( $inputs[$index] )
                    && ! filter_var( $inputs[$index], FILTER_VALIDATE_EMAIL )
                ) {
                    $errors .= sprintf(
                        __( '<div class="error"><strong>%s</strong> is an invalid email.</div>', 'inquiry' ),
                        $input['label']
                    );
                }
                // Filters
                if ( $input['filters'] && ! empty( $inputs[$index] ) ) {
                    $inputs[$index] = htmlspecialchars( preg_replace('/[^a-zA-Z0-9\'\.\;\,\:\!\?\_\-\+\*]/', ' ', $inputs[$index] ) );
                }
            }
            if ( ! empty( $errors ) )
                throw new RequiredException( $errors );

            // Save inquiry
            $inquiry = new Inquiry;

            $inquiry->title     = date( $settings->title_format );
            $inquiry->author    = get_option( Software::USER, 0 );
            $inquiry->viewed    = 0;

            foreach ( $settings->inputs as $index => $input ) {
                $inquiry->add(
                    $input,
                    isset( $inputs[$index] ) ? $inputs[$index] : null
                );
            }

            $inquiry->save();

            // Notify via email
            if ( $settings->is_notification_enabled
                && $settings->notification_email
                && $settings->notification_subject
            ) {
                switch ($settings->engine) {
                    case 'smtp':
                        $mail = new PHPMailer;
                        // Prepare
                        $mail->isSMTP();
                        $mail->Host = $settings->smtp_host;
                        $mail->SMTPAuth = $settings->smtp_auth == 1;
                        $mail->Username = $settings->smtp_username;
                        $mail->Password = $settings->smtp_raw_password;
                        if ( $settings->smtp_security && $settings->smtp_security !== '' )
                            $mail->SMTPSecure = $settings->smtp_security;
                        if ( $settings->smtp_port )
                            $mail->Port = $settings->smtp_port;
                        // Headers
                        $mail->setFrom( $settings->smtp_from, get_bloginfo( 'name' ) );
                        $mail->addAddress( $settings->notification_email );
                        $mail->isHTML(true);
                        // Email
                        $mail->Subject = $settings->notification_subject;
                        $mail->Body = $this->view->get(
                            'plugins.inquiry.emails.notification',
                            [ 'settings' => $settings, 'inquiry' => $inquiry ]
                        );
                        $mail->AltBody = strip_tags( $this->view->get(
                            'plugins.inquiry.emails.notification',
                            [ 'settings' => $settings, 'inquiry' => $inquiry ]
                        ) );
                        // Send
                        if($mail->send()) {
                            do_action( 'inquiry_sent', $inquiry );
                        } else {
                            Log::error( $mail->ErrorInfo );
                        }
                        break;
                    
                    default:
                        // Wordpress mail
                        wp_mail(
                            $settings->notification_email,
                            $settings->notification_subject,
                            $this->view->get(
                                'plugins.inquiry.emails.notification',
                                [ 'settings' => $settings, 'inquiry' => $inquiry ]
                            ),
                            apply_filters( 'inquiry_notification_headers', [
                                'Content-Type: text/html; charset=UTF-8',
                            ] )
                        );
                        break;
                }
            }

            // Creation hook
            do_action( 'inquiry_created', $inquiry );

        } catch (RequiredException $e) {
            $output = [
                'error'     => true,
                'message'   => $e->getMessage(),
            ];
        } catch (Exception $e) {
            Log::error($e);
            $output = [
                'error'     => true,
                'message'   => __( 'Oops! An internal error occurred.', 'inquiry' ),
            ];
        }

        header('Content-type: application/json');
        echo json_encode( $output );
        die;
    }
}