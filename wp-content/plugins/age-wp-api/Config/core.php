<?php
/**
 * Core
 *
 * @package Age WP API
 * @version 1.0
 */

namespace Age\API;

//Core
App::uses( 'metaboxes', 'Vendor' );
App::uses( 'images-intermediate', 'Vendor' );
App::uses( 'utils', 'Helper' );
App::uses( 'post-type', 'Controller' );
App::uses( 'taxonomy', 'Controller' );
App::uses( 'widget', 'Controller' );
App::uses( 'post', 'Model' );
App::uses( 'view', 'View' );
App::uses( 'implement-widget', 'Widget' );

class Core
{
	/**
	 * Initialize the plugin by setting localization, filters, and administration functions.
	 *
	 * @since 1.0
	 */
	public function __construct()
	{
		// Generic hooks
		add_filter( 'enter_title_here', array( &$this, 'enter_placeholder_title' ), 10, 2 );

		$images = new Images_Intermediate();
	}

	public function enter_placeholder_title( $title, $post )
	{
		return apply_filters( "age_placeholder_title_{$post->post_type}", $title );
	}
}
