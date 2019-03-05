<?php get_header(); ?>

<div>


<?php /* About Section */?>
<?php if ( have_posts() ) : ?>
  <?php /* Start The Loop */?>
	<?php while ( have_posts() ) : the_post(); ?>

  <div class="about-page__text"> <?php the_content(); ?> </div>

	<?php endwhile; ?>
<?php endif; ?>
</div>

<?php get_footer(); ?>
