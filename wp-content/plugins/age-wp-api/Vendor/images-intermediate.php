<?php
/**
 * Controller Images
 *
 * @package Age WP API
 * @subpackage Images Intermediate
 * @since 1.0
 */

namespace Age\API;

class Images_Intermediate
{
	/**
	 * images sizes
	 *
	 * @since 1.0
	 * @var array
	 */
	public $images_sizes = array();

	/**
	 * Construct
	 *
	 * Assign hooks to class functions and initializes the plugin to run
	 *
	 * @since 0.1
	 * @return void
	 */
	public function __construct()
	{
		add_filter( 'intermediate_image_sizes', array( &$this, 'filter_image_sizes' ), 99 );
		add_action( 'age_add_image_size', array( &$this, 'add_image_size' ) );
	}

	/**
	 * Filter image sizes
	 *
	 * Uses the hook intermediate_image_sizes to generate only necessaries sizes to an image upoaded.
	 *
	 * @since 0.1
	 * @param array $sizes An array with sizes registereds in WordPress
	 * @see add_filter( 'intermediate_image_sizes' )
	 * @global object The $post WP object with image post data
	 * @return array The image sizes only to CPT from the image parent
	 */
	public function filter_image_sizes( $sizes )
	{
		$default_sizes = apply_filters( 'age_default_image_sizes', array( 'thumbnail', 'medium', 'large' ) );
		$post_type     = $this->get_post_type_by_upload();

		return array_merge( $default_sizes, $this->get_images_sizes( $post_type ) );
	}

	public function add_image_size( $args )
	{
		extract( $args );

		$this->images_sizes[$post_type][] = $name;

		//add image size default WordPress
		add_image_size( $name, $width, $height, $crop );
	}

	public function get_images_sizes( $post_type )
	{
		if ( ! isset( $this->images_sizes[$post_type] ) )
			return apply_filters( "age_default_image_sizes_{$post_type}", array() );

		return $this->images_sizes[$post_type];
	}

	public function get_post_type_by_upload()
	{
		$post_id = Utils::post( 'post_id', false );
		$action  = Utils::request( 'action', false );

		//case regenerate thumbnail
		if ( ! $post_id && $action == 'regeneratethumbnail' )
			$post_id = $this->get_post_id_regenerate();

		return ( $post_id ) ? get_post_type( $post_id ) : false;
	}

	public function get_post_id_regenerate()
	{
		$attachment_id = Utils::request( 'id', false, 'intval' );
		$attachment    = get_post( $attachment_id );

		if ( ! $attachment || $attachment->post_type != 'attachment' )
			return false;

		if ( substr( $attachment->post_mime_type, 0, 6 ) == 'image/' )
			return $attachment->post_parent;

		return false;
	}
}
