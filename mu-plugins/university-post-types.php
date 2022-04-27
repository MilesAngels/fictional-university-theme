<?php

    function university_post_types() {
        //used to create a new campus post type
        register_post_type('campus', array(
            //this will give us the option of creating an excerpt for the campuses
            'supports' => array('title', 'editor', 'excerpt', 'custom-fields'),
            //this will rewrite the slug or url to be campuses
            'rewrite' => array('slug' => 'campuses'),
            'has_archive' => true,
            //this outputs the campus post type in the WP dashboard
            'public' => true,
            'show_in_rest' => true,
            //this changes the label of the post type from 'Posts' to 'Campuses'
            'labels' => array(
                'name' => 'Campuses',
                'add_new' => 'Add New Campus',
                'edit_item' => 'Edit Campus',
                'all_items' => 'All Campuses',
                'singular_name' => 'Campus'
            ),
            //changing the icon in the WP dashboard
            'menu_icon' => 'dashicons-location-alt'
            
        ));

        //used to create a new event post type
        register_post_type('event', array(
            //this will give us the option of creating an excerpt for the events
            'supports' => array('title', 'editor', 'excerpt', 'custom-fields'),
            //this will rewrite the slug or url to be events
            'rewrite' => array('slug' => 'events'),
            'has_archive' => true,
            //this outputs the events post type in the WP dashboard
            'public' => true,
            'show_in_rest' => true,
            //this changes the label of the post type from 'Posts' to 'Events'
            'labels' => array(
                'name' => 'Events',
                'add_new' => 'Add New Event',
                'edit_item' => 'Edit Event',
                'all_items' => 'All Events',
                'singular_name' => 'Event'
            ),
            //changing the icon in the WP dashboard
            'menu_icon' => 'dashicons-buddicons-groups'
            
        ));

        //Program post type
        //used to create a new post type
        register_post_type('program', array(
            
            'supports' => array('title', 'editor'),
            //this will rewrite the slug or url to be program
            'rewrite' => array('slug' => 'programs'),
            'has_archive' => true,
            //this outputs the events post type in the WP dashboard
            'public' => true,
            'show_in_rest' => true,
            //this changes the label of the post type from 'Posts' to 'Events'
            'labels' => array(
                'name' => 'Programs',
                'add_new' => 'Add New Program',
                'edit_item' => 'Edit Programs',
                'all_items' => 'All Programs',
                'singular_name' => 'Program'
            ),
            //changing the icon in the WP dashboard
            'menu_icon' => 'dashicons-clipboard'
            
        ));

        //Professor post type
        register_post_type('professor', array(
            //we need the thumbnail parameter so we can add a thumbnail for each professor
            'supports' => array('title', 'editor', 'thumbnail'),
            //this outputs the events post type in the WP dashboard
            'public' => true,
            'show_in_rest' => true,
            //this changes the label of the post type from 'Posts' to 'Events'
            'labels' => array(
                'name' => 'Professors',
                'add_new' => 'Add New Professor',
                'edit_item' => 'Edit Professors',
                'all_items' => 'All Professors',
                'singular_name' => 'Professor'
            ),
            //changing the icon in the WP dashboard
            'menu_icon' => 'dashicons-id'
            
        ));
    }

    add_action('init', 'university_post_types');
?>