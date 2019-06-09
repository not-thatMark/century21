<?php
/**
 * Adds a meta box to the post editing screen
 */
function amora_custom_meta() {
    add_meta_box( 'amora_meta', __( 'Display Options', 'amora' ), 'amora_meta_callback', 'page','side','high' );
}
add_action( 'add_meta_boxes', 'amora_custom_meta' );

/**
 * Outputs the content of the meta box
 */
 
function amora_meta_callback( $post ) {
    wp_nonce_field( basename( __FILE__ ), 'amora_nonce' );
    $amora_stored_meta = get_post_meta( $post->ID );
    ?>
    
    <p>
	    <div class="amora-row-content">

        <label for="enable-fp-posts">
            <input type="checkbox" name="enable-fp-posts" id="enable-fp-posts" value="yes" <?php if ( isset ( $amora_stored_meta['enable-fp-posts'] ) ) checked( $amora_stored_meta['enable-fp-posts'][0], 'yes' ); ?> />
            <?php _e( 'Enable Featured Posts Area', 'amora' )?>
        </label>
        <br />

	        <label for="enable-slider">
	            <input type="checkbox" name="enable-slider" id="enable-slider" value="yes" <?php if ( isset ( $amora_stored_meta['enable-slider'] ) ) checked( $amora_stored_meta['enable-slider'][0], 'yes' ); ?> />
	            <?php _e( 'Enable Slider', 'amora' )?>
	        </label>
	        <br />
	        <label for="enable-showcase">
	            <input type="checkbox" name="enable-showcase" id="enable-showcase" value="yes" <?php if ( isset ( $amora_stored_meta['enable-showcase'] ) ) checked( $amora_stored_meta['enable-showcase'][0], 'yes' ); ?> />
	            <?php _e( 'Enable Custom Showcase', 'amora' )?>
	        </label>
	        <br />

<!--	        <label for="enable-sqbx">-->
<!--	            <input type="checkbox" name="enable-sqbx" id="enable-sqbx" value="yes" --><?php //if ( isset ( $amora_stored_meta['enable-sqbx'] ) ) checked( $amora_stored_meta['enable-sqbx'][0], 'yes' ); ?><!-- />-->
<!--	            --><?php //_e( 'Enable Square Boxes and Slider(Products)', 'amora' )?>
<!--	        </label>-->
<!--	        <br />-->
	        
<!--	        <label for="enable-coverflow">-->
<!--	            <input type="checkbox" name="enable-coverflow" id="enable-coverflow" value="yes" --><?php //if ( isset ( $amora_stored_meta['enable-coverflow'] ) ) checked( $amora_stored_meta['enable-coverflow'][0], 'yes' ); ?><!-- />-->
<!--	            --><?php //_e( 'Enable CoverFlow (Products)', 'amora' )?>
<!--	        </label>-->
<!--	        <br />-->
<!--	        <label for="enable-sqbx-posts">-->
<!--	            <input type="checkbox" name="enable-sqbx-posts" id="enable-sqbx-posts" value="yes" --><?php //if ( isset ( $amora_stored_meta['enable-sqbx-posts'] ) ) checked( $amora_stored_meta['enable-sqbx-posts'][0], 'yes' ); ?><!-- />-->
<!--	            --><?php //_e( 'Enable Square Boxes and Slider(Posts)', 'amora' )?>
<!--	        </label>-->
	        <br />
	        <label for="enable-fn1">
	            <input type="checkbox" name="enable-fn1" id="enable-fn1" value="yes" <?php if ( isset ( $amora_stored_meta['enable-fn1'] ) ) checked( $amora_stored_meta['enable-fn1'][0], 'yes' ); ?> />
	            <?php _e( 'Enable Featured News Area 1', 'amora' )?>
	        </label>
	        <br />
	        <label for="enable-fn2">
	            <input type="checkbox" name="enable-fn2" id="enable-fn2" value="yes" <?php if ( isset ( $amora_stored_meta['enable-fn2'] ) ) checked( $amora_stored_meta['enable-fn2'][0], 'yes' ); ?> />
	            <?php _e( 'Enable Featured News Area 2', 'amora' )?>
	        </label>
	        <br />
	        <label for="enable-fn3">
	            <input type="checkbox" name="enable-fn3" id="enable-fn3" value="yes" <?php if ( isset ( $amora_stored_meta['enable-fn3'] ) ) checked( $amora_stored_meta['enable-fn3'][0], 'yes' ); ?> />
	            <?php _e( 'Enable Featured News Area 3', 'amora' )?>
	        </label>
	        <br />

<!--	        <label for="enable-grid">-->
<!--	            <input type="checkbox" name="enable-grid" id="enable-grid" value="yes" --><?php //if ( isset ( $amora_stored_meta['enable-grid'] ) ) checked( $amora_stored_meta['enable-grid'][0], 'yes' ); ?><!-- />-->
<!--	            --><?php //_e( 'Enable Grid', 'amora' )?>
<!--	        </label>-->
<!--	        <br />-->

<!--	        <label for="enable-coverflow-posts">-->
<!--	            <input type="checkbox" name="enable-coverflow-posts" id="enable-coverflow-posts" value="yes" --><?php //if ( isset ( $amora_stored_meta['enable-coverflow-posts'] ) ) checked( $amora_stored_meta['enable-coverflow-posts'][0], 'yes' ); ?><!-- />-->
<!--	            --><?php //_e( 'Enable CoverFlow (Posts)', 'amora' )?>
<!--	        </label>-->
<!--	        <br />-->
	        <label for="hide-title">
	            <input type="checkbox" name="hide-title" id="hide-title" value="yes" <?php if ( isset ( $amora_stored_meta['hide-title'] ) ) checked( $amora_stored_meta['hide-title'][0], 'yes' ); ?> />
	            <?php _e( 'Hide Page Title', 'amora' )?>
	        </label>
	        <br />
	        <label for="enable-full-width">
	            <input type="checkbox" name="enable-full-width" id="enable-full-width" value="yes" <?php if ( isset ( $amora_stored_meta['enable-full-width'] ) ) checked( $amora_stored_meta['enable-full-width'][0], 'yes' ); ?> />
	            <?php _e( 'Enable Full Width (Hide Sidebar)', 'amora' )?>
	        </label>
	    </div>
	</p>
 
    <?php
}


/**
 * Saves the custom meta input
 */
function amora_meta_save( $post_id ) {
 
    // Checks save status
    $is_autosave = wp_is_post_autosave( $post_id );
    $is_revision = wp_is_post_revision( $post_id );
    $is_valid_nonce = ( isset( $_POST[ 'amora_nonce' ] ) && wp_verify_nonce( $_POST[ 'amora_nonce' ], basename( __FILE__ ) ) ) ? 'true' : 'false';
 
    // Exits script depending on save status
    if ( $is_autosave || $is_revision || !$is_valid_nonce ) {
        return;
    }

    // Checks for input and sanitizes/saves if needed
    if( isset( $_POST[ 'enable-fp-posts' ] ) ) {
        update_post_meta( $post_id, 'enable-fp-posts','yes' );
    }
    else {
        update_post_meta( $post_id, 'enable-fp-posts', '' );
    }



    // Checks for input and sanitizes/saves if needed
    if( isset( $_POST[ 'meta-text' ] ) ) {
        update_post_meta( $post_id, 'meta-text', sanitize_text_field( $_POST[ 'meta-text' ] ) );
    }
    
    // Checks for input and saves
	if( isset( $_POST[ 'enable-slider' ] ) ) {
	    update_post_meta( $post_id, 'enable-slider', 'yes' );
	} else {
	    update_post_meta( $post_id, 'enable-slider', '' );
	}
	
	// Checks for input and saves
	if( isset( $_POST[ 'enable-showcase' ] ) ) {
	    update_post_meta( $post_id, 'enable-showcase', 'yes' );
	} else {
	    update_post_meta( $post_id, 'enable-showcase', '' );
	}
	
//	// Checks for input and saves
//	if( isset( $_POST[ 'enable-sqbx' ] ) ) {
//	    update_post_meta( $post_id, 'enable-sqbx', 'yes' );
//	} else {
//	    update_post_meta( $post_id, 'enable-sqbx', '' );
//	}
	
	// Checks for input and saves
	if( isset( $_POST[ 'enable-fn1' ] ) ) {
	    update_post_meta( $post_id, 'enable-fn1', 'yes' );
	} else {
	    update_post_meta( $post_id, 'enable-fn1', '' );
	}
	
	if( isset( $_POST[ 'enable-fn2' ] ) ) {
	    update_post_meta( $post_id, 'enable-fn2', 'yes' );
	} else {
	    update_post_meta( $post_id, 'enable-fn2', '' );
	}
	
	if( isset( $_POST[ 'enable-fn3' ] ) ) {
	    update_post_meta( $post_id, 'enable-fn3', 'yes' );
	} else {
	    update_post_meta( $post_id, 'enable-fn3', '' );
	}
	
	// Checks for input and saves
	if( isset( $_POST[ 'enable-grid' ] ) ) {
	    update_post_meta( $post_id, 'enable-grid', 'yes' );
	} else {
	    update_post_meta( $post_id, 'enable-grid', '' );
	}
	
//	// Checks for input and saves
//	if( isset( $_POST[ 'enable-coverflow' ] ) ) {
//	    update_post_meta( $post_id, 'enable-coverflow', 'yes' );
//	} else {
//	    update_post_meta( $post_id, 'enable-coverflow', '' );
//	}
	
//	// Checks for input and saves
//	if( isset( $_POST[ 'enable-sqbx-posts' ] ) ) {
//	    update_post_meta( $post_id, 'enable-sqbx-posts', 'yes' );
//	} else {
//	    update_post_meta( $post_id, 'enable-sqbx-posts', '' );
//	}
	
//	// Checks for input and saves
//	if( isset( $_POST[ 'enable-coverflow-posts' ] ) ) {
//	    update_post_meta( $post_id, 'enable-coverflow-posts', 'yes' );
//	} else {
//	    update_post_meta( $post_id, 'enable-coverflow-posts', '' );
//	}
	 
	// Checks for input and saves
	if( isset( $_POST[ 'hide-title' ] ) ) {
	    update_post_meta( $post_id, 'hide-title', 'yes' );
	} else {
	    update_post_meta( $post_id, 'hide-title', '' );
	}
	
	// Checks for input and saves
	if( isset( $_POST[ 'enable-full-width' ] ) ) {
	    update_post_meta( $post_id, 'enable-full-width', 'yes' );
	} else {
	    update_post_meta( $post_id, 'enable-full-width', '' );
	}
 
}
add_action( 'save_post', 'amora_meta_save' );