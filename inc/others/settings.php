<?php
/**
 * VifTrips Settings definitions
 *
 * @package VifTrips
 */


// Prevent access to this file directly
if ( !defined( 'ABSPATH' ) ) {
	die( __( 'You should not access to this file directly', 'lang_viftrips' ) );
}


/**
 * Define settings
 */
function vif_register_settings() {
	register_setting( 'vif_options', 'vif_options', 'vif_validate_options' );

	/**
	 * Section Design
	 */
	add_settings_section( 'vif_settings_section_design', __( 'Design', 'lang_viftrips' ), 'vif_settings_section_design_text', 'vif_theme_settings' );

	// Field : Title Color
	add_settings_field( 'vif_settings_field_title_color', __( 'Site Title Color', 'lang_viftrips' ), 'vif_settings_field_title_color_content', 'vif_theme_settings', 'vif_settings_section_design' );

	// Field : Tagline Color
	add_settings_field( 'vif_settings_field_tagline_color', __( 'Site Tagline Color', 'lang_viftrips' ), 'vif_settings_field_tagline_color_content', 'vif_theme_settings', 'vif_settings_section_design' );

	// Field : Primary Color
	add_settings_field( 'vif_settings_field_primary_color', __( 'Primary Color', 'lang_viftrips' ), 'vif_settings_field_primary_color_content', 'vif_theme_settings', 'vif_settings_section_design' );

	// Field : Secondary Color
	add_settings_field( 'vif_settings_field_secondary_color', __( 'Secondary Color', 'lang_viftrips' ), 'vif_settings_field_secondary_color_content', 'vif_theme_settings', 'vif_settings_section_design' );

	/**
	 * Section Maps
	 */
	add_settings_section( 'vif_settings_section_maps', __( 'Maps', 'lang_viftrips' ), 'vif_settings_section_maps_text', 'vif_theme_settings' );

	// Field : Cloudmade API key
	add_settings_field( 'vif_settings_field_cloudmade_api_key', __( 'Cloudmade API key', 'lang_viftrips' ), 'vif_settings_field_cloudmade_api_key_content', 'vif_theme_settings', 'vif_settings_section_maps' );	

	// Field : Maps default tiles provider
	add_settings_field( 'vif_settings_field_maps_default_tiles', __( 'Maps default tiles provider', 'lang_viftrips' ), 'vif_settings_field_maps_default_tiles_content', 'vif_theme_settings', 'vif_settings_section_maps' );

	// Field : Special map default tiles provider
	add_settings_field( 'vif_settings_field_special_map_default_tiles', __( 'Big map default tiles provider', 'lang_viftrips' ), 'vif_settings_field_special_map_default_tiles_content', 'vif_theme_settings', 'vif_settings_section_maps' );

	// Field : Maps default Center and Zoom
	add_settings_field( 'vif_settings_field_maps_default_center_zoom', __( 'Maps default center and zoom', 'lang_viftrips' ), 'vif_settings_field_maps_default_center_zoom_content', 'vif_theme_settings', 'vif_settings_section_maps' );

	// Field : Export Map
	add_settings_field( 'vif_settings_field_maps_export', __( 'Export maps', 'lang_viftrips' ), 'vif_settings_field_maps_export_content', 'vif_theme_settings', 'vif_settings_section_maps' );

	/**
	 * Section Social settings
	 */
	add_settings_section( 'vif_settings_section_social_settings', __( 'Social', 'lang_viftrips' ), 'vif_settings_section_social_settings_text', 'vif_theme_settings' );

	// Field : URL of twitter account
	add_settings_field( 'vif_settings_field_url_twitter', __( 'Twitter URL', 'lang_viftrips' ), 'vif_settings_field_url_twitter_content', 'vif_theme_settings', 'vif_settings_section_social_settings' );

	// Field : URL of facebook account
	add_settings_field( 'vif_settings_field_url_facebook', __( 'Facebook URL', 'lang_viftrips' ), 'vif_settings_field_url_facebook_content', 'vif_theme_settings', 'vif_settings_section_social_settings' );

	// Field : URL of youtube account
	add_settings_field( 'vif_settings_field_url_youtube', __( 'Twitter URL', 'lang_viftrips' ), 'vif_settings_field_url_youtube_content', 'vif_theme_settings', 'vif_settings_section_social_settings' );

	/**
	 * Section General settings
	 */
	add_settings_section( 'vif_settings_section_other_settings', __( 'General', 'lang_viftrips' ), 'vif_settings_section_other_settings_text', 'vif_theme_settings' );

	// Field : Number of maps on front page
	add_settings_field( 'vif_settings_field_front_nb_maps', __( 'Number of maps on front page', 'lang_viftrips' ), 'vif_settings_field_front_nb_maps_content', 'vif_theme_settings', 'vif_settings_section_other_settings' );

	// Field : Keep markers when deleting a map
	add_settings_field( 'vif_settings_field_trip_trash_keep_contents', __( 'When trashing a trip', 'lang_viftrips' ), 'vif_settings_field_trip_trash_keep_contents_content', 'vif_theme_settings', 'vif_settings_section_other_settings' );

	// Field : Keep markers when deleting a map
	add_settings_field( 'vif_settings_field_map_trash_keep_markers', __( 'When trashing a map', 'lang_viftrips' ), 'vif_settings_field_map_trash_keep_markers_content', 'vif_theme_settings', 'vif_settings_section_other_settings' );
	
}


/**
 * Section Maps header text
 */
function vif_settings_section_design_text() {
	// Nothing usefull to display for now
}


/**
 * Field display/fill : vif_settings_field_title_color
 */
function vif_settings_field_title_color_content() {
	$options = get_option( 'vif_options' );
	$title_color = $options['title_color'];
	$title_color = ( $title_color == '' ) ? VIF_DEFAULT_TITLE_COLOR : $title_color;
	?>

	<input type="text" id="setting-title-color" class="regular-text" name="vif_options[title_color]" value="<?php echo $title_color; ?>" data-default-color="<?php echo VIF_DEFAULT_TITLE_COLOR; ?>">

	<?php
}


/**
 * Field display/fill : vif_settings_field_tagline_color
 */
function vif_settings_field_tagline_color_content() {
	$options = get_option( 'vif_options' );
	$tagline_color = $options['tagline_color'];
	$tagline_color = ( $tagline_color == '' ) ? VIF_DEFAULT_TAGLINE_COLOR : $tagline_color;
	?>

	<input type="text" id="setting-tagline-color" class="regular-text" name="vif_options[tagline_color]" value="<?php echo $tagline_color; ?>" data-default-color="<?php echo VIF_DEFAULT_TAGLINE_COLOR; ?>">

	<?php
}


/**
 * Field display/fill : vif_settings_field_primary_color
 */
function vif_settings_field_primary_color_content() {
	$options = get_option( 'vif_options' );
	$primary_color = $options['primary_color'];
	$primary_color = ( $primary_color == '' ) ? VIF_DEFAULT_PRIMARY_COLOR : $primary_color;
	?>

	<input type="text" id="setting-primary-color" class="regular-text" name="vif_options[primary_color]" value="<?php echo $primary_color; ?>" data-default-color="<?php echo VIF_DEFAULT_PRIMARY_COLOR; ?>">

	<?php
}


/**
 * Field display/fill : vif_settings_field_secondary_color
 */
function vif_settings_field_secondary_color_content() {
	$options = get_option( 'vif_options' );
	$secondary_color = $options['secondary_color'];
	$secondary_color = ( $secondary_color == '' ) ? VIF_DEFAULT_SECONDARY_COLOR : $secondary_color;
	?>

	<input type="text" id="setting-secondary-color" class="regular-text" name="vif_options[secondary_color]" value="<?php echo $secondary_color; ?>" data-default-color="<?php echo VIF_DEFAULT_SECONDARY_COLOR; ?>">

	<?php
}


/**
 * Section Maps header text
 */
function vif_settings_section_maps_text() {
	// Nothing usefull to display for now
}


/**
 * Field display/fill : vif_settings_field_cloudmade_api_key
 */
function vif_settings_field_cloudmade_api_key_content() {
	$options = get_option( 'vif_options' );
	$cloudmade_api_key = $options['cloudmade_api_key'];
	?>

	<input type="text" class="regular-text" name="vif_options[cloudmade_api_key]" value="<?php echo $cloudmade_api_key; ?>">
	<p class="description"><?php _e( 'If you want to use Cloudmade tiles provider, you need to <a href="http://cloudmade.com" target="_blank">register on the Cloudmade website</a> and request an API key.', 'lang_viftrips' ); ?></p>

	<?php
}


/**
 * Field display/fill : vif_settings_field_maps_default_tiles
 */
function vif_settings_field_maps_default_tiles_content() {
	$options = get_option( 'vif_options' );
	$tiles_provider = $options['tiles_provider'];
	$cloudmade_style = $options['cloudmade_style'];
	?>

	<p>
		<label title="OpenStreetMap">
			<input type="radio" name="vif_options[tiles_provider]" value="osm" <?php echo ( $tiles_provider == 'osm' ) ? 'checked="checked"' : ''; ?>>
			OpenStreetMap
		</label>
	</p>

	<p>
		<label title="Cloudmade">
			<input type="radio" name="vif_options[tiles_provider]" value="cloudmade" <?php echo ( $tiles_provider == 'cloudmade' ) ? 'checked="checked"' : ''; ?>>
			Cloudmade
			<span class="vif-cloudmade-style">
				Style ID : 
				<input type="text" class="small-text" name="vif_options[cloudmade_style]" value="<?php echo $cloudmade_style; ?>">
				(default : 997)
			</span>
		</label>
	</p>

	<p class="description"><?php _e( 'You can choose a Cloudmade Style ID in <a href="http://maps.cloudmade.com/editor" target="_blank">the CloudMade style Editor</a> : this is the number under each map style.', 'lang_viftrips' ); ?></p>
	<p class="description"><?php _e( 'You can also create your own style by choosing a style in the list and click the "Clone Style" button at the bottom right.', 'lang_viftrips' ); ?></p>

	<?php
}


/**
 * Field display/fill : vif_settings_field_special_map_default_tiles
 */
function vif_settings_field_special_map_default_tiles_content() {
	$options = get_option( 'vif_options' );
	$special_map_tiles_provider = $options['special_map_tiles_provider'];
	$special_map_cloudmade_style = $options['special_map_cloudmade_style'];
	?>

	<p>
		<label title="OpenStreetMap">
			<input type="radio" name="vif_options[special_map_tiles_provider]" value="osm" <?php echo ( $special_map_tiles_provider == 'osm' ) ? 'checked="checked"' : ''; ?>>
			OpenStreetMap
		</label>
	</p>

	<p>
		<label title="Cloudmade">
			<input type="radio" name="vif_options[special_map_tiles_provider]" value="cloudmade" <?php echo ( $special_map_tiles_provider == 'cloudmade' ) ? 'checked="checked"' : ''; ?>>
			Cloudmade
			<span class="vif-cloudmade-style">
				Style ID : 
				<input type="text" class="small-text" name="vif_options[special_map_cloudmade_style]" value="<?php echo $special_map_cloudmade_style; ?>">
				(default : 997)
			</span>
		</label>
	</p>

	<p class="description"><?php _e( 'See above for explanation about Style ID.', 'lang_viftrips' ); ?></p>

	<?php
}


/**
 * Field display/fill : vif_settings_field_maps_default_center_zoom
 */
function vif_settings_field_maps_default_center_zoom_content() {
	$options = get_option( 'vif_options' );
	$lat = $options['center_lat'];
	$lng = $options['center_lng'];
	$zoom = $options['zoom'];
	?>

	<input type="hidden" id="vif-settings-map-lat" class="regular-text" name="vif_options[center_lat]" value="<?php echo $lat; ?>">
	<input type="hidden" id="vif-settings-map-lng" class="regular-text" name="vif_options[center_lng]" value="<?php echo $lng; ?>">
	<input type="hidden" id="vif-settings-map-zoom" class="regular-text" name="vif_options[zoom]" value="<?php echo $zoom; ?>">
	<p class="description"><?php _e( 'Drag and zoom to the desired default position.', 'lang_viftrips' ); ?></p>
	<p class="description"><?php _e( 'This is the default center and zoom when creating a marker or when a map has no markers.', 'lang_viftrips' ); ?></p>

	<div class="vif-leaflet-map-container">
        <div class="vif-leaflet-map-wrap">
            <div id="settings-map" class="vif-leaflet-map"
                data-map-center-lat="<?php echo $lat; ?>"
                data-map-center-lng="<?php echo $lng; ?>"
                data-map-zoom="<?php echo $zoom; ?>"
                data-map-lat-field="vif-settings-map-lat"
                data-map-lng-field="vif-settings-map-lng"
                data-map-zoom-field="vif-settings-map-zoom"></div>
        </div>
    </div>

	<?php
}


/**
 * Field display/fill : vif_settings_field_maps_export
 */
function vif_settings_field_maps_export_content() {
	$options = get_option( 'vif_options' );
	$export_maps = $options['export_maps'];
	?>

	<label for="vif-settings-maps-export">
		<input type="checkbox" id="vif-settings-maps-export" name="vif_options[export_maps]" value="<?php echo VIF_DEFAULT_EXPORT_MAPS; ?>" <?php if ( $export_maps == VIF_DEFAULT_EXPORT_MAPS ) { echo 'checked="checked"'; } ?>>
		<?php _e( 'Maps are shareable by default', 'lang_viftrips' ); ?>
	</label>

	<p class="description"><?php _e( 'If you change this setting, it will only be applied to new maps. You can change this setting in each map\'s form.', 'lang_viftrips' ); ?></p>

	<?php
}


/**
 * Section Social settings header text
 */
function vif_settings_section_social_settings_text() {
	// Nothing usefull to display for now
}


/**
 * Field display/fill : vif_settings_field_url_twitter
 */
function vif_settings_field_url_twitter_content() {
	$options = get_option( 'vif_options' );
	$url_twitter = $options['url_twitter'];
	?>

	<input type="text" class="regular-text" name="vif_options[url_twitter]" value="<?php echo $url_twitter; ?>">

	<?php
}


/**
 * Field display/fill : vif_settings_field_url_facebook
 */
function vif_settings_field_url_facebook_content() {
	$options = get_option( 'vif_options' );
	$url_facebook = $options['url_facebook'];
	?>

	<input type="text" class="regular-text" name="vif_options[url_facebook]" value="<?php echo $url_facebook; ?>">

	<?php
}


/**
 * Field display/fill : vif_settings_field_url_youtube
 */
function vif_settings_field_url_youtube_content() {
	$options = get_option( 'vif_options' );
	$url_youtube = $options['url_youtube'];
	?>

	<input type="text" class="regular-text" name="vif_options[url_youtube]" value="<?php echo $url_youtube; ?>">

	<?php
}


/**
 * Section General settings header text
 */
function vif_settings_section_other_settings_text() {
	// Nothing usefull to display for now
}


/**
 * Field display/fill : vif_settings_field_cloudmade_api_key
 */
function vif_settings_field_front_nb_maps_content() {
	$options = get_option( 'vif_options' );
	$front_nb_maps = $options['front_nb_maps'];
	?>

	<input type="text" class="small-text" name="vif_options[front_nb_maps]" value="<?php echo $front_nb_maps; ?>">

	<?php
}


/**
 * Field display/fill : vif_settings_field_trip_trash_keep_contents
 */
function vif_settings_field_trip_trash_keep_contents_content() {
	$options = get_option( 'vif_options' );
	$trip_trash_keep_contents = $options['trip_trash_keep_contents'];
	?>

	<p>
		<label title="Keep contents">
			<input type="radio" name="vif_options[trip_trash_keep_contents]" value="1" <?php echo ( $trip_trash_keep_contents == 1 ) ? 'checked="checked"' : ''; ?>>
			<?php _e( 'Keep maps and posts (they won\'t belong to any trip until you edit them)', 'lang_viftrips' ); ?>
		</label>
	</p>

	<p>
		<label title="Trash contents">
			<input type="radio" name="vif_options[trip_trash_keep_contents]" value="0" <?php echo ( $trip_trash_keep_contents == 0 ) ? 'checked="checked"' : ''; ?>>
			<?php _e( 'Send maps, markers and posts to trash', 'lang_viftrips' ); ?>
		</label>
	</p>

	<p class="description"><?php _e( 'Note that if you choose to send contents to trash, and want to restore them : the maps and posts won\'t belong to any trip, and the markers won\'t belong to any map.', 'lang_viftrips' ); ?></p>

	<?php
}


/**
 * Field display/fill : vif_settings_field_map_trash_keep_markers
 */
function vif_settings_field_map_trash_keep_markers_content() {
	$options = get_option( 'vif_options' );
	$map_trash_keep_markers = $options['map_trash_keep_markers'];
	?>

	<p>
		<label title="Keep markers">
			<input type="radio" name="vif_options[map_trash_keep_markers]" value="1" <?php echo ( $map_trash_keep_markers == 1 ) ? 'checked="checked"' : ''; ?>>
			<?php _e( 'Keep markers (they won\'t belong to any map until you edit them)', 'lang_viftrips' ); ?>
		</label>
	</p>

	<p>
		<label title="Trash markers">
			<input type="radio" name="vif_options[map_trash_keep_markers]" value="0" <?php echo ( $map_trash_keep_markers == 0 ) ? 'checked="checked"' : ''; ?>>
			<?php _e( 'Send map\'s markers to trash', 'lang_viftrips' ); ?>
		</label>
	</p>

	<p class="description"><?php _e( 'Note that if you choose to send markers to trash, they won\'t belong to any map if you restore them.', 'lang_viftrips' ); ?></p>

	<?php
}


/**
 * Validate User inputs
 * @param  array $user_input  Input data submitted by the user ($_POST)
 * @return array              Sanitized user input data
 */
function vif_validate_options( $user_input ) {

	$vif_options = get_option( 'vif_options' );
	$valid = array();
	$valid_tiles_providers = array( 'osm', 'cloudmade' );


	/**
	 * DESIGN
	 */


	/* Title Color */

	$valid['title_color'] = $user_input['title_color'];

	// if empty, set to default
	if ( $valid['title_color'] == '' ) {
		$valid['title_color'] = VIF_DEFAULT_TITLE_COLOR;
	}

	/* Tagline Color */

	$valid['tagline_color'] = $user_input['tagline_color'];

	// if empty, set to default
	if ( $valid['tagline_color'] == '' ) {
		$valid['tagline_color'] = VIF_DEFAULT_TAGLINE_COLOR;
	}

	/* Primary Color */

	$valid['primary_color'] = $user_input['primary_color'];

	// if empty, set to default
	if ( $valid['primary_color'] == '' ) {
		$valid['primary_color'] = VIF_DEFAULT_PRIMARY_COLOR;
	}

	/* Secondary Color */

	$valid['secondary_color'] = $user_input['secondary_color'];

	// if empty, set to default
	if ( $valid['secondary_color'] == '' ) {
		$valid['secondary_color'] = VIF_DEFAULT_SECONDARY_COLOR;
	}


	/**
	 * MAPS
	 */


	/* Maps default tiles provider */

	$valid['tiles_provider'] = $user_input['tiles_provider'];

	if ( !in_array( $valid['tiles_provider'], $valid_tiles_providers ) ) {
		// Register error
		add_settings_error( 'vif_maps_default_tiles_provider', 'vif_maps_default_tiles_provider_error',
			__( 'The default tiles provider was weird. It has been reset to the default value.', 'lang_viftrips' ),
			'error'
		);
		// Set the field value to default one
		$valid['tiles_provider'] = VIF_DEFAULT_TILES_PROVIDER;
	}


	/* Special map default tiles provider */

	$valid['special_map_tiles_provider'] = $user_input['special_map_tiles_provider'];

	if ( !in_array( $valid['special_map_tiles_provider'], $valid_tiles_providers ) ) {
		// Register error
		add_settings_error( 'vif_special_map_default_tiles_provider', 'vif_special_map_default_tiles_provider_error',
			__( 'The default tiles provider for Big map was weird. It has been reset to the default value.', 'lang_viftrips' ),
			'error'
		);
		// Set the field value to default one
		$valid['special_map_tiles_provider'] = VIF_DEFAULT_TILES_PROVIDER;
	}


	/* Cloudmade API key */

	$valid['cloudmade_api_key'] = preg_replace( '/[^A-Za-z0-9]/', '', $user_input['cloudmade_api_key'] );

	// If user deletes Cloudmade API Key but some maps were using it,
	// reset maps tiles to default tiles provider and warn user
	if ( $vif_options['cloudmade_api_key'] != '' && $valid['cloudmade_api_key'] == '' ) {
		$maps_with_cloudmade = vif_query_get_maps_with_cloudmade();

		if ( count( $maps_with_cloudmade ) > 0 ) {
			
			// Reset those maps to default tiles provider
			foreach ( $maps_with_cloudmade as $m ) {
				update_post_meta( $m->ID, 'vif_tiles_provider', VIF_DEFAULT_TILES_PROVIDER );
			}

			// Warn user
			add_settings_error( 'vif_cloudmade_api_key_deleted', 'vif_cloudmade_api_key_deleted_error',
				'<span class="vif-settings-notice">' . __( 'Settings saved.', 'lang_viftrips' ) . '</span>'
				. ' <span class="vif-settings-notice">' . __( 'Important note', 'lang_viftrips' ) . ' : '
				. __( 'Some of your maps were using Cloudmade as tiles provider, and you choose to delete your Cloudmade API key. In consequence, these maps has been reset to the default tiles provider.', 'lang_viftrips' ) . '</span>',
				'error'
			);

		}

	}

	// If bad formatted
	if ( $valid['cloudmade_api_key'] != $user_input['cloudmade_api_key'] ) {
		// Register error
		add_settings_error( 'vif_cloudmade_api_key', 'vif_cloudmade_api_key_error',
			__( 'The Cloudmade API key is not valid. It must contain only alphanumeric characters. The value has been reset to the default value.', 'lang_viftrips' ),
			'error'
		);
		// Set the field value to default one
		$valid['cloudmade_api_key'] = VIF_DEFAULT_CLOUDMADE_API_KEY;
	}
	// If not 32 characters length
	elseif ( $valid['cloudmade_api_key'] != '' && strlen( $valid['cloudmade_api_key'] ) != 32 ) {
		// Register error
		add_settings_error( 'vif_cloudmade_api_key', 'vif_cloudmade_api_key_error',
			__( 'The Cloudmade API key is not valid. It must contain at least 32 characters. The value has been reset to the default value.', 'lang_viftrips' ),
			'error'
		);
		// Set the field value to default one
		$valid['cloudmade_api_key'] = VIF_DEFAULT_CLOUDMADE_API_KEY;
	}

	// If CloudMade is choosen for Maps, check if the API Key is set
	if ( $valid['tiles_provider'] == 'cloudmade' && $valid['cloudmade_api_key'] == VIF_DEFAULT_CLOUDMADE_API_KEY ) {
		// Register error
		add_settings_error( 'vif_default_tiles_provider', 'vif_default_tiles_provider_error',
			__( 'If you want to set the tiles provider to CloudMade for maps, you must give a Cloudmade API Key. The tiles provider has been reset to the default value.', 'lang_viftrips' ),
			'error'
		);
		// Set the field value to default one
		$valid['tiles_provider'] = VIF_DEFAULT_TILES_PROVIDER;
	}

	// If CloudMade is choosen for the special map, check if the API Key is set
	if ( $valid['special_map_tiles_provider'] == 'cloudmade' && $valid['cloudmade_api_key'] == VIF_DEFAULT_CLOUDMADE_API_KEY ) {
		// Register error
		add_settings_error( 'vif_special_map_default_tiles_provider', 'vif_special_map_default_tiles_provider_error',
			__( 'If you want to set the tiles provider for the big map to CloudMade, you must give a Cloudmade API Key. The tiles provider has been reset to the default value.', 'lang_viftrips' ),
			'error'
		);
		// Set the field value to default one
		$valid['special_map_tiles_provider'] = VIF_DEFAULT_TILES_PROVIDER;
	}


	/* Maps default Cloudmade Style */

	$valid['cloudmade_style'] = $user_input['cloudmade_style'];

	// If not empty but not integer
	if ( $valid['cloudmade_style'] != '' && preg_match( '/[^0-9]+/', $valid['cloudmade_style'] ) ) {
		// Register error
		add_settings_error( 'vif_default_cloudmade_style', 'vif_default_cloudmade_style_error',
			__( 'The default CloudMade Style for maps must be an integer. It has been reset to the default value.', 'lang_viftrips' ),
			'error'
		);
		// Set the field value to default one
		$valid['cloudmade_style'] = VIF_DEFAULT_CLOUDMADE_STYLE;
	}

	// if empty, set to default
	if ( $valid['cloudmade_style'] == '' || $valid['cloudmade_style'] == 0 ) {
		$valid['cloudmade_style'] = VIF_DEFAULT_CLOUDMADE_STYLE;
	}


	/* Special Map default Cloudmade Style */

	$valid['special_map_cloudmade_style'] = $user_input['special_map_cloudmade_style'];

	// If not empty but not integer
	if ( $valid['special_map_cloudmade_style'] != '' && preg_match( '/[^0-9]+/', $valid['special_map_cloudmade_style'] ) ) {
		// Register error
		add_settings_error( 'vif_default_special_map_cloudmade_style', 'vif_default_special_map_cloudmade_style_error',
			__( 'The default CloudMade Style for the Big map must be an integer. It has been reset to the default value.', 'lang_viftrips' ),
			'error'
		);
		// Set the field value to default one
		$valid['special_map_cloudmade_style'] = VIF_DEFAULT_CLOUDMADE_STYLE;
	}

	// if empty, set to default
	if ( $valid['special_map_cloudmade_style'] == '' || $valid['special_map_cloudmade_style'] == 0 ) {
		$valid['special_map_cloudmade_style'] = VIF_DEFAULT_CLOUDMADE_STYLE;
	}


	/* Map Position and Zoom */

	$valid['center_lat'] = ( $user_input['center_lat'] != '' ) ? $user_input['center_lat'] : VIF_DEFAULT_MAP_CENTER_LAT ;
	$valid['center_lng'] = ( $user_input['center_lng'] != '' ) ? $user_input['center_lng'] : VIF_DEFAULT_MAP_CENTER_LNG ;
	$valid['zoom'] = ( $user_input['zoom'] != '' ) ? $user_input['zoom'] : VIF_DEFAULT_MAP_ZOOM ;


	/* Export Maps */
	$valid['export_maps'] = ( $user_input['export_maps'] == VIF_DEFAULT_EXPORT_MAPS ) ? VIF_DEFAULT_EXPORT_MAPS : 0;


	/**
	 * SOCIAL
	 */
	
	$valid['url_twitter'] = $user_input['url_twitter'];
	$valid['url_facebook'] = $user_input['url_facebook'];
	$valid['url_youtube'] = $user_input['url_youtube'];


	/**
	 * GENERAL
	 */


	/* Number of maps on front page */

	$valid['front_nb_maps'] = $user_input['front_nb_maps'];

	if ( $valid['front_nb_maps'] != '' && preg_match( '/[^0-9]+/', $valid['front_nb_maps'] ) ) {
		// Register error
		add_settings_error( 'vif_front_nb_maps', 'vif_front_nb_maps_error',
			  __( 'The number of maps on front must be an integer. It has been reset to the default value.', 'lang_viftrips' ),
			  'error'
		);
		// Set the field value to default one
		$valid['front_nb_maps'] = VIF_DEFAULT_FRONT_NB_MAPS;
	}

	// if empty, set to default
	if ( $valid['front_nb_maps'] == '' || $valid['front_nb_maps'] == 0 ) {
		$valid['front_nb_maps'] = VIF_DEFAULT_FRONT_NB_MAPS;
	}


	/* When trashning a trip */

	$valid['trip_trash_keep_contents'] = $user_input['trip_trash_keep_contents'];

	if ( $valid['trip_trash_keep_contents'] != 0 ) {
		$valid['trip_trash_keep_contents'] = VIF_DEFAULT_TRIP_TRASH_KEEP_CONTENTS;
	}


	/* When trashning a map */

	$valid['map_trash_keep_markers'] = $user_input['map_trash_keep_markers'];

	if ( $valid['map_trash_keep_markers'] != 0 ) {
		$valid['map_trash_keep_markers'] = VIF_DEFAULT_MAP_TRASH_KEEP_MARKERS;
	}

	return $valid;

}