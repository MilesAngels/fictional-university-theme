<?php 
  
  get_header();
  //banner
  pageBanner(array(
    'title' => 'All Programs',
    'subtitle' => 'There is something for everyone. Have a look around.'
  ));
  ?>

  <!-- Blog Post -->
  <div class="container container--narrow page-section">
    <ul class="link-list min-list">
        <?php 
        while(have_posts()) {
            the_post();?>
            <!-- Posts -->
            <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
        <?php }
        echo paginate_links();
        ?>
    </ul>
  </div>

<?php get_footer();

?>