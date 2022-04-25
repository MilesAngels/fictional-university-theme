<?php 
  
  get_header();
  //banner
  pageBanner(array(
    'title' => 'Welcome to our Blog!',
    'subtitle' => 'keep up with the latest news.'
  ));
  ?>
  <!-- Blog Post -->
  <div class="container container--narrow page-section">
    <?php 
      while(have_posts()) {
        the_post();?>
        <!-- Posts -->
        <div class="post-item">
          <h2 class="headline headline--medium headline--post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
          <!-- Author -->
          <div class="metabox">
            <p>Posted by <?php the_author_posts_link(); ?> on <?php the_time('n.j.y');?> in <?php echo get_the_category_list(', ');?></p>
          </div>
          <!-- Content -->
          <div class="generic-content">
            <!-- this function only grabs a portion of the content in a blog post -->
            <?php the_excerpt(); ?>
            <p><a class="btn btn--blue" href="<?php the_permalink(); ?>">Continue reading &raquo;</a></p>
          </div>
        </div>
      <?php }
      echo paginate_links();
    ?>
  </div>

<?php get_footer();

?>