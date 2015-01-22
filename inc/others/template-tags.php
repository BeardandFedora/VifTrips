<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package VifTrips
 */


/**
 * Print the custom css colors in a <style> tag
 * @return HTML
 */
function vif_the_css_for_custom_colors() {
	$vif_options = get_option( 'vif_options' );
	$title_color = $vif_options['title_color'];
	$tagline_color = $vif_options['tagline_color'];
	$primary_color = $vif_options['primary_color'];
	$secondary_color = $vif_options['secondary_color'];

	include_once( 'tpl-custom-css-colors.php' );

}


if ( ! function_exists( 'vif_content_nav' ) ) :
/**
 * Display navigation to next/previous pages when applicable
 *
 */
function vif_content_nav( $nav_id ) {
	global $wp_query, $post;

	// Don't print empty markup on single pages if there's nowhere to navigate.
	if ( is_single() ) {
		$previous = ( is_attachment() ) ? get_post( $post->post_parent ) : get_adjacent_post( false, '', true );
		$next = get_adjacent_post( false, '', false );

		if ( ! $next && ! $previous )
			return;
	}

	// Don't print empty markup in archives if there's only one page.
	if ( $wp_query->max_num_pages < 2 && ( is_home() || is_archive() || is_search() ) )
		return;

	$nav_class = 'site-navigation paging-navigation';
	if ( is_single() )
		$nav_class = 'site-navigation post-navigation';

	$nav_class .= ' clearfix';

	?>
	<nav role="navigation" id="<?php echo $nav_id; ?>" class="<?php echo $nav_class; ?>">
		<h1 class="screen-reader-text"><?php _e( 'Post navigation', 'lang_viftrips' ); ?></h1>

	<?php if ( is_single() ) : // navigation links for single posts ?>

		<?php previous_post_link( '<div class="nav-previous">%link</div>', '<span class="meta-nav">' . _x( '&larr;', 'Previous post link', 'lang_viftrips' ) . '</span> %title' ); ?>
		<?php next_post_link( '<div class="nav-next">%link</div>', '%title <span class="meta-nav">' . _x( '&rarr;', 'Next post link', 'lang_viftrips' ) . '</span>' ); ?>

	<?php elseif ( $wp_query->max_num_pages > 1 && ( is_home() || is_archive() || is_search() ) ) : // navigation links for home, archive, and search pages ?>

		<?php if ( get_next_posts_link() ) : ?>
		<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'lang_viftrips' ) ); ?></div>
		<?php endif; ?>

		<?php if ( get_previous_posts_link() ) : ?>
		<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'lang_viftrips' ) ); ?></div>
		<?php endif; ?>

	<?php endif; ?>

	</nav>
	<?php
}
endif; // vif_content_nav

if ( ! function_exists( 'vif_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 */
function vif_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'lang_viftrips' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( '(Edit)', 'lang_viftrips' ), ' ' ); ?></p>
	<?php
			break;
		default :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>" class="comment">
			<footer>
				<div class="comment-author vcard">
					<?php echo get_avatar( $comment, 50 ); ?>
					<?php printf( __( '%s <span class="says">says:</span>', 'lang_viftrips' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
				</div>
				<?php if ( $comment->comment_approved == '0' ) : ?>
					<p class="awaiting-mod"><?php _e( 'Your comment is awaiting moderation.', 'lang_viftrips' ); ?></p>
				<?php endif; ?>

				<div class="comment-meta commentmetadata">
					<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>"><time datetime="<?php comment_time( 'c' ); ?>">
					<?php
						/* translators: 1: date, 2: time */
						printf( __( '%1$s at %2$s', 'lang_viftrips' ), get_comment_date(), get_comment_time() ); ?>
					</time></a>
					<?php edit_comment_link( __( '(Edit)', 'lang_viftrips' ), ' ' );
					?>
				</div>
			</footer>

			<div class="comment-content"><?php comment_text(); ?></div>

			<div class="reply">
				<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
			</div>
		</article>

	<?php
			break;
	endswitch;
}
endif; // ends check for vif_comment()

if ( ! function_exists( 'vif_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 *
 */
function vif_posted_on() {
	printf( '<time datetime="%1$s">%2$s</time> ' . __( 'by', 'lang_viftrips' ) . ' %3$s',
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		get_the_author()
	);
}
endif;

/**
 * Returns true if a blog has more than 1 category
 *
 */
function vif_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'all_the_cool_cats' ) ) ) {
		// Create an array of all the categories that are attached to posts
		$all_the_cool_cats = get_categories( array(
			'hide_empty' => 1,
		) );

		// Count the number of categories that are attached to the posts
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'all_the_cool_cats', $all_the_cool_cats );
	}

	if ( '1' != $all_the_cool_cats ) {
		// This blog has more than 1 category so vif_categorized_blog should return true
		return true;
	} else {
		// This blog has only 1 category so vif_categorized_blog should return false
		return false;
	}
}

/**
 * Flush out the transients used in vif_categorized_blog
 *
 */
function vif_category_transient_flusher() {
	// Like, beat it. Dig?
	delete_transient( 'all_the_cool_cats' );
}
add_action( 'edit_category', 'vif_category_transient_flusher' );
add_action( 'save_post', 'vif_category_transient_flusher' );


/**
 * Prints HTML of the trips List sidebar
 */
function vif_the_trips_list_nav() {
	global $post;

	// Get Trips list
	$trips_list = vif_query_get_trips(
		array(
			'orderby'	=> 'date',
			'order' 	=> 'DESC'
		)
	);

	$cpt = 0;
	$total_trips = count( $trips_list );

	if ( $total_trips > 0 ) : ?>
		
		<div id="trips-list">
			<div class="trips-list-inner-wrap">
			
				<h1 class="txt-on-bg"><?php _e( 'Trips list', 'lang_viftrips' ); ?></h1>

				<ul class="clearfix">
					
					<?php
					// Loop through trips
					foreach ( $trips_list as $p ) : ?>

						<?php
						$liClass = ( $cpt >= VIF_DEFAULT_TRIPS_DISPLAYED_IN_LIST_MIN ) ? ' trip-hide-for-min' : '';
						$liClass .= ( $cpt >= VIF_DEFAULT_TRIPS_DISPLAYED_IN_LIST_MED ) ? ' trip-hide-for-med' : '';
						$liClass .= ( $cpt >= VIF_DEFAULT_TRIPS_DISPLAYED_IN_LIST_MAX ) ? ' trip-hide-for-max' : '';
						$liClass .= ( isset($post->ID) && $post->ID == $p->ID ) ? ' current-trip-page' : '';
						$liClass = 'class="' . $liClass . '"';
						?>

						<li <?php echo $liClass; ?>>
							<a href="<?php echo get_permalink( $p ); ?>" title="<?php echo esc_attr( $p->post_title ); ?>">
								<?php echo $p->post_title; ?>
							</a>
						</li>

					<?php $cpt++; endforeach; ?>

				</ul>
				
				<?php if ( $cpt > VIF_DEFAULT_TRIPS_DISPLAYED_IN_LIST_MIN ) : ?>
					<p class="trips-list-more trips-list-more-min">
						<a href="" title="<?php _e( 'Click to see all trips', 'lang_viftrips' ); ?>">
							<?php printf( __( '%1$d more trips', 'lang_viftrips' ), $total_trips - VIF_DEFAULT_TRIPS_DISPLAYED_IN_LIST_MIN ); ?>
						</a>
					</p>
				<?php endif; ?>

				<?php if ( $cpt > VIF_DEFAULT_TRIPS_DISPLAYED_IN_LIST_MED ) : ?>
					<p class="trips-list-more trips-list-more-med">
						<a href="" title="<?php _e( 'Click to see all trips', 'lang_viftrips' ); ?>">
							<?php printf( __( '%1$d more trips', 'lang_viftrips' ), $total_trips - VIF_DEFAULT_TRIPS_DISPLAYED_IN_LIST_MED ); ?>
						</a>
					</p>
				<?php endif; ?>

				<?php if ( $cpt > VIF_DEFAULT_TRIPS_DISPLAYED_IN_LIST_MIN && $total_trips > VIF_DEFAULT_TRIPS_DISPLAYED_IN_LIST_MAX ) : ?>
					<p class="trips-list-more trips-list-more-max">
						<a href="" title="<?php _e( 'Click to see all trips', 'lang_viftrips' ); ?>">
							<?php printf( __( '%1$d more trips', 'lang_viftrips' ), $total_trips - VIF_DEFAULT_TRIPS_DISPLAYED_IN_LIST_MAX ); ?>
						</a>
					</p>
				<?php endif; ?>

			</div>
		</div>				

	<?php endif;

}


/**
 * Prints HTML of a side last map
 * @param  	array 	$params 	Array of parameters
 */
function vif_the_side_last_maps( $params = array() ) {
	global $post;

	// Merge params
	$defaults_params = array(
		'max_maps' 		=> VIF_NB_SIDE_LAST_MAPS,
		'excluded_maps'	=> array()
	);

	$params = array_merge( $defaults_params, $params );

	// Get last maps list
	$last_maps = vif_query_get_maps( array(
		'order'				=> 'date',
		'orderby'			=> 'DESC',
		'posts_per_page'	=> $params['max_maps'],
		'post__not_in' 		=> $params['excluded_maps']
	));

	if ( count( $last_maps ) > 0 ) : ?>

		<aside class="side-last-maps">
		
			<h1 class="side-title txt-on-bg">
				<?php _e( 'Last Maps', 'lang_viftrips' ); ?>
			</h1>

			<ul class="clearfix">

				<?php foreach ( $last_maps as $post ) : setup_postdata( $post ); ?>

					<?php
					// Has featured image ?
					$has_post_thumb = has_post_thumbnail();
					$bloc_css = '';

					if ( $has_post_thumb ) {
						$featured_img = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'vif-front-map-fimg' );
						$featured_img_url = $featured_img[0];
						$bloc_css = 'style="background:#fff url(' . $featured_img_url . ') center center no-repeat"';
					}
					?>

					<li class="side-last-map">
						<div class="side-last-map-inner" <?php echo $bloc_css; ?>>

							<h1>
								<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
									<?php the_title(); ?>
								</a>
							</h1>

							<?php if ( $has_post_thumb ) : ?>

								<a href="<?php the_permalink(); ?>" class="map-more" title="<?php _e( 'See the map', 'lang_viftrips' ); ?>">
									<span class="visuallyhidden"><?php _e( 'See the map', 'lang_viftrips' ); ?></span>
								</a>

							<?php else :

								// Load Leaflet
								vif_load_frontend_leaflet();

								$map_tiles_provider = get_post_meta( get_the_ID(), 'vif_tiles_provider', true );
							    if ( $map_tiles_provider == '' ) {
							        $map_tiles_provider = VIF_DEFAULT_TILES_PROVIDER;
							    }

							    if ( $map_tiles_provider == 'cloudmade' ) {
							        $map_cloudmade_style = get_post_meta( get_the_ID(), 'vif_cloudmade_style', true );
							        if ( $map_cloudmade_style == '' ) {
							            $map_cloudmade_style = VIF_DEFAULT_CLOUDMADE_STYLE;
							        }
							    }
								?>

								<div class="vif-leaflet-map-container">
							        <div class="vif-leaflet-map-wrap">
							            <div id="vif-last-maps-map-<?php the_ID(); ?>" class="vif-leaflet-map"
							            	data-map-id="<?php the_ID(); ?>"
							            	data-map-tiles="<?php echo $map_tiles_provider; ?>"
							                <?php if ( isset( $map_cloudmade_style ) ) : ?>
							                    data-map-cloudmade-style="<?php echo $map_cloudmade_style; ?>"
							                <?php endif; ?>
							            	data-map-clusterize="0"
							            	data-map-controls="0"
							            	data-map-drag="0"
							            	data-map-popups="0"
							            	data-map-permalink="<?php the_permalink(); ?>"></div>
							        </div>
							    </div>

							<?php endif; ?>

						</div>
					</li>

				<?php endforeach; wp_reset_postdata(); ?>

			</ul>

		</aside>

	<?php endif;

}


/**
 * Display the social icons button list
 */
function vif_the_social_icons_buttons() {
	$vif_options = get_option( 'vif_options' );
	$services = array();

	if ( $vif_options['url_youtube'] != '' ) {
		$services['youtube'] = array(
			'url' 		=> $vif_options['url_youtube'],
			'name'		=> __( 'Youtube', 'lang_viftrips' ),
			'title' 	=> __( 'See our Youtube', 'lang_viftrips' )
		);
	}
	if ( $vif_options['url_facebook'] != '' ) {
		$services['facebook'] = array(
			'url' 		=> $vif_options['url_facebook'],
			'name'		=> __( 'Facebook', 'lang_viftrips' ),
			'title' 	=> __( 'See our Facebook page', 'lang_viftrips' )
		);
	}
	if ( $vif_options['url_twitter'] != '' ) {
		$services['twitter'] = array(
			'url' 		=> $vif_options['url_twitter'],
			'name'		=> __( 'Twitter', 'lang_viftrips' ),
			'title' 	=> __( 'See our Twitter feed', 'lang_viftrips' )
		);
	}

	?>

		<ul class="vif-social-icons clearfix">
			
			<li>
				<a href="<?php echo get_bloginfo( 'rss2_url' ); ?>" class="vif-icon-rss" title="<?php echo esc_attr( __( 'RSS Feed', 'lang_viftrips' ) ); ?>">
					<span class="visuallyhidden">
						<?php _e( 'RSS Feed', 'lang_viftrips' ); ?>
					</span>
				</a>
			</li>

			<?php if ( count( $services ) > 0 ) : ?>
				<?php foreach( $services as $sv => $sv_infos ) : ?>

					<li>
						<a href="<?php echo $sv_infos['url']; ?>" class="vif-icon-<?php echo $sv; ?>" title="<?php echo esc_attr( $sv_infos['title'] ); ?>" target="_blank">
							<span class="visuallyhidden">
								<?php echo $sv_infos['name']; ?>
							</span>
						</a>
					</li>

				<?php endforeach; ?>
			<?php endif; ?>

		</ul>

	<?php
}