<?php
add_action('wp_enqueue_scripts', function() {
    # insert css and javascript
    wp_enqueue_style('theme-css', get_template_directory_uri() . '/dist/index.css');
    wp_enqueue_script('theme-js', get_template_directory_uri() . '/dist/index.js', array(), null, true);
    # insert javascript variable with theme directory uri
    wp_localize_script('theme-js', 'wpParams', array('templateDir' => get_template_directory_uri()));
});
?>
