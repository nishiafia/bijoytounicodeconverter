<?php
// Edit By Tahmina Akter


add_action('admin_enqueue_scripts', 'custom_common_scripts');	
function custom_common_scripts() {
wp_register_script('common-scripts', get_template_directory_uri() . '/js/common-scripts.js', array('jquery'));

//if ( is_admin() ) {
wp_enqueue_script('common-scripts');
//}

wp_register_script('converter-scripts', get_template_directory_uri() . '/js/converter-scripts.js', array('jquery'));

//if ( is_admin() ) {
wp_enqueue_script('converter-scripts');
wp_register_script('custom-scripts', get_template_directory_uri() . '/js/custom-scripts.js', array('jquery'));

//if ( is_admin() ) {
wp_enqueue_script('custom-scripts');
//}

}

add_action('admin_init','my_meta_init');
 
function my_meta_init()
{
   
    //wp_enqueue_style('my_meta_css', get_template_directory_uri() . '/css/meta.css');
 

    foreach (array('post') as $type)
    {
        add_meta_box('my_all_meta', 'ASCII to Unicode Conversion', 'my_meta_setup', $type, 'side', 'high');
    }
    
   
    
}
 
function my_meta_setup()
{
    global $post; 

    ?><div class="my_meta_control"><p><input type="button" class="metabox_submit" value="Convert" onclick="converttext()" /></p></div><?php
 
   
    echo '<input type="hidden" name="my_meta_noncename" value="' . wp_create_nonce(__FILE__) . '" />';
}

add_filter( 'user_can_richedit' , '__return_false', 50 );
