<?php 
    get_header();
    // Iterating through posts
    while(have_posts()) {
        the_post(); ?>
        
        <div class="page-banner">
      <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri('./images/ocean.jpg')?>)"></div>
      <div class="page-banner__content container container--narrow">
        <h1 class="page-banner__title"><?php the_title(); ?></h1>
        <div class="page-banner__intro">
          <p>DON'T FORGET TO REPLACE ME LATER</p>
        </div>
      </div>
    </div>

    <div class="container container--narrow page-section">
        <!-- Breadcrumb box -->
        <?php 
        // if the page is a child page, then add breadcrumb box
            $theParent = wp_get_post_parent_id(get_the_ID());
            if($theParent) {?>
                <div class="metabox metabox--position-up metabox--with-home-link">
                    <p>
                        <a class="metabox__blog-home-link" href="<?php echo get_permalink($theParent);?>"><i class="fa fa-home" aria-hidden="true"></i> Back to <?php echo get_the_title($theParent); ?></a> <span class="metabox__main"><?php the_title();?></span>
                    </p>
                </div>
            <?php }
        ?>
        
    <!-- Sidebar Menu -->
    <?php 
    // gets all the child pages of the current parent page if it has any
    // if it does not then it wil return NULL
    $testArray = get_pages(array(
        'child_of' => get_the_ID()
    ));

    // if the page is parent page or has a parent page
    // then this statement will return true and add the sidebar menu
    if ($theParent or $testArray) { ?>
      <div class="page-links">
        <h2 class="page-links__title"><a href="<?php echo get_permalink();?>"><?php echo get_the_title($theParent);?></a></h2>
        <ul class="min-list">
          <?php 
          //if the page is a child page, then display the menu
          if ($theParent) {
            $findChildrenOf = $theParent;
          }
          else {
              $findChildrenOf = get_the_ID();
          }

          //list all children page in a parent page
            wp_list_pages(array(
                //remove the title
                'title_li' => NULL,
                //only grabs the children pages by using their IDs
                'child_of' => $findChildrenOf,
                //custom sorting of menu items
                'sort_column' => 'menu_order'
            ));
          ?>
        </ul>
      </div>
    <?php } ?>

      <div class="generic-content">
        <?php the_content(); ?>
      </div>
    </div>


    <?php }

    get_footer();
?>