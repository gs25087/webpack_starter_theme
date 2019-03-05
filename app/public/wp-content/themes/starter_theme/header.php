<!DOCTYPE html>
<html <?php language_attributes(); ?>>
  <head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta charset="utf-8">
    <meta name="viewport" content ="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <?php wp_head(); ?>
  </head>
  <body <?php body_class(); ?> >

    <div class="container">

      <header class="site-header site-header--fixed wrapper" id="site-header">
        <h1 class="site-header__title"><a href="<?php echo site_url('/'); ?>" class="header-title"> </a></h1>
        <div >
          <h1>
            <?php bloginfo(); ?>
            
                  <!-- Start  ABOUT -->
                  <?php
                  $id = 2; // add the ID of the page where the zero is
                  $p = get_page($id);
                  echo apply_filters('the_content', $p->post_content);
                  ?>
                  <!-- End    ABOUT -->
         </h1>
        </div>
 
      </header>

      <header class="site-header site-header--static wrapper" id="site-header">
        <h1 class="site-header__title"><a href="<?php echo site_url('/'); ?>" class="header-title"><?php bloginfo(); ?></a>
        
              <!-- Start  ABOUT -->
              <?php
              $id = 2; // add the ID of the page where the zero is
              $p = get_page($id);
              echo apply_filters('the_content', $p->post_content);
              ?>
              <!-- End    ABOUT -->
      </h1>
      </header>

