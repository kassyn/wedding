<?php
/**
 * Post Type
 *
 * @package Age WP API
 * @subpackage Base
 * @since 1.0
 */

namespace Age\API;

abstract class Post_Type
{
	/**
	 * name post type
	 *
	 * @since 1.0
	 * @var string
	 */
	public $name;

	/**
	 * messages
	 *
	 * @since 1.0
	 * @var array
	 */
	public $messages = array();

	/**
	 * columns
	 *
	 * @since 1.0
	 * @var array
	 */
	public $columns = array();

	/**
     * Constructor of the class.
     *
     * @since 1.0
     * @return null
     */
	public function __construct()
	{
		add_action( 'init', array( &$this, 'register_post_type' ) );
		add_action( 'admin_init', array( &$this, 'register_meta_boxes' ) );
		add_filter( 'post_updated_messages', array( &$this, 'set_post_updated_messages' ) );
		add_filter( "manage_{$this->name}_posts_columns", array( &$this, 'list_head_columns' ) );
		add_action( "manage_{$this->name}_posts_custom_column", array( &$this, 'list_content_columns' ), 10, 2 );
	}

	public function add_image_size( $name, $width, $height, $crop = true )
	{
		$args = array(
			'name'      => $name,
			'width'     => $width,
			'height'    => $height,
			'crop'      => $crop,
			'post_type' => $this->name,
		);

		do_action( 'age_add_image_size', $args );
	}

	public function column_code_generic( $post_id )
	{
		echo "<strong>{$post_id}</strong>";
	}

	public function column_state_generic( $post_id )
	{
		$model = new Address( $post_id );
		$state = $model->get_state_row();

		echo ( $state ) ? $state['text'] : '—';
	}

	public function column_city_generic( $post_id )
	{
		$model = new Address( $post_id );
		$state = $model->get_city_row();

		echo ( $state ) ? $state['text'] : '—';
	}

	/**
	 * Sets the column in admin
	 *
	 * @since 1.0
	 * @param array $heads
	 * @return array Heads
	 */
	public function list_head_columns( $heads )
	{
		unset( $heads['date'] );

		$heads         = array_merge( $heads, $this->columns );
		$heads['date'] = __( 'Date' );

		return $heads;
	}

	/**
	 * Sets the column date content in admin
	 *
	 * @since 1.0
	 * @param string $column_name
	 * @param int $post_id
	 * @return void
	 */
	public function list_content_columns( $column_name, $post_id )
	{
		do_action( "age_{$this->name}_column_{$column_name}", $post_id );
	}

	/**
	 * Register Meta Boxes
	 *
	 * @since 1.0
	 * @return void
	*/
	public function register_meta_boxes()
	{

	}

	/**
	 * Register acessory post type
	 *
	 * @return void
	 * @since 1.0
	 */
	public function register_post_type()
	{
		register_post_type( $this->name, $this->get_args_register_post_type() );
	}

	/**
	 * Sets the template updated message
	 *
	 * @since 1.0
	 * @param array $messages Messages
	 * @return array Messages
	 */
	public function set_post_updated_messages( $messages )
	{
		global $post;

		extract( $this->get_messages() );

		$gender = ( $is_female ) ? 'a' : 'o';

		$messages[ $this->name ] = array(
			0  => '',
			1  => "{$label} atualizad{$gender}.",
			2  => "Campo personalizado atualizad{$gender}.",
			3  => "Campo personalizado atualizad{$gender}.",
			4  => "{$label} atualizado.",
			5  => isset( $_GET['revision'] ) ? sprintf( "{$label} restaurad{$gender} para revisão às %s.", wp_post_revision_title( (int)$_GET['revision'], false ) ) : false,
			6  => "{$label} publicad{$gender}.",
			7  => "{$label} salv{$gender}.",
			8  => "{$label} submetid{$gender}.",
			9  => sprintf( "{$label} agendad{$gender} para: <strong>%1\$s</strong>.", date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ) ),
			10 => "Rascunho do " . strtolower( $label ) . " atualizad{$gender}.",
		);

		return $messages;
	}

	public function get_labels()
	{
		extract( $this->get_messages() );

		$gender       = ( $is_female ) ? 'a' : 'o';
		$not_found    = ( $is_female ) ? 'Nenhuma' : 'Nenhum';
		$label_lower  = strtolower( $label );
		$plural_lower = strtolower( $plural );

		return array(
			'name'               => $plural,
			'singular_name'      => $label,
			'all_items'          => "Tod{$gender}s {$gender}s {$plural_lower}",
			'add_new'            => "Adicionar nov{$gender}",
			'add_new_item'       => "Adicionar nov{$gender} {$label_lower}",
			'edit_item'          => "Editar {$label_lower}",
			'new_item'           => "Nov{$gender} {$label_lower}",
			'view_item'          => "Visualizar {$label_lower}",
			'search_items'       => "Pesquisar {$plural_lower}",
			'not_found'          => "{$not_found} {$label_lower} encontrad{$gender}",
			'not_found_in_trash' => "{$not_found} {$label_lower} encontrad{$gender} na lixeira",
		);
	}

	public function get_messages()
	{
		$defaults = array(
			'is_female' => false,
			'label'     => 'Post',
			'plural'    => 'Posts',
		);

		return wp_parse_args( $this->messages, $defaults );
	}

	public function get_args_register_post_type()
	{
		return array(
			'labels'        => $this->get_labels(),
			'public'        => true,
			'menu_position' => 5,
		);
	}
}
