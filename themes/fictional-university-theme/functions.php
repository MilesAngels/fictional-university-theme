<?php 
    function university_files() {
        //load files here
        wp_enqueue_style('university_main_styles', get_stylesheet_uri());
    }

    add_action('wp_enqueue_scripts', 'university_files');
?>