<?php
/**
 * VifTrips Admin funtions
 *
 * @package VifTrips
 */


/**
 * Require Admin utils functions
 */
require_once( VIF_PATH_INC . '/functions-admin-utils.php' );


/**
 * Register Metaboxes
 */
require_once( VIF_PATH_MBOX . '/trips-list.php' );
require_once( VIF_PATH_MBOX . '/trip-infos.php' );
require_once( VIF_PATH_MBOX . '/map-preview.php' );
require_once( VIF_PATH_MBOX . '/map-infos.php' );
require_once( VIF_PATH_MBOX . '/marker-infos.php' );


/**
 * Add custom colums and filters in listings
 */
require_once( VIF_PATH_OTHERS . '/custom-listing-columns.php' );
require_once( VIF_PATH_OTHERS . '/custom-listing-filters.php' );


/**
 * Add Theme Settings page
 */
require_once( VIF_PATH_OTHERS . '/admin-menus.php' );


/**
 * Admin Init
 * - Register settings fields
 */
function vif_admin_init() {

    // Register settings
    if ( current_user_can( 'delete_others_posts' ) ) {
        require( VIF_PATH_OTHERS . '/settings.php' );
        vif_register_settings();
    }
    
}

add_action( 'admin_init', 'vif_admin_init' );


/**
 * Enqueue CSS and JS for Admin
 */
function vif_admin_enqueue_scripts( $hook ) {
    global $post_type, $pagenow;
    $vif_options = get_option( 'vif_options' );

	// Admin CSS
	wp_enqueue_style( 'vif_admin_css', VIF_URL_CSS . '/admin.css', array(), VIF_THEME_VERSION, 'all' );

    // For Map / Marker Forms and settings page
    if ( $post_type == 'markers' || $post_type == 'maps' || ( $pagenow == 'admin.php' && isset( $_GET['page'] ) && $_GET['page'] == 'vif_viftrips_page' ) ) {

        // Leaflet CSS
        wp_enqueue_style( 'vif_leaflet_css', VIF_URL_LEAFLET . '/leaflet.css', array(), VIF_THEME_VERSION, 'all' );

        // Custom Leaflet CSS
        wp_enqueue_style( 'vif_leaflet_map_css', VIF_URL_CSS . '/leaflet-map.css', array(), VIF_THEME_VERSION, 'all' );

        // Leaflet JS
        wp_enqueue_script( 'vif_leaflet_js', VIF_URL_LEAFLET . '/leaflet.js', array( 'jquery' ), VIF_THEME_VERSION, true );

        // Custom Leaflet JS
        wp_enqueue_script( 'vif_leaflet_wrapper_js', VIF_URL_JS . '/leaflet-wrapper.js', array( 'jquery', 'vif_leaflet_js' ), VIF_THEME_VERSION, true );

    }

    // For Settings page
    if ( $pagenow == 'admin.php' && isset( $_GET['page'] ) && $_GET['page'] == 'vif_viftrips_page' ) {
        wp_enqueue_script( 'wp-color-picker' );
        wp_enqueue_style( 'wp-color-picker' );
    }

    // MediaElement CSS for Map / Marker Forms
    if ( $post_type == 'markers' || $post_type == 'maps' ) {

        // MediaElement CSS
        wp_enqueue_style( 'mediaelement' );
        wp_enqueue_style( 'wp-mediaelement' );

    }

    // Admin JS
    wp_enqueue_script( 'vif_admin_js', VIF_URL_JS . '/admin.js', array( 'jquery' ), VIF_THEME_VERSION, true );

    // Some global vars
    wp_localize_script( 'jquery', 'gpGlobalVars', vif_js_global_vars() );

    // Some i18n
    wp_localize_script( 'jquery', 'gpGlobalI18n', vif_js_i18n() );

}

add_action( 'admin_enqueue_scripts', 'vif_admin_enqueue_scripts' );


/*
 * Customise the WYSIWYG buttons
 */
function vif_custom_wysiwyg_buttons( $init ) {
  	// block formats available
  	$init['theme_advanced_blockformats'] = 'p,h2,h3,h4,h5';
  	// some buttons suppressed
  	$init['theme_advanced_disable'] = 'blockquote,pastetext,pasteword,justifyfull';
  	return $init;
}

add_filter( 'tiny_mce_before_init', 'vif_custom_wysiwyg_buttons' );


/**
 * Add custom posts types counts to Dashboard widget
 */
function vif_add_cpt_counts_to_dashboard_glance_items() {
    $output = array();

    // Trips
    $nbTrips = wp_count_posts( 'trips' );
    $nbTripsPublished = $nbTrips->publish;
    $tripsText = _n( __( 'Trip', 'lang_viftrips' ), __( 'Trips', 'lang_viftrips' ), $nbTripsPublished );

    // Maps
    $nbMaps = wp_count_posts( 'maps' );
    $nbMapsPublished = $nbMaps->publish;
    $mapsText = _n( __( 'Map', 'lang_viftrips' ), __( 'Maps', 'lang_viftrips' ), $nbMapsPublished );

    // Markers
    $nbMarkers = wp_count_posts( 'markers' );
    $nbMarkersPublished = $nbMarkers->publish;
    $markersText = _n( __( 'Marker', 'lang_viftrips' ), __( 'Markers', 'lang_viftrips' ), $nbMarkersPublished );

    // Can the current user clic on numbers ?
    if ( current_user_can( 'edit_posts' ) ) {
        $output[] = '<a href="edit.php?post_type=trips">' . $nbTripsPublished . ' ' . $tripsText . '</a>';
        $output[] = '<a href="edit.php?post_type=maps">' . $nbMapsPublished . ' ' . $mapsText . '</a>';
        $output[] = '<a href="edit.php?post_type=markers">' . $nbMarkersPublished . ' ' . $markersText . '</a>';
    } else {
        $output[] = $nbTripsPublished . ' ' . $tripsText;
        $output[] = $nbMapsPublished . ' ' . $mapsText;
        $output[] = $nbMarkersPublished . ' ' . $markersText;
    }

    return $output;

}

add_filter( 'dashboard_glance_items', 'vif_add_cpt_counts_to_dashboard_glance_items' );


/**
 * Hide Wordpress Update notice for all but admin
 */
function vif_hide_update_notice_to_all_but_admin_users() 
{
    if ( !current_user_can( 'update_core' ) ) {
        remove_action( 'admin_notices', 'update_nag', 3 );
    }
}

add_action( 'admin_notices', 'vif_hide_update_notice_to_all_but_admin_users', 1 );


/**
 * Modify the admin footer text
 */
function vif_admin_footer_text () {
    bloginfo( 'description' );
}

add_filter( 'admin_footer_text', 'vif_admin_footer_text' );