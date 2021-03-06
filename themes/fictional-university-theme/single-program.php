<?php 

    get_header();
    pageBanner();    
    // Iterating through posts
    while(have_posts()) {
        the_post(); ?>
        
        <!--  -->
        <div class="container container--narrow page-section">
            <!--metabox goes here-->
            <div class="metabox metabox--position-up metabox--with-home-link">
                <p>
                    <a class="metabox__blog-home-link" href="<?php echo get_post_type_archive_link('program');?>"><i class="fa fa-home" aria-hidden="true"></i> All Programs</a> <span class="metabox__main"><?php the_title() ?></span>
                </p>
            </div>
            <div class="generic-content">
                <?php 
                    the_content();
                ?>
            </div>

            <!-- custom query -->
            <?php 
            $relatedProfessors = new WP_Query(array(
                'posts_per_page' => -1,
                'post_type' => 'professor',
                'orderby' => 'title',
                'order' => 'ASC',
                //filter: only return events that are currently going on or later
                'meta_query' => array(
                    array(
                        'key' => 'related_programs',
                        'compare' => 'LIKE',
                        //we only want specific results
                        'value' => '"' . get_the_ID() . '"'
                    )
                )
            ));
            
            if ($relatedProfessors->have_posts()) {
                echo '<hr class="section-break">';
                echo '<h2 class="headline headline--medium"> ' . get_the_title() . ' Events</h2>';
                //displaying the post
                echo '<ul class="professor-cards">';
                while($relatedProfessors -> have_posts()) {
                    $relatedProfessors -> the_post(); ?>
                    <li class="professor-card__list-item">
                        <a class="professor-card" href="<?php the_permalink();?>">
                          <img class="professor-card__image" src="<?php the_post_thumbnail_url('professorLandscape');?>">
                          <span class="professor-card__name"><?php the_title(); ?></span>
                        </a>
                    </li>
                <?php }
                echo '</ul>';
            }

            // call this function to reset the global data 
            // and to make query for future events to be
            // outputed to the page
            wp_reset_postdata();


                //query for current and future events
                $today = date('Ymd');
                $homepageEvents = new WP_Query(array(
                    'posts_per_page' => 2,
                    'post_type' => 'event',
                    //order by custom field of even date
                    'meta_key' => 'event_date',
                    'orderby' => 'meta_value_num',
                    //filter: only return events that are currently going on or later
                    'meta_query' => array(
                        array(
                        'key' => 'event_date',
                        'compare' => '>=',
                        'value' => $today,
                        'type' => 'numeric'
                        ),
                        array(
                            'key' => 'related_programs',
                            'compare' => 'LIKE',
                            //we only want specific results
                            'value' => '"' . get_the_ID() . '"'
                        )
                    ),
                    'order' => 'ASC'
                ));
                
                if ($homepageEvents->have_posts()) {
                    echo '<hr class="section-break">';
                    echo '<h2 class="headline headline--medium">Upcoming ' . get_the_title() . ' Events</h2>';
                    //displaying the post
                    while($homepageEvents -> have_posts()) {
                        $homepageEvents -> the_post();
                        get_template_part('template-parts/content', 'event');
                    }
                }
                ?>
        </div>
    <?php }

    get_footer();
?>
