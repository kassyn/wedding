<?php
/**
 * Taxonomy
 *
 * @package Age WP API
 * @subpackage Base
 * @since 1.0
 */

namespace Age\API;

abstract class Taxonomy
{
	/**
     * Constructor of the class.
     *
     * @since 1.0
     * @return null
     */
	public function __construct()
	{
		add_action( 'init', array( &$this, 'register_taxonomy' ), 0 );
	}

	/**
	 * Register all taxonomies of class
	 *
	 * @return void
	 */
	abstract protected function register_taxonomy();
}
