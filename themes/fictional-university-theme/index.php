<?php 

    // $names = array('Brad', 'John', 'Myuu', 'Harry');

    // $count = 0;
    // while($count < count($names)) {
    //     echo "<li>Hi my name is $names[$count]</li>";
    //     $count++;
    // }

    // Iterating through posts
    while(have_posts()) {
        the_post(); ?>
        <h2><a href="<?php the_permalink() ?>"><?php the_title();?></a></h2>
        <?php the_content(); ?>
        <hr>
    <?php }
?>
