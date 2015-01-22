<?php
/**
 * Metabox : "Trip"
 * Post types : post, maps
 * Goal : Choose a trip for a post or a map
 *
 * @package VifTrips
 */


/**
 * Register Metabox
 */
function vif_mbox_trip_infos() {
  	add_meta_box( 'mbox_trip_infos', __( 'Additionnal Information', 'lang_viftrips' ), 'vif_mbox_trip_infos_content', 'trips', 'normal', 'core' );
}

add_action( 'add_meta_boxes', 'vif_mbox_trip_infos' );


/**
 * Content of the Metabox
 * @param object $post Post Object
 */
function vif_mbox_trip_infos_content( $post ) {

    // Get fields values
    $vif_owner = get_post_meta( $post->ID, 'vif_owner', true );
    $vif_website = get_post_meta( $post->ID, 'vif_website', true );
    $vif_date = get_post_meta( $post->ID, 'vif_date', true );
    $vif_twitter = get_post_meta( $post->ID, 'vif_twitter', true );
    $vif_facebook = get_post_meta( $post->ID, 'vif_facebook', true );
    $vif_file = get_post_meta( $post->ID, 'vif_file', true );

    // Nonce Field
    wp_nonce_field( plugin_basename( __FILE__ ), 'mbox_trip_infos_nonce' );

    // Display HTML
    ?>
    
    <table class="mbox-fields-table">
        
        <thead class="visuallyhidden">
            <tr>
                <th>
                    <?php _e( 'Field name', 'lang_viftrips' ); ?>
                </th>

                <th>
                    <?php _e( 'Field value', 'lang_viftrips' ); ?>
                </th>
            </tr>
        </thead>

        <tbody>
            <tr>
                <td class="mbox-field-name">
                    <label for="vif-owner"><?php _e( 'Trip initiator', 'lang_viftrips' ); ?></label>
                </td>
                <td class="mbox-field-value">
                    <p><input type="text" name="vif-owner" id="vif-owner" value="<?php echo $vif_owner; ?>"></p>
                </td>
            </tr>
            <tr>
                <td class="mbox-field-name">
                    <label for="vif-website"><?php _e( 'Initiator website URL', 'lang_viftrips' ); ?></label>
                </td>
                <td class="mbox-field-value">
                    <p><input type="text" name="vif-website" id="vif-website" value="<?php echo $vif_website; ?>"></p>
                </td>
            </tr>
            <tr>
                <td class="mbox-field-name">
                    <label for="vif-date"><?php _e( 'Trip start date', 'lang_viftrips' ); ?></label>
                </td>
                <td class="mbox-field-value">
                    <p><input type="text" name="vif-date" id="vif-date" value="<?php echo $vif_date; ?>"></p>
                </td>
            </tr>
            <tr>
                <td class="mbox-field-name">
                    <label for="vif-twitter"><?php _e( 'Trip\'s Twitter URL', 'lang_viftrips' ); ?></label>
                </td>
                <td class="mbox-field-value">
                    <p><input type="text" name="vif-twitter" id="vif-twitter" value="<?php echo $vif_twitter; ?>"></p>
                </td>
            </tr>
            <tr>
                <td class="mbox-field-name">
                    <label for="vif-facebook"><?php _e( 'Trip\'s Facebook URL', 'lang_viftrips' ); ?></label>
                </td>
                <td class="mbox-field-value">
                    <p><input type="text" name="vif-facebook" id="vif-facebook" value="<?php echo $vif_facebook; ?>"></p>
                </td>
            </tr>
            <tr>
                <td class="mbox-field-name">
                    <label><?php _e( 'Attached file', 'lang_viftrips' ); ?></label>
                </td>
                <td class="mbox-field-value">
                    <input type="hidden" name="vif-file" value="<?php echo $vif_file; ?>">
                    <div class="mbox-trip-infos-file-preview">
                        <?php if ( $vif_file != '' ) : ?>
                            <p>
                                <?php echo wp_get_attachment_link( $vif_file, '' ); ?>
                            </p>
                        <?php endif; ?>
                    </div>
                    <p class="mbox-trip-infos-file-buttons">
                        <a href="" class="mbox-trip-infos-choose-file" <?php if ( $vif_file != '' ) { echo 'style="display:none"'; } ?>>
                            <?php _e( 'Choose a file', 'lang_viftrips' ); ?>
                        </a>
                        <a href="" class="mbox-trip-infos-delete-file" <?php if ( $vif_file == '' ) { echo 'style="display:none"'; } ?>>
                            <?php _e( 'Remove file', 'lang_viftrips' ); ?>
                        </a>
                    </p>
                </td>
            </tr>
        </tbody>

    </table>

    <?php
}


/**
 * Save the Metaboxes data
 * @param  Int $post_id ID of the post
 */
function vif_save_mbox_trip_infos( $post_id ) {
  
    // Don't do anything for auto-save
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
        return $post_id;

    // No nonce ?
    if( !isset( $_POST['mbox_trip_infos_nonce'] ) )
        return $post_id;

    // Check nonce
    if ( !wp_verify_nonce( $_POST['mbox_trip_infos_nonce'], plugin_basename( __FILE__ ) ) )
        return;

    // Check permissions
    if ( !current_user_can( 'edit_posts', $post_id ) )
        return;

    if ( isset( $_POST['vif-website'] ) && isset( $_POST['vif-owner'] ) ) {

        $vif_website = trim( $_POST['vif-website'] );
        update_post_meta( $post_id, 'vif_website', $vif_website );

        $vif_owner = trim( $_POST['vif-owner'] );
        update_post_meta( $post_id, 'vif_owner', $vif_owner );

        $vif_date = trim( $_POST['vif-date'] );
        update_post_meta( $post_id, 'vif_date', $vif_date );

        $vif_twitter = trim( $_POST['vif-twitter'] );
        update_post_meta( $post_id, 'vif_twitter', $vif_twitter );

        $vif_facebook = trim( $_POST['vif-facebook'] );
        update_post_meta( $post_id, 'vif_facebook', $vif_facebook );

        $vif_file = trim( $_POST['vif-file'] );
        update_post_meta( $post_id, 'vif_file', $vif_file );

    }

}

add_action( 'save_post', 'vif_save_mbox_trip_infos' );