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
                    <a class="metabox__blog-home-link" href="<?php echo get_post_type_archive_link('event');?>"><i class="fa fa-home" aria-hidden="true"></i> Events Home</a> <span class="metabox__main"><?php the_title() ?></span>
                </p>
            </div>
            <div class="generic-content">
                <?php 
                    the_content();
                ?>
            </div>
            <!-- Output Possible Related Programs to Events -->
            <?php 
            
                $relatedPrograms = get_field('related_programs');

                if($relatedPrograms) {
                    //the field returns an array
                    //print_r($relatedPrograms);
                    echo '<hr class="section-break">';
                    echo '<h2 class="headline headline--medium">Related Program(s)</h2>';
                    echo '<ul class="link-list min-list">';
                    //use a foreach loop to iterate through the array and output
                    //info that we deem necessary
                    foreach($relatedPrograms as $program) {
                        ?>
                        <li><a href="<?php echo get_the_permalink($program)?>"><?php echo get_the_title($program);?></a></li>
                        <?php
                    }
                    echo '</ul>';
                }
            ?>
        </div>
    <?php }

    get_footer();
?>
