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

    function university_adjust_queries($query) {
        //this will only work when you are not in the admin
        //this will only work when the post type is event
        // it will also not interfere with other queries
        if (!is_admin() AND is_post_type_archive('program') AND $query->is_main_query()){
            //filters
            $query->set('orderby', 'title');
            $query->set('order', 'ASC');
            $query->set('posts_per_page', -1);
        }
        //this will only work when you are not in the admin
        //this will only work when the post type is event
        // it will also not interfere with other queries
        if(!is_admin() AND is_post_type_archive('event') AND $query->is_main_query()){
            $today = date('Ymd');
            $query -> set('meta-key', 'event_date');
            $query -> set('orderby', 'meta_value_num');
            $query -> set('order', 'ASC');
            $query -> set('meta_query', array(
                array(
                  'key' => 'event_date',
                  'compare' => '>=',
                  'value' => $today,
                  'type' => 'numeric'
                )
            ));
        }
    }

    //right before we get the post query
    add_action('pre_get_posts', 'university_adjust_queries');
?>