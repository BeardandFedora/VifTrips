<?php
/**
 * The Template for displaying all single trips.
 *
 * @package VifTrips
 */

get_header(); ?>

<div id="primary" class="content-area">
	<div id="content" class="site-content clearfix" role="main">

	<?php while ( have_posts() ) : the_post(); ?>

		<?php get_template_part( 'content', 'single-trip' ); ?>

		<?php get_template_part( 'content', 'trip-contents-list' ); ?>

		<?php
			// If comments are open or we have at least one comment, load up the comment template
			if ( comments_open() || '0' != get_comments_number() )
				comments_template( '', true );
		?>

	<?php endwhile; ?>

	</div>
</div>

<?php get_footer(); ?>