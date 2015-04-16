<?php
/**
 * Widgets
 *
 * @package Age WP API
 * @subpackage Base
 * @since 1.0
 */

namespace Age\API;

abstract class Widget
{
	/**
	 * available widgets
	 *
	 * @since 1.0
	 * @var array
	 */
	public $available_widgets = array();

	/**
	 * Adds needed actions to create submenu and page
	 *
	 * @since 1.0
	 * @return void
	 */
	public function __construct()
	{
		add_action( 'widgets_init', array( &$this, 'register_widgets' ) );
	}

	/**
	 * Register Widgets
	 *
	 * Register all Widgets for the theme.
	 * Add your widget file in /widgets folder.
	 * Before call this function call the _load_widgets() function
	 * to load the files for the Widgets.
	 *
	 * @since 0.1
	 * @return void
	 */
	public function register_widgets()
	{
		if ( ! $this->available_widgets )
			return;

		array_map( 'register_widget', $this->available_widgets );
	}
}
