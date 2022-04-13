<?php 

    // Iterating through posts
    while(have_posts()) {
        the_post(); ?>
        <h1>This is a page Not a POST</h1>
        <h2>
            <?php the_title();?>
        </h2>
        <?php the_content(); ?>
        <hr>
    <?php }
?>