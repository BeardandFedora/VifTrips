<?php
/**
 * VifTrips Admin Menus
 *
 * @package VifTrips
 */


/**
 * Add admin menus
 * - Theme Settings page
 */
function vif_admin_menu() {
	// Main Menu
	add_menu_page( __( 'Theme settings', 'lang_viftrips' ), __( 'VifTrips', 'lang_viftrips' ), 'delete_others_posts', 'vif_viftrips_page', 'vif_viftrips_page_content', 'dashicons-admin-generic', '100');

	// Submenus
	add_submenu_page( 'vif_viftrips_page', __( 'Help - Credits', 'lang_viftrips' ), __( 'Help - Credits', 'lang_viftrips' ), 'delete_others_posts', 'vif_viftrips_page_help', 'vif_viftrips_page_help' . '_content' );
	
	// Fix the title of the 1st submenu which is the same link than the top level but not the same text
	global $submenu;
	
	if ( isset( $submenu['vif_viftrips_page'] ) ) {
		$submenu['vif_viftrips_page'][0][0] = __( 'Theme settings', 'lang_viftrips' );
	}
}

add_action( 'admin_menu', 'vif_admin_menu' );


/**
 * Theme settings page content
 */
function vif_viftrips_page_content() {
	?>

	<div id="page_settings" class="wrap">
  
		<div id="icon-options-general" class="icon32"><br></div>
		<h2><?php _e( 'Theme settings', 'lang_viftrips' ); ?></h2>

		<?php settings_errors(); ?>

		<form action="options.php" method="post">

			<?php
			settings_fields( 'vif_options' );
			do_settings_sections( 'vif_theme_settings' );
			?>

			<p class="submit">
				<input type="submit" name="Submit" value="<?php _e( 'Save changes', 'lang_viftrips' ); ?>" class="button-primary">
			</p>

		</form>

	</div>

	<?php
}


/**
 * Help Page Content
 */
function vif_viftrips_page_help_content() {

	require_once( VIF_PATH_OTHERS . '/help.php' );

}