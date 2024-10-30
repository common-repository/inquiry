<?php

namespace Inquiry\Controllers;

use WP_User;
use Inquiry\Main as Software;
use Inquiry\Models\Inquiry;
use Amostajo\LightweightMVC\Controller;

/**
 * Handles setup configuration.
 *
 * @author Alejandro Mostajo <http://about.me/amostajo>
 * @copyright 10Quality
 * @package Inquiry
 * @version 1.0.0
 */
class SetupController extends Controller
{
    /**
     * Setup handler function.
     * @since 1.0.0
     *
     * @param int $version Software version to setup.
     */
    public function setup( $version )
    {
        switch ( $version ) {
            case 100:
                $this->v100_roles()
                    ->v100_users()
                    ->v100_capabilities();
                break;
        }

        // Update options table
        update_option( '10q_inquiry_version', Software::VERSION );
    }

    /**
     * Roles setup
     * For software version 1.0.0
     * @since 1.0.0
     *
     * @return object This for chaining.
     */
    private function v100_roles()
    {
        add_role(
            Software::ROLE_GENERATOR,
            __( 'Inquiry Generator', 'inquiry' ),
            [
                'read'              => true,
                'edit_posts'        => false,
                'delete_posts'      => false,
            ]
        );

        return $this;
    }

    /**
     * Users setup
     * For software version 1.0.0
     * @since 1.0.0
     *
     * @return object This for chaining.
     */
    private function v100_users()
    {
        if ( ! username_exists( Software::USER ) ) {
            $user_id = wp_create_user(
                Software::USER,
                wp_generate_password( 12, false ),
                'inquiry-generator@10quality.com'
            );
            if ( ! empty( $user_id ) ) {
                update_option( Software::USER, $user_id );
            }
            // Add role
            $user = new WP_User( $user_id );
            $user->add_role( Software::ROLE_GENERATOR );
        }

        return $this;
    }

    /**
     * Capabilities setup
     * For software version 1.0.0
     * @since 1.0.0
     *
     * @return object This for chaining.
     */
    private function v100_capabilities()
    {
        // ADMIN
        $role = get_role( Software::ROLE_ADMIN );
        $role->add_cap( 'edit_inquiry' );
        $role->add_cap( 'read_inquiry' );
        $role->add_cap( 'delete_inquiry' );
        $role->add_cap( 'edit_inquiries' );
        $role->add_cap( 'read_private_inquiries' );

        // Generator
        $role = get_role( Software::ROLE_GENERATOR );
        $role->add_cap( 'edit_inquiry' );
        $role->add_cap( 'delete_inquiry' );
        $role->add_cap( 'edit_inquiries' );
        $role->add_cap( 'create_inquiries' );
        $role->add_cap( 'publish_inquiries' );

        return $this;
    }
}