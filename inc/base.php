<?php
/**
 * VifTrips Base Variables
 *
 * @package VifTrips
 */

$upload_dir = wp_upload_dir();


/* SOME INTERESTING VARS */

define( 'VIF_THEME_VERSION', '0.1.3' );

define( 'VIF_DEFAULT_MARKER_FILE', '0000.png' );
define( 'VIF_CUSTOM_MARKERS_ICONS_DIRNAME', 'markers-icons' );

define( 'VIF_IMAGE_SIZE_FRONT_MAP_FIMG_WIDTH', 400 );
define( 'VIF_IMAGE_SIZE_FRONT_MAP_FIMG_HEIGHT', 250 );
define( 'VIF_IMAGE_SIZE_MARKER_POPUP_WIDTH', 250 );
define( 'VIF_IMAGE_SIZE_MARKER_POPUP_HEIGHT', 150 );
define( 'VIF_IMAGE_SIZE_MARKER_POPUP_RIBBON_WIDTH', 250 );
define( 'VIF_IMAGE_SIZE_MARKER_POPUP_RIBBON_HEIGHT', 100 );
define( 'VIF_IMAGE_SIZE_TRIP_THUMB_WIDTH', 400 );
define( 'VIF_IMAGE_SIZE_TRIP_THUMB_HEIGHT', 300 );
define( 'VIF_IMAGE_SIZE_POST_THUMB_IN_LIST_WIDTH', 250 );
define( 'VIF_IMAGE_SIZE_POST_THUMB_IN_LIST_HEIGHT', 250 );

define( 'VIF_DEFAULT_TRIPS_DISPLAYED_IN_LIST_MIN', 2 );
define( 'VIF_DEFAULT_TRIPS_DISPLAYED_IN_LIST_MED', 4 );
define( 'VIF_DEFAULT_TRIPS_DISPLAYED_IN_LIST_MAX', 15 );

define( 'VIF_DEFAULT_EXCERPT_LENGTH', 60 );
define( 'VIF_DEFAULT_EXCERPT_SIDE_POST', 35 );
define( 'VIF_DEFAULT_EXCERPT_POST_IN_TRIP_LIST', 45 );

define( 'VIF_NB_OTHER_CONTENTS_IN_SAME_TRIP_TRIGGER_LAST_MAPS', 2 );
define( 'VIF_NB_SIDE_LAST_MAPS', 4 );
define( 'VIF_WIDGET_POSTS_IN_CATEGORY_NB_POSTS', 5 );
define( 'VIF_DEFAULT_EXPORT_MAP_HEIGHT', 400 );

/* THEME SETTINGS */

define( 'VIF_DEFAULT_TITLE_COLOR', '#86A2C2' );
define( 'VIF_DEFAULT_TAGLINE_COLOR', '#FFFFFF' );
define( 'VIF_DEFAULT_PRIMARY_COLOR', '#86A2C2' );
define( 'VIF_DEFAULT_SECONDARY_COLOR', '#39526E' );
define( 'VIF_DEFAULT_TILES_PROVIDER', 'osm' );
define( 'VIF_DEFAULT_CLOUDMADE_API_KEY', '' );
define( 'VIF_DEFAULT_CLOUDMADE_STYLE', 997 );
define( 'VIF_DEFAULT_MAP_CENTER_LAT', '47.9005296' );
define( 'VIF_DEFAULT_MAP_CENTER_LNG', '1.9137456' );
define( 'VIF_DEFAULT_MAP_ZOOM', 12 );
define( 'VIF_DEFAULT_EXPORT_MAPS', 1 );
define( 'VIF_DEFAULT_URL_TWITTER', '' );
define( 'VIF_DEFAULT_URL_FACEBOOK', '' );
define( 'VIF_DEFAULT_URL_YOUTUBE', '' );
define( 'VIF_DEFAULT_FRONT_NB_MAPS', 12 );
define( 'VIF_DEFAULT_TRIP_TRASH_KEEP_CONTENTS', 1 );
define( 'VIF_DEFAULT_MAP_TRASH_KEEP_MARKERS', 1 );

/* PATHS */

define( 'VIF_PATH_INC', get_template_directory() . '/inc' );
define( 'VIF_PATH_CPT', VIF_PATH_INC . '/cpt' );
define( 'VIF_PATH_IMAGES', get_template_directory() . '/images' );
define( 'VIF_PATH_LANGUAGES', get_template_directory() . '/languages' );
define( 'VIF_PATH_MBOX', VIF_PATH_INC . '/mbox' );
define( 'VIF_PATH_OTHERS', VIF_PATH_INC . '/others' );

define( 'VIF_PATH_DEFAULT_MARKERS_ICONS', VIF_PATH_IMAGES . '/markers-icons' );
define( 'VIF_PATH_DEFAULT_MARKERS_SHADOWS', VIF_PATH_DEFAULT_MARKERS_ICONS . '/shadows' );
define( 'VIF_PATH_CUSTOM_MARKERS_ICONS', WP_CONTENT_DIR . '/' . VIF_CUSTOM_MARKERS_ICONS_DIRNAME );
define( 'VIF_PATH_CUSTOM_MARKERS_SHADOWS', VIF_PATH_CUSTOM_MARKERS_ICONS . '/shadows' );

/* URLS */

define( 'VIF_URL_CSS', get_template_directory_uri() . '/css' );
define( 'VIF_URL_INC', get_template_directory_uri() . '/inc' );
define( 'VIF_URL_IMAGES', get_template_directory_uri() . '/images' );
define( 'VIF_URL_JS', get_template_directory_uri() . '/js' );
define( 'VIF_URL_LIBS', get_template_directory_uri() . '/libs' );
define( 'VIF_URL_LEAFLET', VIF_URL_LIBS . '/leaflet' );

define( 'VIF_URL_DEFAULT_MARKERS_ICONS', VIF_URL_IMAGES . '/markers-icons' );
define( 'VIF_URL_DEFAULT_MARKERS_SHADOWS', VIF_URL_DEFAULT_MARKERS_ICONS . '/shadows' );
define( 'VIF_URL_CUSTOM_MARKERS_ICONS', WP_CONTENT_URL . '/' . VIF_CUSTOM_MARKERS_ICONS_DIRNAME );
define( 'VIF_URL_CUSTOM_MARKERS_SHADOWS', VIF_URL_CUSTOM_MARKERS_ICONS . '/shadows' );

define( 'VIF_URL_IMAGE_LOADING', VIF_URL_IMAGES . '/loading.gif' );

define( 'VIF_URL_MEDIAELEMENT', includes_url() . 'js/mediaelement' );