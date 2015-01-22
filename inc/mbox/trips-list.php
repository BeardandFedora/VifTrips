<?php
/**
 * Metabox : "Trips list"
 * Post types : post, maps
 * Goal : Choose a trip for a post or a map
 *
 * @package VifTrips
 */


/**
 * Register Metabox
 */
function vif_mbox_trips_list() {
  	add_meta_box( 'mbox_trips_list', __( 'Trip', 'lang_viftrips' ), 'vif_mbox_trips_list_content', 'maps', 'side', 'core' );
  	add_meta_box( 'mbox_trips_list', __( 'Trip', 'lang_viftrips' ), 'vif_mbox_trips_list_content', 'post', 'side', 'core' );
}

add_action( 'add_meta_boxes', 'vif_mbox_trips_list' );


/**
 * Content of the Metabox
 * @param object $post Post Object
 */
function vif_mbox_trips_list_content( $post ) {
    
    // Get fields values
    $vif_trip = get_post_meta( $post->ID, 'vif_trip', true );

    // Nonce Field
    wp_nonce_field( plugin_basename( __FILE__ ), 'mbox_trips_list_nonce' );

    // Get Trips list
    $all_trips = vif_query_get_trips();

	// Display different text depending on the post type
   	$textType = ( $post->post_type == 'maps' ) ? __( 'this map', 'lang_viftrips' ) : __( 'this post', 'lang_viftrips' );

    // Display Mbox content
    if ( count( $all_trips ) > 0 ) : ?>

    	<p><?php printf( __( 'Attach %1$s to a trip (optionnal)', 'lang_viftrips' ), $textType ); ?></p>

	    <select name="vif-trip">
	    	<option value="0" <?php if ( $vif_trip == 0 || $vif_trip == '' ) { echo 'selected="selected"'; } ?>>-----</option>
	    	<?php foreach ( $all_trips as $trip ) : ?>
				<option value="<?php echo $trip->ID; ?>" <?php if ( $vif_trip == $trip->ID ) { echo 'selected="selected"'; } ?>><?php echo $trip->post_title; ?></option>
	    	<?php endforeach; ?>
	    </select>

    <?php
    // No trips
    else : ?>

		<p class="mbox-info">
			<?php printf( __( 'No trip found. You can optionaly <a href="%1$s">create a new trip</a> to put %2$s in (don\'t forget to save this content before clicking on this link)' , 'lang_viftrips' ), get_admin_url() . 'post-new.php?post_type=trips', $textType ) ?>
		</p>
		
    <?php endif;
}


/**
 * Save the Metaboxes data
 * @param  Int $post_id ID of the post
 */
function vif_save_mbox_trips_list( $post_id ) {
  
    // Don't do anything for auto-save
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
        return $post_id;

    // No nonce ?
    if( !isset( $_POST['mbox_trips_list_nonce'] ) )
        return $post_id;

    // Check nonce
    if ( !wp_verify_nonce( $_POST['mbox_trips_list_nonce'], plugin_basename( __FILE__ ) ) )
        return;

    // Check permissions
    if ( !current_user_can( 'edit_posts', $post_id ) )
        return;

    // Mbox submitted ?
    if ( isset( $_POST['vif-trip'] ) ) {
        update_post_meta( $post_id, 'vif_trip', $_POST['vif-trip'] );
    }

}

add_action( 'save_post', 'vif_save_mbox_trips_list' );