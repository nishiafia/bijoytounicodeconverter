<?php
/**
* ASCII to UNICODE (ONCLICK-CONVERTER)
* Code by: Tahmina Aktar
* Assistance from: Unicode Converter of S. M. Mahbub Morshed
* Source: http://bnwebtools.sourceforge.net/
*/

add_action('admin_enqueue_scripts', 'scripts_for_converter');   

function scripts_for_converter() {

    wp_register_script('common-scripts', get_template_directory_uri() . '/js/common-scripts.js', array('jquery'));
    wp_register_script('converter-scripts', get_template_directory_uri() . '/js/converter-scripts.js', array('jquery'));
    wp_register_script('custom-scripts', get_template_directory_uri() . '/js/custom-scripts.js', array('jquery'));

    $this_screen = get_current_screen();
    if( $this_screen->id == 'post' || $this_screen->id == 'page' ) {
        wp_enqueue_script('common-scripts');
        wp_enqueue_script('converter-scripts');
        wp_enqueue_script('custom-scripts');
    }

}



add_action( 'admin_enqueue_scripts', 'styles_for_converter' );

function styles_for_converter(){

    wp_register_style( 'admin-style', get_template_directory_uri() . '/style.css', '', '', 'screen' );

    wp_enqueue_style( 'admin-style' ); // stylesheet for admin panel
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
    global $post;
    echo '<div class="my_meta_control">';
        echo '<p>';
            echo '<img src="'. get_template_directory_uri() . '/images/select-text-mode.gif" alt="Get to Text mode"/>';
            echo __( 'এই কনভার্টারটি কাজ করে যখন আপনি আপনার এডিটরটিকে <strong>Text</strong> মোডে নিয়ে যাবেন। আগে Text মোডে গিয়ে লেখা পেস্ট করুন, তারপর কনভার্ট হয়ে যাবার পর আপনি আবার Visual মোডে ফেরত আসতে পারেন।', TEXTDOMAIN );
            echo '<div class="clearfix"></div>';
            echo '<input type="button" class="metabox_submit button button-primary button-large" value="'. __('বদলে নাও', TEXTDOMAIN) .'" onclick="converttext()" />';
        echo '</p>';
    echo '</div>';
    echo '<input type="hidden" name="my_meta_noncename" value="' . wp_create_nonce(__FILE__) . '" />';
}

// Filter will disable the editor by default

//add_filter( 'user_can_richedit' , '__return_false', 50 );
