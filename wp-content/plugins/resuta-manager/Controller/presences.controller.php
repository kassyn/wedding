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
use Age\API\Utils;
use Age\API\Metaboxes;

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
	 * columns
	 *
	 * @since 1.0
	 * @var array
	 */
	public $columns = array(
		'number'       => 'Quantidade de pessoas',
		'will_present' => 'Falou que vem?',
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
		add_action( "age_{$this->name}_column_will_present", array( &$this, 'set_column_will_present' ) );
		add_action( "age_{$this->name}_column_number", array( &$this, 'set_column_number' ) );
		add_action( 'wp_ajax_set-person-registration', array( &$this, 'ajax_set_person_registration' ) );
		add_action( 'wp_ajax_nopriv_set-person-registration', array( &$this, 'ajax_set_person_registration' ) );
	}

	public function register_meta_boxes()
	{
		$metabox = new Metaboxes(
			array(
				'id'               => 'resuta-presence-infomation',
				'meta_keys'        => array(),
				'post_type'        => $this->name,
				'context'          => 'normal',
				'priority'         => 'high',
				'title'            => 'Informações do Convidado',
				'content_callback' => array( 'Resuta\Presences_View', 'render_infomation' ),
			)
		);
	}

	public function set_column_will_present( $post_id )
	{
		$model      = new Presence( $post_id );
		$is_present = ( $model->will_present ) ? 'Sim' : 'Não';
		unset( $model );

		echo "<strong>{$is_present}</strong>";
	}

	public function set_column_number( $post_id )
	{
		$model  = new Presence( $post_id );
		$number = $model->number_individuals;
		unset( $model );

		echo "<strong>{$number}</strong>";
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

	public function ajax_set_person_registration()
	{
		if ( ! Utils::is_request_ajax() )
			return;

		$name         = Utils::post( 'name', false );
		$individuals  = Utils::post( 'individuals', false, 'intval' );
		$will_present = Utils::post( 'will_present', 0, 'intval' );

		if ( ! $name || ! $individuals ) :
			Utils::error_server_json( 'all_fields_required' );
			http_response_code( 500 );
			exit(0);
		endif;

		$model    = new Presence();
		$inserted = $model->insert(
			array(
				'title'              => $name,
				'number_individuals' => $individuals,
				'will_present'       => $will_present,
			)
		);

		if ( ! $inserted ) :
			Utils::error_server_json( 'not_insert_person' );
			http_response_code( 500 );
			exit(0);
		endif;

		Utils::success_server_json( 'success', $this->get_message_by_present( $will_present ) );
		exit(1);
	}

	public function get_message_by_present( $present )
	{		
		$args = array(
			0 => 'Que pena! Mas obrigado pelo seu contato.',
			1 => 'Obrigado! Ficaremos muito felizes com sua presença.',
		);

		return $args[$present];
	}
}
