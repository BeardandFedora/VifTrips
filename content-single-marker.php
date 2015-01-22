<?php
/**
 * Content for a single markers
 * 
 * @package VifTrips
 */
?>

<article class="type-markers">
	
	<header class="marker-header">
	
		<h1 class="marker-title"><?php the_title(); ?></h1>

	</header>

	<div class="marker-content">

		<?php the_content(); ?>

	</div>

    <?php
    $marker_map_ID = get_post_meta( get_the_ID(), 'vif_map', true );

    if ( $marker_map_ID != 0 ) :
        $marker_map = vif_query_get_map( $marker_map_ID );

        if ( $marker_map != '' ) :
            $marker_map_trip_ID = get_post_meta( $marker_map->ID, 'vif_trip', true );
            ?>

            <footer class="marker-meta">

                <p class="same-map-title">
                    <?php _e( 'In the same map', 'lang_viftrips' ); ?> :
                </p>

                <h2>
                    <a href="<?php echo get_permalink( $marker_map ); ?>" title="<?php _e( 'See this map', 'lang_viftrips' ); ?>">
                        <?php echo $marker_map->post_title; ?>
                    </a>
                </h2>

                <?php
                if ( $marker_map_trip_ID != '' ) :
                    $marker_map_trip = vif_query_get_trip( $marker_map_trip_ID );

                    if ( $marker_map_trip != '' ) : ?>

                        <p class="marker-trip">
                            <?php _e( 'Trip', 'lang_viftrips' ); ?> :
                            <a href="<?php echo get_permalink( $marker_map_trip ); ?>" title="<?php _e( 'See this trip', 'lang_viftrips' ); ?>">
                                <?php echo $marker_map_trip->post_title; ?>
                            </a>
                        </p>

                    <?php endif; ?>

                <?php endif; ?>

                <?php
                // Load Leaflet
                vif_load_frontend_leaflet();
                ?>

                <div class="vif-leaflet-map-container">
                    <div class="vif-leaflet-map-wrap">
                        <div id="vif-map-marker-<?php echo $marker_map_ID; ?>" class="vif-leaflet-map"
                            data-map-id="<?php echo $marker_map_ID; ?>"
                            data-map-tiles="osm"
                            data-map-clusterize="1"
                            data-map-markers-index="1"
                            data-map-open-marker="<?php the_ID(); ?>"></div>
                    </div>
                </div>

            </footer>

        <?php endif; ?>

    <?php endif; ?>

</article>