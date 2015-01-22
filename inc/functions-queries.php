<?php
/**
 * VifTrips Queries to database functions
 *
 * @package VifTrips
 */


/*******************
 ***** GETTERS *****
 *******************/


/**
 * Get a Trip
 * @return array 	Array of 1 Trip WP object
 */
function vif_query_get_trip( $trip_id = 0 ) {

	if ( $trip_id != 0 ) {

		$trip = get_posts( array(
	        'post_type'     => 'trips',
	        'p'             => $trip_id
	    ));

	    if ( count( $trip ) == 1 ) {
	    	return $trip[0];
	    }

	}

	return '';

}


/**
 * Get all trips
 * @param  array 	$params 	Array of WP_Query parameters
 * @return array  				Array of Trips WP objects
 */
function vif_query_get_trips( $params = array() ) {

	// Merge params
	$defaults_params = array(
		'post_status' 		=> 'publish',
		'orderby'			=> 'title',
		'order'				=> 'ASC',
		'posts_per_page'	=> -1
	);

	$params = array_merge( $defaults_params, $params );

	return get_posts( array(
    	'post_type'			=> 'trips',
    	'post_status'		=> $params['post_status'],
    	'orderby'			=> $params['orderby'],
    	'order'				=> $params['order'],
    	'posts_per_page' 	=> $params['posts_per_page']
    ));

}


/**
 * Get Maps or Posts belonging to a given trip
 * @param  int 		$trip_id  	Trip ID
 * @param  array 	$params 		Array of WP_Query parameters
 * @return array  					Array of posts/maps WP objects
 */
function vif_query_get_trip_contents( $trip_id = 0, $params = array() ) {

	if ( $trip_id != 0 ) {

		// Merge params
		$defaults_params = array(
			'post_status' 		=> 'publish',
			'posts_per_page'	=> -1,
			'orderby'			=> 'date',
			'order'				=> 'DESC',
			'post__not_in'		=> array()
		);

		$params = array_merge( $defaults_params, $params );

		return get_posts( array(
			'post_type'			=> array( 'post', 'maps' ),
			'post_status'		=> $params['post_status'],
			'meta_query'		=> array(
									array(
										'key' 		=> 'vif_trip',
										'value' 	=> $trip_id,
										'compare' 	=> '='
									)
			),
			'posts_per_page' 	=> $params['posts_per_page'],
			'orderby' 			=> $params['orderby'],
			'order' 			=> $params['order'],
			'post__not_in'  	=> $params['post__not_in']

		));

	}

	return array();

}


/**
 * Get a Map
 * @param  int 		$map_ID 	ID of the requested map
 * @return array 				Array of 1 Maps WP object
 */
function vif_query_get_map( $map_ID = 0 ) {

	if ( $map_ID != 0 ) {

		$map = get_posts( array(
	        'post_type'     => 'maps',
	        'p'             => $map_ID
	    ));

	    if ( count( $map ) == 1 ) {
	    	return $map[0];
	    }

	}

	return '';

}


/**
 * Get Maps
 * @param  array 	$params 	Array of WP_Query parameters
 * @return array 				Array of Maps WP objects
 */
function vif_query_get_maps( $params = array() ) {

	// Merge params
	$defaults_params = array(
		'post_status' 		=> 'publish',
		'orderby'			=> 'title',
		'order'				=> 'ASC',
		'posts_per_page'	=> -1,
		'offset'			=> 0,
		'post__not_in'		=> array()
	);

	$params = array_merge( $defaults_params, $params );

	return get_posts( array(
    	'post_type'			=> 'maps',
    	'post_status'		=> $params['post_status'],
    	'orderby'			=> $params['orderby'],
    	'order'				=> $params['order'],
    	'posts_per_page' 	=> $params['posts_per_page'],
    	'offset'			=> $params['offset'],
    	'post__not_in' 		=> $params['post__not_in']
    ));

}


/**
 * Get all maps with tiles provider as Cloudmade
 * @return array 	Array of Maps WP objects
 */
function vif_query_get_maps_with_cloudmade() {
	return get_posts( array(
		'post_type' 		=> 'maps',
		'post_status'		=> 'any',
		'posts_per_page'	=> -1,
		'meta_query'		=> array( array(
									'key'		=> 'vif_tiles_provider',
									'value'		=> 'cloudmade',
									'compare'	=> '='
								))
	));
}


/**
 * Get Map Markers
 * @param  int 		$map_id  	Map ID
 * @param  array 	$params 	Array of WP_Query parameters
 * @return array 				Array of markers WP objects
 */
function vif_query_get_map_markers( $map_id = 0, $params = array() ) {

	// Map != 0
	if ( $map_id != 0 ) {

		// Merge params
		$defaults_params = array(
			'post_status' 		=> 'publish',
			'posts_per_page'	=> -1,
			'orderby'			=> 'date',
			'order'				=> 'ASC'
		);

		$params = array_merge( $defaults_params, $params );

		// Get map markers
		return get_posts( array(
			'post_type' 		=> 'markers',
			'post_status'		=> $params['post_status'],
			'meta_query' 		=> array(
									array(
										'key' 		=> 'vif_map',
										'value'		=> $map_id,
										'compare'	=> '='
									)
			),
			'posts_per_page' 	=> $params['posts_per_page'],
			'orderby' 			=> $params['orderby'],
			'order' 			=> $params['order']
		));

	}

	return array();

}


/**
 * Get all markers
 * @param array $params Parameters for the WP_query
 */
function vif_query_get_markers( $params = array() ) {

	// Merge params
	$defaults_params = array(
		'post_status' 		=> 'publish',
		'posts_per_page'	=> -1,
		'orderby'			=> 'title',
		'order'				=> 'ASC'
	);

	$params = array_merge( $defaults_params, $params );

	return get_posts( array(
		'post_type'			=> 'markers',
		'post_status'		=> $params['post_status'],
		'posts_per_page' 	=> $params['posts_per_page'],
		'orderby'			=> $params['orderby'],
		'order' 			=> $params['order']
	));

}


/**
 * Get an Attachment
 * @param  	$attch_id 	Attachment ID
 * @return  array  		Array of 1 attachment
 */
function vif_query_get_attachment( $attch_id = 0 ) {

	if ( $attch_id != 0 ) {

		$attch = get_posts( array(
	        'post_type'     => 'attachment',
	        'p'             => $attch_id,
	        'post_status'   => 'inherit'
	    ));

		if ( count( $attch ) == 1 ) {
	    	return $attch[0];
	   	}

	}

	return '';

}


/**
 * Get posts in a given category
 * @param 	int 	$category_ID 	Category ID
 */
function vif_query_get_posts_in_category( $category_ID = 0, $params = array() ) {

	if ( $category_ID != 0 ) {
		$category = get_term( $category_ID, 'category' );

		if ( $category !== null ) {

			// Merge params
			$defaults_params = array(
				'posts_per_page' 	=> -1
			);

			$params = array_merge( $defaults_params, $params );

			return get_posts( array(
				'post_type'			=> 'post',
				'post_status'		=> 'publish',
				'posts_per_page'	=> $params['posts_per_page'],
				'orderby' 			=> 'date',
				'order'				=> 'DESC',
				'tax_query' 		=> array( array(
											'taxonomy' 		=> 'category',
											'field' 		=> 'id',
											'terms'			=> $category_ID
										))
			));

		}

	}

	return array();

}



/**********************
 ****** EXISTORS ******
 **********************/

/**
 * Test if a trip exists
 */
function vif_query_exists_trip( $trip_ID = 0 ) {

	if ( $trip_ID != 0 && $trip_ID != '' ) {
		if ( vif_query_get_trip( $trip_ID ) ) {
			return true;
		}
	}

	return false;

}


/**
 * Test if a map exists
 */
function vif_query_exists_map( $map_ID = 0 ) {

	if ( $map_ID != 0 && $map_ID != '' ) {
		if ( vif_query_get_map( $map_ID ) ) {
			return true;
		}
	}

	return false;

}



/**********************
 ****** COUNTERS ******
 **********************/


/**
 * Count Maps in a given trip
 */
function vif_query_count_maps_in_trip( $trip_id = 0 ) {

	if ( $trip_id != 0 ) {

		$maps_in_this_trip = get_posts( array(
	        'post_type'     	=> 'maps',
	        'post_status'  	 	=> 'publish',
		    'meta_query'    	=> array( array(
							            'key'       => 'vif_trip',
							            'value'     => $trip_id,
							            'compare'   => '='
							        )),
	        'posts_per_page'	=> -1
	    ));

	    return count( $maps_in_this_trip );

	}

	return 0;

}


/**
 * Count Posts in a given trip
 */
function vif_query_count_posts_in_trip( $trip_id = 0 ) {

	if ( $trip_id != 0 ) {

		$posts_in_this_trip = get_posts( array(
	        'post_type'     	=> 'post',
	        'post_status'   	=> 'publish',
	        'meta_query'    	=> array( array(
							            'key'       => 'vif_trip',
							            'value'     => $trip_id,
							            'compare'   => '='
							        )),
	        'posts_per_page'	=> -1
	    ));

	    return count( $posts_in_this_trip );

	}

	return 0;

}


/**
 * Count Markers in a given Map
 */
function vif_query_count_markers_in_map( $map_id = 0 ) {

	if ( $map_id != 0 ) {

		$posts_in_this_trip = get_posts( array(
            'post_type'     	=> 'markers',
            'post_status'   	=> 'publish',
            'meta_query'    	=> array( array(
						                'key'       => 'vif_map',
						                'value'     => $map_id,
						                'compare'   => '='
						            )),
            'posts_per_page'	=> -1
    	));

	    return count( $posts_in_this_trip );

	}

	return 0;

}


/**
 * Count Orphan Maps
 */
function vif_query_count_orphan_maps() {

	$maps_in_this_trip = get_posts( array(
        'post_type'     	=> 'maps',
        'post_status'  	 	=> 'any',
	    'meta_query'    	=> array( array(
						            'key'       => 'vif_trip',
						            'value'     => 0,
						            'compare'   => '='
						        )),
        'posts_per_page'	=> -1
    ));

	return count( $maps_in_this_trip );

}


/**
 * Count Orphan Markers
 */
function vif_query_count_orphan_markers() {

	$markers_in_this_map = get_posts( array(
        'post_type'     	=> 'markers',
        'post_status'  	 	=> 'any',
	    'meta_query'    	=> array( array(
						            'key'       => 'vif_map',
						            'value'     => 0,
						            'compare'   => '='
						        )),
        'posts_per_page'	=> -1
    ));

	return count( $markers_in_this_map );

}