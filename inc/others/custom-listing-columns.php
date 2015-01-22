<?php
/**
 * Additional columns in listings
 *
 * Add 'Trip' column in POSTS and MAPS posts types
 * Add 'Map' column in MARKERS post type
 *
 * @package VifTrips
 */


/**
 * Add columns heads
 * @param  array    $columns  Array of columns names
 * @return array                    Modified array
 */
function vif_add_column_heads( $defaults, $new_columns ) {
    $new_defaults = array();

    // Add custom columns before the selected column
    foreach ( $defaults as $default_column_ID => $default_column_title ) {

        if ( array_key_exists( $default_column_ID, $new_columns ) ) {
            
            foreach( $new_columns[$default_column_ID] as $new_column_ID => $new_column_title ) {
                $new_defaults[$new_column_ID] = $new_column_title;
            }

        }

        $new_defaults[$default_column_ID] = $default_column_title;

    }

    return $new_defaults;

}


/**
 * Add column contents
 * @param  array    $column_name    Name of the current column
 * @param  int      $post_ID        Post ID
 * @return                          Echo HTML content
 */
function vif_add_column_content( $column_name, $post_ID ) {

    switch( $column_name ) {

        case 'totals_in_trip':

            // Total maps in this trip
            $total_maps = vif_query_count_maps_in_trip( $post_ID );

            // Total posts in this trip
            $total_posts = vif_query_count_posts_in_trip( $post_ID );

            echo '<span class="total-trip-column-content-info"><strong>' . $total_maps . '</strong> ' . _n( 'map', 'maps', $total_maps, 'lang_viftrips' ) . '</span>';
            echo '<span class="total-trip-column-content-info"><strong>' . $total_posts . '</strong> ' . _n( 'post', 'posts', $total_posts, 'lang_viftrips' ) . '</span>';

            break;

        case 'trip':

            $trip_ID = get_post_meta( $post_ID, 'vif_trip', true );

            // Current post type has a trip
            if ( $trip_ID != 0 ) {

                $trip = vif_query_get_trip( $trip_ID );

                if ( $trip != '' ) {
                    echo $trip->post_title;
                }

            }

            break;

        case 'marker_map':

            $map_ID = get_post_meta( $post_ID, 'vif_map', true );

            // Current post type has a map
            if ( $map_ID != 0 ) {

                $map = vif_query_get_map( $map_ID );

                if ( $map != '' ) {
                    echo $map->post_title;
                }

            }

            break;

        case 'marker_icon':

            $icon_type = get_post_meta( $post_ID, 'vif_icon_type', true );
            $icon_filename = get_post_meta( $post_ID, 'vif_icon_filename', true );

            $icon_src = ( $icon_type == 'default' ) ? VIF_URL_DEFAULT_MARKERS_ICONS . '/' . $icon_filename : VIF_URL_CUSTOM_MARKERS_ICONS . '/' . $icon_filename;

            echo '<img src="' . $icon_src . '" class="marker-icon">';

            break;

        case 'total_markers':

            echo vif_query_count_markers_in_map( $post_ID );

            break;

    }

}


/**
 * ##########################
 * ADD COLUMNS TO POSTS TYPES
 * ##########################
 */


/**
 * Add custom columns heads and content to POSTS listing
 * @param  array $defaults 	Defaults columns heads
 * @return array 			The modified array
 */
function vif_posts_listing_columns_head( $defaults ) {

    return vif_add_column_heads(
        $defaults,
        array(
            'date'  => array(
                'trip'   => __( 'Trip', 'lang_viftrips' )
            )
        )
    );

}

add_filter( 'manage_post_posts_columns', 'vif_posts_listing_columns_head', 10 );
add_action( 'manage_post_posts_custom_column', 'vif_add_column_content', 10, 2 );


/**
 * Add custom columns heads and content to TRIPS listing
 * @param  array $defaults 	Defaults columns heads
 * @return array 			The modified array
 */
function vif_trips_listing_columns_head( $defaults ) {

	return vif_add_column_heads(
        $defaults,
        array(
            'date'  => array(
                'totals_in_trip'    => __( 'Totals', 'lang_viftrips' )
            )
        )
    );

}

add_filter( 'manage_trips_posts_columns', 'vif_trips_listing_columns_head', 10 );
add_action( 'manage_trips_posts_custom_column', 'vif_add_column_content', 10, 2 );


/**
 * Add custom columns heads to MAPS listing
 * @param  array $defaults 	Defaults columns heads
 * @return array 			The modified array
 */
function vif_maps_listing_columns_head( $defaults ) {

	return vif_add_column_heads(
        $defaults,
        array(
            'date'  => array(
                'trip'       => __( 'Trip', 'lang_viftrips' ),
                'total_markers' => __( 'Markers', 'lang_viftrips' )
            )
        )
    );

}

add_filter( 'manage_maps_posts_columns', 'vif_maps_listing_columns_head', 10 );
add_action( 'manage_maps_posts_custom_column', 'vif_add_column_content', 10, 2 );


/**
 * Add custom columns heads to MARKERS listing
 * @param  array $defaults 	Defaults columns heads
 * @return array 			The modified array
 */
function vif_markers_listing_columns_head( $defaults ) {

    return vif_add_column_heads(
        $defaults,
        array(
            'title' => array(
                'marker_icon'  => __( 'Icon', 'lang_viftrips' )
            ),
            'date'  => array(
                'marker_map'   => __( 'Map', 'lang_viftrips' )
            )
        )
    );

}

add_filter( 'manage_markers_posts_columns', 'vif_markers_listing_columns_head', 10 );
add_action( 'manage_markers_posts_custom_column', 'vif_add_column_content', 10, 2 );








