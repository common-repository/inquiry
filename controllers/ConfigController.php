<?php

namespace Inquiry\Controllers;

use Inquiry\Main as Software;
use Inquiry\Models\Inquiry;
use Amostajo\LightweightMVC\Controller;

/**
 * Handles plugin configuration.
 *
 * @author Alejandro Mostajo <http://about.me/amostajo>
 * @copyright 10Quality
 * @package Inquiry
 * @version 1.0.0
 */
class ConfigController extends Controller
{
    /**
     * Enqueues and registers scripts.
     * @since 1.0.0
     */
    public function enqueue()
    {
        wp_register_script(
            'inquiry',
            asset_url( '/../js/inquiry.js', __FILE__ ),
            [ 'jquery' ],
            '1.0.0',
            true
        );
        wp_register_style(
            'inquiry',
            asset_url( '/../css/inquiry.css', __FILE__ ),
            [],
            '1.0.0'
        );
    }

    /**
     * Inits admin.
     * @since 1.0.0
     *
     * @param object $plugin Main class object.
     */
    public function admin_start( $plugin )
    {
        // Setup
        switch ( get_option( '10q_inquiry_version', 0 ) ) {
            case 0:
                // Setups version 1.0.0
                $plugin->setup( 100 );
            default:
                break;
        }
    }

    /**
     * Inits plugin.
     * @since 1.0.0
     */
    public function start()
    {
        // Register new post type
        register_post_type(
            'inquiry',
            [
                'labels'                => [
                                            'name'               => __( 'Inquiries', 'inquiry' ),
                                            'singular_name'      => __( 'Inquiry', 'inquiry' ),
                                            'menu_name'          => __( 'Inquiries', 'inquiry' ),
                                            'name_admin_bar'     => _x( 'Inquiry', 'add new on admin bar', 'inquiry' ),
                                            'add_new'            => _x( 'Add New', 'inquiry', 'inquiry' ),
                                            'add_new_item'       => __( 'Add New Inquiry', 'inquiry' ),
                                            'new_item'           => __( 'New Inquiry', 'inquiry' ),
                                            'edit_item'          => __( 'Edit Inquiry', 'inquiry' ),
                                            'view_item'          => __( 'View Inquiry', 'inquiry' ),
                                            'all_items'          => __( 'All Inquiries', 'inquiry' ),
                                            'search_items'       => __( 'Search Inquiries', 'inquiry' ),
                                            'parent_item_colon'  => __( 'Parent Inquiries:', 'inquiry' ),
                                            'not_found'          => __( 'No Inquiries found.', 'inquiry' ),
                                            'not_found_in_trash' => __( 'No Inquiries found in Trash.', 'inquiry' )
                                        ],
                'description'           => __( 'Inquiries.', 'inquiry'  ),
                'public'                => false,
                'publicly_queryable'    => false,
                'show_ui'               => true,
                'show_in_menu'          => true,
                'query_var'             => '/?{query_var_string}={single_post_slug}',
                'rewrite'               => [ 'slug' => 'inquiries' ],
                'capabilities'          => [
                                            'edit_post'          => 'edit_inquiry', 
                                            'read_post'          => 'read_inquiry', 
                                            'delete_post'        => 'delete_inquiry', 
                                            'edit_posts'         => 'edit_inquiries', 
                                            'edit_others_posts'  => 'edit_others_inquiries', 
                                            'publish_posts'      => 'publish_inquiries',       
                                            'read_private_posts' => 'read_private_inquiries', 
                                            'create_posts'       => 'create_inquiries',
                                        ],
                'has_archive'           => false,
                'hierarchical'          => false,
                'menu_position'         => null,
                'supports'              => [ 'title' ],
                'menu_icon'             => asset_url( '/../img/favicon.png', __FILE__ ),
                'register_meta_box_cb'  => [ &$this, 'register_metabox_addon' ]
            ]
        );
    }

    /**
     * Registers metabox for addons.
     * @since 1.0.0
     */
    public function register_metabox_addon()
    {
        add_meta_box(
            'inquiry_data',
            __( 'Data', 'inquiry' ),
            [ &$this, 'metabox_data' ],
            'inquiry'
        );
    }

    /**
     * Displays the addon metabox.
     * @since 1.0.0
     *
     * @param object $post WP_Post.
     */
    public function metabox_data( $post )
    {
        do_action( 'inquiry_before_data' );

        $inquiry = Inquiry::find( $post->ID );

        // Set viewed flag.
        if ( !$inquiry->viewed ) {
            $inquiry->viewed = 1;
            $inquiry->save();
        }

        echo apply_filters(
            'inquiry',
            $inquiry->html,
            $inquiry
        );

        do_action( 'inquiry_after_data' );
    }

    /**
     * Called when plugins are loaded.
     * @since 1.0.0
     */
    public function loaded()
    {
        load_plugin_textdomain(
            'inquiry',
            false,
            dirname( plugin_basename( __FILE__ ) ) . '/../lang/'
        );
    }
}