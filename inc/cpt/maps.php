<?php

/**
 * CUSTOM POST TYPE : Maps
 */

 
/**
 * Class definition of the CPT "Maps"
 */
class vif_cpt_maps {

	var $type   = 'maps';


	/**
	 * Constructor
	 */
	function __construct() {
		$this->single = __( 'Map', 'lang_viftrips' );
		$this->plural = __( 'Maps', 'lang_viftrips' );
	}


	/**
	* Define and register the post type
	*/  
	function add_post_type(){

		$labels = array(
			'name'                	=> $this->plural,
			'singular_name'       	=> $this->single,
			'add_new'             	=> __( 'Add', 'lang_viftrips' ),
			'add_new_item'        	=> sprintf( __( 'Add a new %s', 'lang_viftrips' ), $this->single ),
			'edit_item'           	=> sprintf( __( 'Edit this %s', 'lang_viftrips' ), $this->single ),
			'new_item'            	=> sprintf( __( 'New %s', 'lang_viftrips' ), $this->single ),
			'view_item'           	=> sprintf( __( 'See the %s', 'lang_viftrips' ), $this->single ),
			'search_items'        	=> sprintf( __( 'Search %s', 'lang_viftrips' ), $this->plural ),
			'not_found'           	=> sprintf( __( 'No %s found', 'lang_viftrips' ), $this->plural ),
			'not_found_in_trash'  	=> sprintf( __( 'No %s found in trash', 'lang_viftrips' ), $this->plural ),
			'parent_item_colon'   	=> sprintf( __( 'My %s', 'lang_viftrips' ), $this->plural )
		);

		$options = array(
			'labels'              	=> $labels,
			'public'              	=> true,
			'publicly_queryable'  	=> true,
			'exclude_from_search' 	=> false,
			'show_ui'             	=> true,
			'show_in_menu'        	=> true,
			'menu_position'       	=> 21,
			'menu_icon'				=> 'dashicons-location-alt',
			'capability_type'     	=> 'post',
			'hierarchical'        	=> false,
			'supports'            	=> array( 'title', 'editor', 'thumbnail' ),
			'has_archive'         	=> true,
			'rewrite'             	=> true,
			'query_var'           	=> true,
			'can_export'          	=> true
		);

		// Register the Post Type
		register_post_type( $this->type, $options );

	}


	/**
	* CPT Infos Messages
	*/  
	function add_messages ( $messages ) {

		global $post;
		$post_ID = $post->ID;      

		$messages[$this->type] = array(
			0 => '', 
			1 => sprintf( __( '%1$s updated. <a href="%2$s">See the %1$s</a>', 'lang_viftrips' ), $this->single, esc_url( get_permalink( $post_ID ) ) ),
			2 => __( 'Custom field updated.', 'lang_viftrips' ),
			3 => __( 'Custom field deleted.', 'lang_viftrips' ),
			4 => sprintf( __( '%s updated.', 'lang_viftrips' ), $this->single ),
			5 => isset($_GET['revision']) ? sprintf( __( '%1$s restored at revision %2$s', 'lang_viftrips' ), $this->single, wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
			6 => sprintf( __( '%1$s published. <a href="%2$s">See the %1$s</a>', 'lang_viftrips' ), $this->single, esc_url( get_permalink( $post_ID ) ) ),
			7 => sprintf( __( '%s saved', 'lang_viftrips' ), $this->single ),
			8 => sprintf( '%1$s saved. <a target="_blank" href="%2$s">Preview the %1$s</a>', $this->single, esc_url( add_query_arg( 'preview', 'true', get_permalink( $post_ID ) ) ) ),
			9 => sprintf( '%1$s planned for the : <strong>%2$s</strong>. <a target="_blank" href="%3$s">Preview the %1$s</a>', $this->single, date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink( $post_ID ) ) ),
			10 => sprintf( 'Draft of %1$s updates. <a target="_blank" href="%2$s">Preview the %1$s</a>', $this->single, esc_url( add_query_arg( 'preview', 'true', get_permalink( $post_ID ) ) ) ),
		);

		return $messages;
	}

}


/**
 * Init action for registering this CPT
 */
function vif_init_cpt_maps() {
	// Create class instance
	$cptMaps = new vif_cpt_maps;

	// Register CPT
	$cptMaps->add_post_type();

	// Register Messages
	add_filter( 'post_updated_messages', array( &$cptMaps, 'add_messages' ) );

}

add_action( 'init', 'vif_init_cpt_maps' );


/**
 * Action when sending a Map to trash
 */
function vif_wp_trashed_map( $map_ID ) {
	global $post_type;

	if ( $post_type == 'maps' ) {
		$vif_options = get_option( 'vif_options' );

		$map_markers = vif_query_get_map_markers(
			$map_ID,
			array(
				'post_status' 		=> 'any'
			)
		);

		if ( count( $map_markers ) > 0 ) {
			foreach ( $map_markers as $mm ) {

				// Unlink marker from map
				update_post_meta( $mm->ID, 'vif_map', 0 );

				// Send marker to trash ?
				if ( $vif_options['map_trash_keep_markers'] == 0 ) {
					wp_trash_post( $mm->ID );
				}
			}
		}

	}

}

add_action( 'trashed_post', 'vif_wp_trashed_map', 11 );