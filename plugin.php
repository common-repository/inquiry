<?php
/*

Plugin Name: Inquiry

Plugin URI: http://www.10quality.com

Description: Inquiry management for Wordpress. Lets you manage inquiries, quotes or any contact message like a pro. Inquiries are stored in your Wordpress setup and sent to you via email.

Version: 1.1.0

Author: 10Quality

Author URI: http://www.10quality.com

License: 10Quality IP License

Copyright (c) 2016 10Quality - http://www.10quality.com

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"),
the rights to use the software as a wordpress plugin; It is prohibited and therefore
limited the rights to modify, merge, publish, distribute, sublicense, and/or sell copies of the Software,
subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.
*/

//------------------------------------------------------------
//
// NOTE:
//
// Try NOT to add any code line in this file.
//
// Use "plugin\Main.php" to add your hooks.
//
//------------------------------------------------------------
require_once( plugin_dir_path( __FILE__ ) . 'boot/bootstrap.php' );

/**
 * Plugin functions.
 *
 * @author Alejandro Mostajo <http://about.me/amostajo>
 * @copyright 10Quality
 * @package Inquiry
 * @version 1.0.0
 */

if ( ! function_exists( 'inquiry' ) ) {
    /**
     * Returns inquiry plugin main class.
     * @since 1.0.0
     *
     * @return object
     */
    function inquiry()
    {
        global $inquiry;
        return $inquiry;
    }
}

if ( ! function_exists( 'the_inquiry_form' ) ) {
    /**
     * Displays the inquiry form.
     * Form generated with the "Form Generator" located in settings.
     * @since 1.0.0
     */
    function the_inquiry_form()
    {
        inquiry()->form();
    }
}

if ( ! function_exists( 'slugify' ) ) {
    /**
     * Slugifies a string.
     * @since 1.0.0
     *
     * @param string $string String to slugify
     *
     * @return string slugified
     */
    function slugify( $string )
    {
        $string = preg_replace( '~[^\pL\d]+~u', '-', $string );
        $string = iconv('utf-8', 'us-ascii//TRANSLIT', $string);
        $string = preg_replace( '~[^-\w]+~', '', $string );
        $string = trim( $string, '-' );
        $string = preg_replace( '~-+~', '-', $string );
        $string = strtolower( $string );

        if ( empty( $string ) ) {
            return 'n-a';
        }

        return $string;
    }
}