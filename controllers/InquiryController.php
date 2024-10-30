<?php

namespace Inquiry\Controllers;

use Inquiry\Models\Inquiry;
use Amostajo\LightweightMVC\Controller;
use Amostajo\WPPluginCore\Cache;

/**
 * Handles Inquiry methods.
 *
 * @author Alejandro Mostajo <http://about.me/amostajo>
 * @copyright 10Quality
 * @package Inquiry
 * @version 1.0.0
 */
class InquiryController extends Controller
{
    /**
     * Add custom columns when managing posts.
     * @since 1.0.0
     *
     * @param array $columns Current columns
     *
     * @return array
     */
    public function add_columns( $columns )
    {
        if ( get_current_screen()->post_type == 'inquiry' ) {
            wp_enqueue_style( 'inquiry-admin' );
            // Rearrenge and insert
            $new = [];
            foreach ( $columns as $key => $value ) {
                $new[$key] = $value;
                if ( $key == 'title' ) {
                    $new[$key]      = __( 'Inquiry', 'inquiry' );
                    $new['insight'] = __( 'Insight', 'inquiry' );
                }
            }
            return $new;
        }
        return $columns;
    }

    /**
     * Manages custom columns when managing posts.
     * @since 1.0.0
     *
     * @param string $column  Column key.
     * @param int    $post_id Post ID.
     *
     * @return string
     */
    public function manage_columns( $column, $post_id )
    {
        if ( get_current_screen()->post_type == 'inquiry' ) {
            if ( empty( $post_id ) )
                $post_id = get_the_ID();
            if ( empty( $post_id ) )
                return;

            $inquiry = Cache::remember(
                'inquiry_' . $post_id,
                43200,
                function() use( &$post_id ) {
                    return Inquiry::find( $post_id );
                }
            );
            switch ( $column ) {
                case 'insight':
                    return $this->view->get( 'plugins.inquiry.admin.columns.insight', [
                            'inquiry' => $inquiry,
                        ] );
            }
        }
    }
}