<?php get_header(); ?>

<!-- Start  PROJECT IMAGES -->
<div class="column column--60 column--60--fixed ">
  <ul class="project__images">
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

      <li class="project__images__single">

        <a href="#<?php echo strtolower(preg_replace('/[^a-zA-Z0-9-_]/','', get_the_title()));?>">
        <!-- place  IMAGE here -->
        <?php $img_choice = get_field( 'img_choice' ); ?>
         <?php if ( $img_choice ) : ?>
    	   <img class="lazyloadx" data-sizes="auto" src="<?php echo $img_choice['sizes']['medium']; ?>" data-srcset="<?php echo $img_choice['sizes']['small']; ?> 300w, <?php echo $img_choice['sizes']['medium']; ?> 768w, <?php echo $img_choice['sizes']['large']; ?> 1024w, <?php echo $img_choice['sizes']['xlarge']; ?> 1500w, <?php echo $img_choice['sizes']['fullHD']; ?> 1920w " alt="<?php echo $img_choice['alt']; ?>" />
        <?php endif; ?> </a>

        <!-- place  PROJECT INFO for small mobile --> 
        <div class="content__item--mobile">
          <!-- place  PROJECT INFO here --> 
          <h2 class="content__item__title"> <?php the_title(); ?>  </h2>
         <div class="content__item__text"> <?php the_content(); ?> </div> 
         <div class="content__item__copyright"><p>&copy; <?php echo date('Y'); ?></p></div>
        </div>
        
      </li> 
    
    <?php endwhile; else : ?>
    <?php endif; ?>
<!-- End    PROJECT IMAGES -->

  </ul>
  
</div>

<?php rewind_posts(); ?> 

<!-- Start  PROJECT INFO -->
<div class="column column--40"> 
  <div class="content" > 
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
      <div id="<?php echo strtolower(preg_replace('/[^a-zA-Z0-9-_]/','', get_the_title()));?>" 
           class="content__item">
          <!-- place  PROJECT INFO here --> 
         <h2 class="content__item__title"> <?php the_title(); ?>  </h2>
         <div class="content__item__text"> <?php the_content(); ?> </div> 
         <div class="content__item__copyright"><p>&copy; <?php echo date('Y'); ?></p></div>
      </div>

      <?php endwhile; ?>
    <?php endif; ?>
<!-- End  PROJECT INFO -->
  </div> 
</div>

</div> <!-- End .CONTAINER  -->    
  </body>
</html>




