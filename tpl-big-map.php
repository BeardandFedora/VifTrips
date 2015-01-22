<?php
/**
 * Template Name: Big Map
 * 
 * @package VifTrips
 */

get_header(); ?>

<div id="primary" class="content-area">
	<div id="content" class="site-content" role="main">

		<?php while ( have_posts() ) : the_post(); ?>

			<article id="big-map-page" class="hentry">
				
				<header class="entry-header">
					<h1 class="entry-title"><?php the_title(); ?></h1>
				</header>

				<?php
				$content = get_the_content();
				$content = apply_filters('the_content', $content);
				$content = str_replace(']]>', ']]&gt;', $content);

				if ( $content != '' ) : ?>
					<div class="entry-content">
						<?php the_content(); ?>
					</div>
				<?php endif; ?>

				<?php
				// Load Leaflet
			    vif_load_frontend_leaflet();

			    $vif_options = get_option( 'vif_options' );
			    $big_map_tiles_provider = $vif_options['special_map_tiles_provider'];
			    $big_map_cloudmade_style = $vif_options['special_map_cloudmade_style'];
				?>

				<div class="vif-leaflet-map-container">
			        <div class="vif-leaflet-map-wrap">
			            <div id="vif-big-map" class="vif-leaflet-map"
			            	data-map-id="all"
			            	data-map-tiles="<?php echo $big_map_tiles_provider; ?>"
			                <?php if ( $big_map_tiles_provider == 'cloudmade' ) : ?>
			                    data-map-cloudmade-style="<?php echo $big_map_cloudmade_style; ?>"
			                <?php endif; ?>
			            	data-map-clusterize="1"></div>
			        </div>
			    </div>

			</article>

		<?php endwhile; ?>

	</div>
</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
