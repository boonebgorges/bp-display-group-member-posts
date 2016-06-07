<?php

class BP_Display_Group_Member_Posts_Extension extends BP_Group_Extension {

	/**
	 * Initial extension setup.
	 */
	public function __construct() {
		$args = array(
			'slug' => 'member-posts',
			'name' => 'Member Posts',
		);

		parent::init( $args );
	}

	public function display( $group_id = null ) {
		$group_members = groups_get_group_members( array(
			'group_id' => $group_id,
			'group_role' => array( 'member', 'mod', 'admin' ),
		) );

		$posts_query = new WP_Query( array(
			'author__in'     => wp_list_pluck( $group_members['members'], 'ID' ),
			'post_type'      => array( 'post', 'page' ),
			'post_status'    => 'publish',
			'posts_per_page' => '-1',
		) );

		if ( $posts_query->have_posts() ) {
			echo '<ul>';

			while ( $posts_query->have_posts() ) {
				$posts_query->the_post();

				printf(
					'<li>%s <a href="%s">%s</a> - %s - %s</li>',
					bp_core_fetch_avatar( array( 'item_id' => get_the_author_ID() ) ),
					esc_url( get_the_permalink( get_the_ID() ) ),
					esc_html( get_the_title() ),
					bp_core_get_userlink( get_the_author_ID() ),
					esc_html( get_the_date( 'F d, Y') )
				);
			}

			echo '</ul>';
		}
	}
}
