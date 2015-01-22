<?php
/**
 * Content for a single maps
 * 
 * @package VifTrips
 */
?>

<article class="type-maps">
	
	<header class="map-header">
	
		<h1 class="map-title"><?php the_title(); ?></h1>

        <?php
        $map_trip_ID = get_post_meta( get_the_ID(), 'vif_trip', true );

        if ( $map_trip_ID != 0 ) :
            $map_trip = vif_query_get_trip( $map_trip_ID );

            if ( $map_trip != '' ) : ?>
                
                <p class="map-trip">
                    <?php _e( 'Trip', 'lang_viftrips' ); ?> :
                    <a href="<?php echo get_permalink( $map_trip ); ?>" title="<?php echo esc_attr( $map_trip->post_title ); ?>">
                        <?php echo $map_trip->post_title; ?>
                    </a>
                </p>

                <?php
            endif;
        endif;
        ?>

	</header>

	<?php
	// Load Leaflet
    vif_load_frontend_leaflet();

    $vif_options = get_option( 'vif_options' );

    $map_tiles_provider = get_post_meta( get_the_ID(), 'vif_tiles_provider', true );
    $map_export = get_post_meta( get_the_ID(), 'vif_export', true );
    if ( $map_export == '' ) { $map_export = $vif_options['export_maps']; }
	?>

	<div class="vif-leaflet-map-container">
        <div class="vif-leaflet-map-wrap">
            <div id="vif-map-<?php the_ID(); ?>" class="vif-leaflet-map"
            	data-map-id="<?php the_ID(); ?>"
            	data-map-tiles="<?php echo $map_tiles_provider; ?>"
                <?php if ( $map_tiles_provider == 'cloudmade' ) : ?>
                    data-map-cloudmade-style="<?php echo get_post_meta( get_the_ID(), 'vif_cloudmade_style', true ); ?>"
                <?php endif; ?>
            	data-map-clusterize="1"
                data-map-markers-index="1"
                <?php if ( $map_export ) : ?>
                    data-map-export="1"
                <?php endif;?>
                ></div>
        </div>
    </div>

	<div class="map-content">

		<?php the_content(); ?>

	</div>

</article>
