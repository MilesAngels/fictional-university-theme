<?php 
    function university_files() {
        //load files here
        wp_enqueue_script('main-university-js', get_theme_file_uri('./build/index.js'), array('jquery'), '1.0', true);
        wp_enqueue_style('google-fonts', '//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');
        wp_enqueue_style('font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
        wp_enqueue_style('university_main_styles', get_theme_file_uri('./build/style-index.css'));
        wp_enqueue_style('university_extra_styles', get_theme_file_uri('./build/index.css'));
    }

    //before everything is loaded into the page, call this function
    add_action('wp_enqueue_scripts', 'university_files');

    function university_features() {
        //add nav menu that will be accessible in the Admin dashboard
        //register_nav_menu('headerMenuLocation', "Header Menu Location");
        //register_nav_menu('footerLocationOne', "Footer Location One");
        //register_nav_menu('footerLocationTwo', "Footer Location Two");
        add_theme_support('title-tag');
    }

    add_action('after_setup_theme', 'university_features');


    function university_post_types() {
        //used to create a new post type
        register_post_type('event', array(
            //this outputs the events post type in the WP dashboard
            'public' => true,
            //this changes the label of the post type from 'Posts' to 'Events'
            'labels' => array(
                'name' => 'Events'
            ),
            //changing the icon in the WP dashboard
            'menu_icon' => 'dashicons-buddicons-groups'
        ));
    }

    add_action('init', 'university_post_types');
?>