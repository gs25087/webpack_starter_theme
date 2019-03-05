<?php /* Blog Section */?>
<?php if ( have_posts() ) : ?>
  <?php /* Start The Loop */?>
	<?php while ( have_posts() ) : the_post(); ?>
	<h1> <?php the_title(); ?> </h1>
  <div class=""> <?php the_content(); ?> </div>
	<?php endwhile; ?>
<?php endif; ?>
