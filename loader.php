<?php

/*
Plugin Name: BP Display Group Member Posts
Version: 1.0
Author: Boone B Gorges
*/

/**
 * Load only when BuddyPress is present.
 */
function bpdgmp_include() {
	if ( ! bp_is_active( 'groups' ) ) {
		return;
	}

	require( dirname( __FILE__ ) . '/bp-display-group-member-posts.php' );
	bp_register_group_extension( 'BP_Display_Group_Member_Posts_Extension' );
}
add_action( 'bp_include', 'bpdgmp_include' );
