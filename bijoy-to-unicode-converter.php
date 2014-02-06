<?php
/**
 * Plugin Name: WordPress Bijoy to Unicode Converter
 * Plugin URI: http://nanodesignsbd.com
 * Description: A one-click ASCII to Unicode converter that can convert Bijoy (ASCII) texts into Unicode Bangla. It can covert Bijoy ASCII texts into Unicode with a single click in WordPress post or page editor - in Text mode. The basic of the plugin was done by <a href="https://github.com/nishiafia">Ms. Tahmina Aktar</a> on the Javascripts of Online Unicode Converter by <a href="http://bnwebtools.sourceforge.net/">S. M. Mahbub Morshed</a>. Then it's verified, modified, simplified, and made translation-ready by <a href="https://github.com/mayeenulislam">Mayeenul Islam</a> from <a href="http://nanodesignsbd.com">nanodesigns</a>.
 * Version: 1.0
 * Author: Tahmina Aktar, Mayeenul Islam (@mayeenulislam)
 * Author URI: http://nanodesignsbd.com
 * License: GNU General Public License v2.0
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 */


/*  Copyright 2014  nanodesigns  (email : info@nanodesignsbd.com)

    This plugin is a free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as
    published by the Free Software Foundation.

    This plugin is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

/**
* COMMON PROPERTIES
*/
define( "B2UCTEXTDOMAIN", "'b2uc'" );
$plugin_folder = 'bijoy-to-unicode-converter';


add_action('admin_enqueue_scripts', 'scripts_for_converter');   

function scripts_for_converter() {
    global $plugin_folder;

    wp_register_script('common-scripts', plugins_url('js/common-scripts.js', __FILE__) );
    wp_register_script('converter-scripts', plugins_url('js/converter-scripts.js', __FILE__) );
    wp_register_script('custom-scripts', plugins_url('js/custom-scripts.js', __FILE__) );

    wp_register_style( 'converter-style', plugins_url('style.css', __FILE__) );

    $this_screen = get_current_screen();
    if( $this_screen->id == 'post' || $this_screen->id == 'page' ) {
        wp_enqueue_script('common-scripts');
        wp_enqueue_script('converter-scripts');
        wp_enqueue_script('custom-scripts');

        wp_enqueue_style( 'converter-style' );
    }

}


// Add the Meta Box to the Right site of the Add New page

add_action('admin_init','my_meta_init');
 
function my_meta_init() { 

    $screens = array( 'post', 'page' );

    foreach ( $screens as $screen) {
        add_meta_box(
            'my_all_meta',
            'ইউনিকোড কনভার্টার',
            'my_meta_setup',
            $screen,
            'side',
            'high'
            );
    }
}


// Put the converter in action

function my_meta_setup() {
    global $post, $plugin_folder;

    echo '<div class="my_meta_control">';
        echo '<p>';
            echo '<img src="'. plugins_url('images/select-text-mode.gif', __FILE__)  .'" alt="Get to Text mode"/>';
            echo __( 'এই কনভার্টারটি কাজ করে যখন আপনি আপনার এডিটরটিকে <strong>Text</strong> মোডে নিয়ে যাবেন। আগে Text মোডে গিয়ে লেখা পেস্ট করুন, তারপর কনভার্ট হয়ে যাবার পর আপনি আবার Visual মোডে ফেরত আসতে পারেন।', B2UCTEXTDOMAIN );
            echo '<div class="clearfix"></div>';
            echo '<input type="button" class="metabox_submit button button-primary button-large" value="'. __('বদলে নাও', B2UCTEXTDOMAIN) .'" onclick="converttext()" />';
        echo '</p>';
    echo '</div>';
    echo '<input type="hidden" name="my_meta_noncename" value="' . wp_create_nonce(__FILE__) . '" />';
}

// Filter will disable the editor by default

//add_filter( 'user_can_richedit' , '__return_false', 50 );
