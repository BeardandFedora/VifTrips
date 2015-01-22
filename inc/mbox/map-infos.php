<?php
/**
 * Metabox : "Infos"
 * Post types : maps
 *
 * @package VifTrips
 */


/**
 * Register Metabox
 */
function vif_mbox_map_infos() {
    add_meta_box( 'mbox_map_infos', __( 'Infos', 'lang_viftrips' ), 'vif_mbox_map_infos_content', 'maps', 'side', 'core' );
}

add_action( 'add_meta_boxes', 'vif_mbox_map_infos' );


/**
 * Content of the Metabox
 * @param object $post Post Object
 */
function vif_mbox_map_infos_content( $post ) {
    $vif_options = get_option( 'vif_options' );

    // Nonce Field
    wp_nonce_field( plugin_basename( __FILE__ ), 'mbox_map_infos_nonce' );

    // Add tiles provider choice only if Cloudmade API key is set, otherwise the only choice is OpenStreetMap so no need to display
    if ( $vif_options['cloudmade_api_key'] != VIF_DEFAULT_CLOUDMADE_API_KEY ) :
	
        // Get fields values
        $vif_tiles_provider = get_post_meta( $post->ID, 'vif_tiles_provider', true );
        $vif_cloudmade_style = get_post_meta( $post->ID, 'vif_cloudmade_style', true );

        if ( $vif_tiles_provider == '' ) {
            $vif_tiles_provider = VIF_DEFAULT_TILES_PROVIDER;
            $vif_cloudmade_style = VIF_DEFAULT_CLOUDMADE_STYLE;
        }
    	?>

        <p class="mbox-label">
            <?php _e( 'Choose a tiles provider :', 'lang_viftrips' ); ?>
        </p>

        <p class="vif-tiles-provider-elt">
            <label title="OpenStreetMap">
                <input type="radio" name="vif-tiles-provider" value="osm" <?php echo ( $vif_tiles_provider == 'osm' ) ? 'checked="checked"' : ''; ?>>
                OpenStreetMap
            </label>
        </p>

        <p class="vif-tiles-provider-elt">
            <label title="Cloudmade">
                <input type="radio" name="vif-tiles-provider" value="cloudmade" <?php echo ( $vif_tiles_provider == 'cloudmade' ) ? 'checked="checked"' : ''; ?>>
                Cloudmade
                <span class="vif-cloudmade-style">
                    Style ID : 
                    <input type="text" class="small-text" name="vif-cloudmade-style" value="<?php echo $vif_cloudmade_style; ?>">
                    (default : 997)
                </span>
            </label>
        </p>

        <p class="description">
            <?php _e( '(Save this map to update the preview)', 'lang_viftrips' ); ?>
        </p>

    	<?php
    endif;

    // Export Map
    $meta_export_map = get_post_meta( $post->ID, 'vif_export', true );
    $meta_export_map = ( $meta_export_map == '' ) ? $vif_options['export_maps'] : $meta_export_map;
    ?>

    <p class="mbox-label">
        <?php _e( 'Export', 'lang_viftrips' ); ?>
    </p>

    <p>
        <label for="vif-export">
            <input type="checkbox" id="vif-export" name="vif-export" value="<?php echo VIF_DEFAULT_EXPORT_MAPS; ?>" <?php if ( $meta_export_map == VIF_DEFAULT_EXPORT_MAPS ) { echo 'checked="checked"'; } ?>>
            <?php _e( 'Allow sharing this map (iframe)', 'lang_viftrips' ); ?>
        </label>
    </p>

    <?php

}


/**
 * Save the Metaboxes data
 * @param  Int $post_id ID of the post
 */
function vif_save_mbox_map_infos( $post_id ) {
  
    // Don't do anything for auto-save
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
        return $post_id;

    // No nonce ?
    if( !isset( $_POST['mbox_map_infos_nonce'] ) )
        return $post_id;

    // Check nonce
    if ( !wp_verify_nonce( $_POST['mbox_map_infos_nonce'], plugin_basename( __FILE__ ) ) )
        return;

    // Check permissions
    if ( !current_user_can( 'edit_posts', $post_id ) )
        return;

    // Export map
    $vif_export = ( isset( $_POST['vif-export'] ) && $_POST['vif-export'] == VIF_DEFAULT_EXPORT_MAPS ) ? VIF_DEFAULT_EXPORT_MAPS : 0;
    update_post_meta( $post_id, 'vif_export', $vif_export );

    // If tiles provider choice is displayed
    if ( isset( $_POST['vif-tiles-provider'] ) ) {
        update_post_meta( $post_id, 'vif_tiles_provider', $_POST['vif-tiles-provider'] );
        update_post_meta( $post_id, 'vif_cloudmade_style', $_POST['vif-cloudmade-style'] );
    }

}

add_action( 'save_post', 'vif_save_mbox_map_infos' );