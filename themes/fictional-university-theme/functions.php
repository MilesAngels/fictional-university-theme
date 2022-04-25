<?php 
    function pageBanner($args = NULL) {//$args = NULL will make the arguments optional
        //php logic will live here
        if(!$args['title']) {
            $args['title'] = get_the_title();
        }
        if(!$args['subtitle']){
            $args['subtitle'] = get_field('page_banner_title');
        }
        if(!$args['photo']) {
            if(get_field('page_banner_background_image')  AND !is_archive() AND !is_home()){
                $args['photo'] = get_field('page_banner_background_image')['sizes']['pageBanner'];
            }
            else {
                $args['photo'] = get_theme_file_uri('/images/ocean.jpg');
            }
        }
        ?>
        <div class="page-banner">
            <div class="page-banner__bg-image" style="background-image: url(<?php 
            //dynamic banner image using custom fields
                echo $args['photo'];
            ?>)"></div>
                <div class="page-banner__content container container--narrow">
                    <h1 class="page-banner__title"><?php echo $args['title']; ?></h1>
                        <div class="page-banner__intro">
                            <p><?php echo $args['subtitle'] ?></p>
                        </div>
                </div>
        </div>
<?php
    }

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

        //adding thumbnails for professors
        add_theme_support('post-thumbnails');

        /* adding specific sizes to images */
        //first argument is the name you want to give the image
        //second argument is width and third is height
        //fourth argument is whether you want to crop the image
        add_image_size('professorLandscape', 400, 260, true);
        add_image_size('professorPortrait', 480, 650, true);

        /* Adding Width of Image Banner */
        add_image_size('pageBanner', 1500, 350, true);
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