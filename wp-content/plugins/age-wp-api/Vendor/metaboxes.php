<?php
/**
 * Age WP Metabox Class 
 * 
 * @package Age WP API
 * @subpackage Metaboxes
 * @version 0.2
 */

namespace Age\API;

class Metaboxes
{
	// Define the properties
	private $_meta_keys;
	private $_id;
	private $_title;
	private $_post_type;
	private $_context;
	private $_priority;
	private $_content_callback;
	private $_callback_args;
	private $_nonce_name;
	private $_nonce_action;
	private $_post_id;
	private $_post;
	private $_avoid_post_status;
	private $_wp_editor_callback;
	private $_domain;

	/**
	 * Constants that define if the meta_key is unique or not unique.
	 * It is like Enum type.
	 */
	const IS_UNIQUE  = true;
	const NOT_UNIQUE = false;

	/**
	 * Class construct.
	 *
	 * Use this to creates a new metabox in any post type.
	 * Use the admin_init hook and creates a new object from this class,
	 * passing $args within array.
	 *
	 * Possible Arguments:
	 *
	 * - post_type: The post type slug.
	 * - id: The id for the metabox in html.
	 *       Pass a unique id in a string.
	 *       This field is a alias to id parameter in the add_meta_box() function.
	 * - meta_keys: An associative array, where the key is the meta_key name and the
	 *              value is a bool that indicates if the meta_key is unique or not.
	 *              To set the value use the constants IS_UNIQUE - NOT_UNIQUE.
	 *              Ex: array( 'postmeta_key' => age_WP_Metaboxes::IS_UNIQUE, 'postmeta_key_2' => age_WP_Metaboxes::NOT_UNIQUE ).
	 * 				The value of each meta_key change the way of it is save in the postmeta table.
	 * 				If the postmeta is unique always use the update_post_meta to save, and if the value
	 * 				is an array save it serialized. If not unique use the add_post_meta and save each item
	 * 				from array in a new post meta.
	 * - title: The title for the box. An alias to the parameter title in add_meta_box function.
	 * - context: An alias to the parameter context in add_meta_box function.
	 * - priority: An alias to the parameter priority in add_meta_box function.
	 * - description: Inform a string to help the user know what purpose of the metabox.
	 * - description_position: If the description is displayed above before or after the metabox content.
	 * - callback_args: An alias to the parameter callback_args in add_meta_box function.
	 * - content: The html markup for the fields in metabox. REMEMBER: The 'name' attribute in the fields
	 *            need to be the same passed in the meta_keys parameter to automate the saving.
	 *
	 * @param array $meta_box_args An array with the arguments
	 *
	 * @return void
	 *
	 * @since 1.0
	 */
	public function __construct( $meta_box_args )
	{
		$is_args_valids = self::_is_args_valids( $meta_box_args );

		if ( ! $is_args_valids )
			return;

		$this->_set_environment();

		$defaults = array(
			'post_type'             => 'page',
			'context'               => 'normal',
			'priority'              => 'low',
			'description_position'  => 'before',
			'description'           => null,
			'callback_args'         => null,
			'content_callback'	    => null,
			'wp_editor_callback'	=> null,
			'domain'			    => '',
		);

		$meta_box_args = wp_parse_args( $meta_box_args, $defaults );

		extract( $meta_box_args, EXTR_SKIP );

		$this->_meta_keys          = $meta_keys;
		$this->_id                 = $id;
		$this->_title              = $title;
		$this->_post_type          = $post_type;
		$this->_context            = $context;
		$this->_priority           = $priority;
		$this->_content_callback   = $content_callback;
		$this->_callback_args      = $callback_args;
		$this->_wp_editor_callback = $wp_editor_callback;
		$this->_domain             = $domain;

		// Creates the metabox in WordPress
		$this->_set_control_hook_metaboxes();

		// Save the postmetas, used to all post types
		add_action( 'save_post', array( &$this, 'save' ) , 11 , 2 );
	}

	/**
	 * Add Metabox
	 *
	 * Add the metabox in WordPress using the data passed in class construct.
	 *
	 * @return void
	 *
	 * @since 1.0
	 */
	public function add()
	{
		add_meta_box(
			$this->_get_unique_meta_box_id(),
			$this->_title,
			array( &$this, 'content' ),
			$this->_post_type,
			$this->_context,
			$this->_priority,
			$this->_callback_args
		);
	}

	public function add_wp_editor( $post )
	{
		if ( is_null( $post ) || $post->post_type != $this->_post_type )
			return;

		?>
		<div class="postbox">
			<h3 class="hndle">
				<span><?php echo esc_html( $this->_title ); ?></span>
			</h3>
			<div class="inside">
				<?php call_user_func( $this->_wp_editor_callback, $post ); ?>
			</div>
		</div>
		<?php
	}

	/**
	 * Metabox content
	 *
	 * Generates the html content for the metabox. Already implements an nonce
	 * field to insurance. Print the description for the metabox, if it was exists.
	 *
	 * @return void
	 *
	 * @since 1.0
	 */
	public function content( $post )
	{
		if ( $this->_content_callback && is_callable( $this->_content_callback ) ) :
			call_user_func( $this->_content_callback, $post, $this->_domain );
		endif;

		wp_nonce_field( $this->_nonce_action, $this->_nonce_name );
	}

	/**
	 * Save the postmetas.
	 *
	 * Used to save all postmetas included by this class.
	 * This method is called by the save_post hook.
	 * This use the class attribute _meta_keys to define what
	 * postmetas to save. As we know the attribute _meta_keys
	 * is an array with all postmetas, then this make the saving
	 * for each meta_key.
	 *
	 * @param int $post_id The current post id
	 * @param WP_Post $post The current post data
	 *
	 * @return void
	 *
	 * @since 1.0
	 */
	public function save( $post_id, $post )
	{
		$this->_post_id = $post_id;
		$this->_post    = $post;

		// Check the autosaving and nonce fields
		if ( ! $this->_is_save_post_valid_for_metaboxes() ) :
			return false;
		endif;

		// Save meta by meta in the array
		array_walk( $this->_meta_keys, array( &$this, 'save_each_postmeta' ) );
	}

	/**
	 * Save postmeta by meta_key and unique information.
	 *
	 * Check if the meta_value exists in php $_POST variable by the meta_key.
	 * If the meta_value exists and it is an array, save according the is_unique parameter.
	 * To handle the meta_value before the saving was create a filter named
	 * age_wp_metaboxes_save_meta_value.
	 *
	 * @param bool $is_unique If the meta_key is unique or not
	 * @param string $meta_key The meta_key name
	 *
	 * @return void
	 *
	 * @since 1.2
	 */
	public function save_each_postmeta( $is_unique, $meta_key )
	{
		$meta_value = Utils::post( $meta_key, false );

		if ( empty( $meta_value ) ):
			delete_post_meta( $this->_post_id, $meta_key );
			return;
		endif;

		if ( is_array( $meta_value ) )
			$meta_value = array_filter( $meta_value );

		if ( is_array( $meta_value ) && ! $is_unique ) :
			delete_post_meta( $this->_post_id, $meta_key );
			array_walk( $meta_value, array( &$this, 'insert_post_meta' ), $meta_key, false );
		endif;

		$this->insert_post_meta( $meta_value, null, $meta_key );
	}

	public function insert_post_meta( $value, $array_key, $meta_key, $is_unique = true )
	{
		$value = apply_filters( 'age_wp_metaboxes_save_meta_value', $value, $meta_key, $this->_post_id );

		if ( ! $value )
			return;

		if ( $is_unique ) :
			update_post_meta( $this->_post_id, $meta_key, $value );
			return;
		endif;

		add_post_meta( $this->_post_id, $meta_key, $value );
	}

	public function set_nonce( $nonce_data = array() )
	{
		$defaults = array(
			'nonce_name'   => '_age-wp-metaboxes-name',
			'nonce_action' => '_age-wp-metaboxes-action',
		);

		$nonce_data = wp_parse_args( $nonce_data, $defaults );

		extract( $nonce_data, EXTR_SKIP );

		$this->_nonce_name   = $nonce_name;
		$this->_nonce_action = $nonce_action;
	}

	private function _is_save_post_valid_for_metaboxes()
	{
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
			return false;

		if ( defined( 'DOING_AJAX' ) && DOING_AJAX )
			return false;

		if ( in_array( $this->_post->post_status, $this->_avoid_post_status ) )
			return false;

		if ( $this->_post_type != $this->_post->post_type )
			return false;

		if ( wp_is_post_revision( $this->_post_id ) )
			return false;

		if ( ! Utils::verify_nonce_post( $this->_nonce_name, $this->_nonce_action ) )
			return false;

		return true;
	}

	private function _is_args_valids( $meta_box_args )
	{
		if ( empty( $meta_box_args ) )
			return false;

		if ( ! is_array( $meta_box_args ) )
			return false;

		return true;
	}

	private function _set_environment()
	{
		$this->_avoid_post_status = array( 'auto-draft', 'revision', 'trash' );
	}

	private function _get_unique_meta_box_id()
	{
		$unique_id = ( is_array( $this->_id ) ) ? implode( '-', $this->_id ) : $this->_id;

		return 'age-wp-metabox-' . $unique_id;
	}

	private function _set_control_hook_metaboxes()
	{
		if ( $this->_wp_editor_callback && is_callable( $this->_wp_editor_callback ) ) :
			$hook = ( $this->_post_type != 'page' ) ? 'edit_form_advanced' : 'edit_page_form';
			add_action( $hook, array( &$this, 'add_wp_editor' ) );
			return;
		endif;

		add_action( 'add_meta_boxes', array( &$this, 'add' ) );
	}
}
