<?php
/**
 * Content for a single trips
 * 
 * @package VifTrips
 */
?>

<article class="type-trips clearfix <?php if ( has_post_thumbnail() ) { echo 'trip-with-thumbnail'; } ?>">

	<header class="trip-header">

		<h1 class="trip-title">
			<?php the_title(); ?>
		</h1>

		<?php
		$trip_date = get_post_meta( get_the_ID(), 'vif_date', true );

		if ( $trip_date != '' ) : ?>

			<p class="trip-date">
				<span><?php _e( 'Started on', 'lang_viftrips' ); ?> : </span>
				<?php echo $trip_date; ?>
			</p>

		<?php endif; ?>

		<?php
		$trip_owner = get_post_meta( get_the_ID(), 'vif_owner', true );
		$trip_website = get_post_meta( get_the_ID(), 'vif_website', true );

		if ( $trip_owner != '' ) : ?>

			<p class="trip-owner">
				<span><?php _e( 'Initiated by', 'lang_viftrips' ); ?> : </span>
				
				<?php if ( $trip_website != '' ) : ?>
				
					<a href="<?php echo $trip_website; ?>" target="_blank">
						<?php echo $trip_owner; ?>
					</a>

				<?php else : ?>
	
					<?php echo $trip_owner; ?>

				<?php endif; ?>

			</p>

		<?php endif; ?>


	</header>

	<?php
	// Has featured Image ?
	if ( has_post_thumbnail() ) {
		the_post_thumbnail( 'vif-trip-thumb' );
	}
	?>

	<div class="trip-content">

		<?php the_content(); ?>

	</div>

	<footer class="trip-meta">
		
		<?php
		$trip_twitter = get_post_meta( get_the_ID(), 'vif_twitter', true );
		$trip_facebook = get_post_meta( get_the_ID(), 'vif_facebook', true );

		if ( $trip_twitter != '' || $trip_facebook != '' ) : ?>

			<p class="trip-follow">
				
				<?php _e( 'Follow this trip on', 'lang_viftrips' ); ?> :
	
				<span>
					<?php if ( $trip_twitter != '' ) : ?>
						<a href="<?php echo $trip_twitter; ?>" target="_blank" title="<?php _e( 'Go to the Twitter account dedicated to this trip', 'lang_viftrips' ); ?>">Twitter</a>
					<?php endif; ?>

					<?php if ( $trip_facebook != '' ) : ?>
						<?php if ( $trip_twitter != '' ) { echo ' - '; } ?>
						<a href="<?php echo $trip_facebook; ?>" target="_blank" title="<?php _e( 'Go to the Facebook page dedicated to this trip', 'lang_viftrips' ); ?>">Facebook</a>
					<?php endif; ?>
				</span>

			</p>

		<?php endif; ?>

		<?php $trip_file = get_post_meta( get_the_ID(), 'vif_file', true ); ?>

		<?php if ( $trip_file != '' ) : ?>

			<p class="trip-file">
				<?php _e( 'Attached file', 'lang_viftrips' ); ?> : 
				<span><?php echo wp_get_attachment_link( $trip_file, '' ); ?></span>
			</p>

		<?php endif; ?>

	</footer>

</article>
