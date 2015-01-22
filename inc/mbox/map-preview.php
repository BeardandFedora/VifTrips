<?php
/**
 * Metabox : "Map Preview"
 * Post types : maps
 *
 * @package VifTrips
 */


/**
 * Register Metabox
 */
function vif_mbox_map_preview() {
  	add_meta_box( 'mbox_map_preview', __( 'Map Preview', 'lang_viftrips' ), 'vif_mbox_map_preview_content', 'maps', 'normal', 'core' );
}

add_action( 'add_meta_boxes', 'vif_mbox_map_preview' );


/**
 * Content of the Metabox
 * @param object $post Post Object
 */
function vif_mbox_map_preview_content( $post ) {
	$map_id = ( $post->post_status == 'auto-draft' ) ? 0 : $post->ID;
    
    $map_tiles_provider = get_post_meta( $post->ID, 'vif_tiles_provider', true );
    if ( $map_tiles_provider == '' ) {
        $map_tiles_provider = VIF_DEFAULT_TILES_PROVIDER;
    }

    if ( $map_tiles_provider == 'cloudmade' ) {
        $map_cloudmade_style = get_post_meta( $post->ID, 'vif_cloudmade_style', true );
        if ( $map_cloudmade_style == '' ) {
            $map_cloudmade_style = VIF_DEFAULT_CLOUDMADE_STYLE;
        }
    }
	?>

    <p class="mbox-map-add-markers">
        <?php printf(
            '<a href="%1$s">%2$s</a> <span>(%3$s)</span>',
            admin_url( 'post-new.php?post_type=markers&map=' . $map_id ),
            __( 'Add markers in this map', 'lang_viftrips' ),
            __( 'Save this map before clicking', 'lang_viftrips' )
        ); ?>
    </p>
	
	<div class="vif-leaflet-map-container">
        <div class="vif-leaflet-map-wrap">
            <div id="mbox-map-preview-map" class="vif-leaflet-map"
            	data-map-id="<?php echo $map_id; ?>"
            	data-map-tiles="<?php echo $map_tiles_provider; ?>"
                <?php if ( isset( $map_cloudmade_style ) ) : ?>
                    data-map-cloudmade-style="<?php echo $map_cloudmade_style; ?>"
                <?php endif; ?>
            	data-map-clusterize="1"></div>
        </div>
    </div>

	<?php
}