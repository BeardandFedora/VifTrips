<?php
/**
 * VifTrips JS i18n
 *
 * @package VifTrips
 */


/**
 * Global Vars for JS
 * @return array Global vars
 */
function vif_js_global_vars() {
    $vif_options = get_option( 'vif_options' );

    return array(
        'ajaxurl'                   => admin_url( 'admin-ajax.php' ),
        'cloudmadeApiKey'           => ( $vif_options['cloudmade_api_key'] != VIF_DEFAULT_CLOUDMADE_API_KEY ) ? $vif_options['cloudmade_api_key'] : VIF_DEFAULT_CLOUDMADE_API_KEY,
        'defaultMapCenterLat'       => $vif_options['center_lat'],
        'defaultMapCenterLng'       => $vif_options['center_lng'],
        'defaultMapZoom'            => $vif_options['zoom'],
        'defaultCloudmadeStyle'     => $vif_options['cloudmade_style'],
        'defaultMarkerIconFilename' => VIF_DEFAULT_MARKER_FILE,
        'urlToDefaultMarkersIcons'  => VIF_URL_DEFAULT_MARKERS_ICONS,
        'urlToCustomMarkersIcons'   => VIF_URL_CUSTOM_MARKERS_ICONS,
        'urlToLoadingImg'           => VIF_URL_IMAGE_LOADING,
        'urlMediaelementLib'        => VIF_URL_MEDIAELEMENT . '/mediaelement-and-player.min.js',
        'defaultExportMapHeight'    => VIF_DEFAULT_EXPORT_MAP_HEIGHT
    );
    
}


