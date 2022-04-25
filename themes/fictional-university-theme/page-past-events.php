<?php 
  
  get_header();
  //banner
  pageBanner(array(
    'title' => 'Past Events',
    'subtitle' => 'A recap of our past events.'
  ));
  ?>

  <!-- Blog Post -->
  <div class="container container--narrow page-section">
    <?php 
      $today = date('Ymd');
      $pastEvents = new WP_Query(array(
        //diaplay past events dynamically using pagination
        'paged' => get_query_var('paged', 1),
        'post_type' => 'event',
        //order by custom field of event date
        'meta_key' => 'event_date',
        'orderby' => 'meta_value_num',
        //filter: only return events that are in the past
        'meta_query' => array(
            array(
              'key' => 'event_date',
              'compare' => '<',
              'value' => $today,
              'type' => 'numeric'
            )
        ),
        'order' => 'ASC'
      ));

      while($pastEvents -> have_posts()) {
        $pastEvents -> the_post();
        get_template_part('template-parts/content', 'event');
      }
      //to make this pagination to work, we need to give it an argument which is our custom query
      echo paginate_links(array(
        'total' => $pastEvents -> max_num_pages
      ));
    ?>
  </div>

<?php get_footer();

?>