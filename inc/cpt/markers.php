<?php

/**
 * CUSTOM POST TYPE : Markers
 */

 
/**
 * Class definition of the CPT "Markers"
 */
class vif_cpt_markers {

	var $type   = 'markers';


	/**
	 * Constructor
	 */
	function __construct() {
		$this->single = __( 'Marker', 'lang_viftrips' );
		$this->plural = __( 'Markers', 'lang_viftrips' );
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
			'menu_position'       	=> 22,
			'menu_icon'				=> 'dashicons-location',
			'capability_type'     	=> 'post',
			'hierarchical'        	=> false,
			'supports'            	=> array( 'title', 'editor' ),
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
function vif_init_cpt_markers() {
	// Create class instance
	$cptMarkers = new vif_cpt_markers;

	// Register CPT
	$cptMarkers->add_post_type();

	// Register Messages
	add_filter( 'post_updated_messages', array( &$cptMarkers, 'add_messages' ) );
}

add_action( 'init', 'vif_init_cpt_markers' );