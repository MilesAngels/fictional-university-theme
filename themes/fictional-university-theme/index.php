<?php 
  
  get_header();?>
  <!-- Banner -->
  <div class="page-banner">
      <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri('./images/ocean.jpg')?>)"></div>
      <div class="page-banner__content container container--narrow">
        <h1 class="page-banner__title">Welcome to our blog!</h1>
        <div class="page-banner__intro">
          <p>Keep up with our latest news!</p>
        </div>
      </div>
  </div>
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
    ?>
  </div>

<?php get_footer();

?>