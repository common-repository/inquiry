<?php
/**
 * Inquiry Widget.
 *
 * @link http://wordpress-dev.evopiru.com/documentation/main-class/
 * @author Alejandro Mostajo <http://about.me/amostajo>
 * @copyright 10Quality
 * @package Inquiry
 * @version 1.0.0
 */
class InquiryFormWidget extends WP_Widget
{
    /**
     * Constructor.
     * @since 1.0.0
     */
    public function __construct( $id = '', $name = '', $args = array() )
    {
        parent::__construct(
            'inquiry-widget',
            __( 'Inquiry Form', 'inquiry' ),
            [
                'classname'     => 'InquiryFormWidget',
                'description'   => __( 'Displays form generated with Inquiry\'s "Form Builder".', 'inquiry' ),
            ]
        );
    }

    /**
     * Widget display functionality.
     * @since 1.0.0
     *
     * @param array $args     Arguments for the theme.
     * @param class $instance Parameters.
     */
    public function widget( $args, $instance )
    {
        echo $args['before_widget'];
        the_inquiry_form();
        echo $args['after_widget'];
    }
}