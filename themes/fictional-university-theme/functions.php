<?php 
    function university_files() {
        //load files here
        wp_enqueue_style('university_main_styles', get_stylesheet_uri());
    }

    //before everything is loaded into the page, call this function
    add_action('wp_enqueue_scripts', 'university_files');
?>