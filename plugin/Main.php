<?php

namespace Inquiry;

use Amostajo\WPPluginCore\Plugin;

/**
 * Main Class. Wordpress Bridge.
 *
 * @link http://wordpress-dev.evopiru.com/documentation/main-class/
 * @author Alejandro Mostajo <http://about.me/amostajo>
 * @copyright 10Quality
 * @package Inquiry
 * @version 1.0.0
 */
class Main extends Plugin
{
    /**
     * Software version.
     * @since 1.0.0
     * @var string 
     */
    const VERSION = 100;

    /**
     * Administrator role.
     * @since 1.0.0
     * @var string 
     */
    const ROLE_ADMIN = 'administrator';

    /**
     * Inquiry generator role.
     * @since 1.0.0
     * @var string 
     */
    const ROLE_GENERATOR = 'inquiry_generator';

    /**
     * Inquiry user.
     * @since 1.0.0
     * @var string 
     */
    const USER = 'user_inquiry_generator';

    /**
     * Admin menu settings key.
     * @since 1.0.0
     * @var string
     */
    const ADMIN_MENU_SETTINGS = 'inquiry-settings';

    /**
     * Public hooks.
     * @since 1.0.0
     */
    public function init()
    {
        $this->add_action( 'init', 'ConfigController@start' );
        $this->add_action( 'wp_enqueue_scripts', 'ConfigController@enqueue' );
        $this->add_action( 'wp_ajax_inquiry_form_builder', 'AdminController@ajax_form_builder' );
        $this->add_action( 'wp_ajax_inquiry_submit', 'FormController@submit' );
        $this->add_action( 'wp_ajax_nopriv_inquiry_submit', 'FormController@submit' );
        $this->add_widget( 'InquiryFormWidget' );
        $this->add_shortcode( 'inquiry_form', 'FormController@display' );
        $this->add_action( 'plugins_loaded', 'ConfigController@loaded' );
    }

    /**
     * Admin hooks.
     * @since 1.0.0
     */
    public function on_admin()
    {
        $this->add_action( 'admin_init', 'ConfigController@admin_start', [ $this ] );
        $this->add_action( 'admin_menu', 'AdminController@menu' );
        $this->add_action( 'admin_enqueue_scripts', 'AdminController@enqueue' );
        $this->add_filter( 'manage_posts_columns' , 'InquiryController@add_columns', 10 );
        $this->add_action( 'manage_posts_custom_column' , 'InquiryController@manage_columns', 10, 2 );
    }

    /**
     * Setups version software.
     * @since 1.0.0
     *
     * @param int $version Software version to setup.
     */
    public function setup( $version )
    {
        $this->mvc->call( 'SetupController@setup', $version );
    }

    /**
     * Displays the inquiry form.
     * Form generated with the "Form Generator" located in settings.
     * @since 1.0.0
     */
    public function form()
    {
        $this->mvc->call( 'FormController@display' );
    }

    /**
     * Displays the inquiry inputs.
     * Form generated with the "Form Generator" located in settings.
     * @since 1.0.0
     */
    public function inputs( $inquiry )
    {
        $this->mvc->call( 'FormController@display_inputs', $inquiry );
    }

    /**
     * Returns view with the parameters passed by.
     * @since 1.0
     *
     * @param string $view   Name and location of the view within "theme/views" path.
     * @param array  $params View parameters passed by.
     *
     * @return string
     */
    public function get_view( $view, $params = array() )
    {
        return $this->mvc->view->get( $view, $params );
    }
}