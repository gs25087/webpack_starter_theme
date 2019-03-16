<?php get_header(); ?>

<?php 
if ( have_posts() ) {
	while ( have_posts() ) {
		the_post(); 
		?>
    <h1> <?php the_title(); ?> </h1>
    <div class=""> <?php the_content(); ?> </div>
		<?php
	} // end while
} // end if
?>

<?php get_footer(); ?>