<?php
/**
 * Controller Presences
 *
 * @package Resuta Manager
 * @subpackage Presences
 * @since 1.0
 */

namespace Resuta;

use Age\API\Post_Type;

App::uses( 'presences', 'View' );
App::uses( 'presence', 'Model' );

class Presences_Controller extends Post_Type
{
	/**
	 * Name Post Type
	 *
	 * @since 1.0
	 * @var object
	 */
	public $name = Presence::POST_TYPE;

	/**
	 * messages
	 *
	 * @since 1.0
	 * @var array
	 */
	public $messages = array(
		'label'     => 'Presença',
		'plural'    => 'Presenças',
		'is_female' => true,
	);

	/**
	 * Adds needed construct
	 *
	 * @since 1.0
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();

		add_action( "age_placeholder_title_{$this->name}", array( &$this, 'set_placeholder_title' ) );
	}

	public function get_args_register_post_type()
	{
		return array(
			'labels'        => $this->get_labels(),
			'public'        => false,
			'show_ui'       => true,
			'menu_position' => 5,
			'supports'      => array( 'title' ),
			'menu_icon'     => 'dashicons-groups',
		);
	}

	public function set_placeholder_title( $title )
	{
		return 'Digite o nome do convidado';
	}
}
