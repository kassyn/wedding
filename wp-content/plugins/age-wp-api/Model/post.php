<?php
/**
 * Post
 *
 * @package Age WP API
 * @subpackage Base
 * @since 1.0
 */

namespace Age\API;

abstract class Post
{
	/**
	 * ID
	 *
	 * @since 1.0
	 * @var string
	 */
	private $ID;

	/**
	 * Title
	 *
	 * @since 1.0
	 * @var string
	 */
	private $title;

	/**
	 * Excerpt
	 *
	 * @since 1.0
	 * @var string
	 */
	private $excerpt;

	/**
	 * Content
	 *
	 * @since 1.0
	 * @var string
	 */
	private $content;

	/**
	 * Date
	 *
	 * @since 1.0
	 * @var string
	 */
	private $date;

	/**
	 * Date GMT
	 *
	 * @since 1.0
	 * @var string
	 */
	private $date_gmt;

	/**
	 * Status
	 *
	 * @since 1.0
	 * @var string
	 */
	private $status;

	/**
	 * Status
	 *
	 * @since 1.0
	 * @var string
	 */
	private $author;

	/**
	 * menu order
	 *
	 * @since 1.0
	 * @var int
	 */
	private $menu_order;

	/**
	 * Use in fields post has "post_" prefix
	 *
	 * @since 1.0
	 * @var array
	 */
	private $prefix_post_fields = array(
		'title',
		'excerpt',
		'content',
		'date',
		'date_gmt',
		'status',
		'author'
	);

	/**
	 * Use in fields post has literal names
	 *
	 * @since 1.0
	 * @var array
	 */
	private $literal_post_fields = array(
		'menu_order',
	);

	/**
     * Constructor of the class. Instantiate and incializate it.
     *
     * @since 1.0.0
     *
     * @param int $ID - The ID of the Customer
     * @return null
     */
	public function __construct( $ID = false )
	{
		if ( false != $ID ) :
			$this->ID = $ID;
		endif;
	}

	public function has_post_thumbnail()
	{
		return has_post_thumbnail( $this->ID );
	}

	public function get_the_thumbnail( $size = 'thumbnail' )
	{
		return get_the_post_thumbnail( $this->ID, $size );
	}

	public function get_the_thumbnail_url( $size = 'thumbnail' )
	{
		return Utils::get_thumbnail_url( get_post_thumbnail_id( $this->ID ), $size );
	}

	public function get_permalink()
	{
		return get_permalink( $this->ID );
	}

	public function find( $args = array() )
	{
		$defaults = array(
			'post_type' => $this::POST_TYPE,
			'fields'    => 'ids',
		);

		return $this->parse( Utils::get_query( $args, $defaults ) );
	}

	/**
	 * Magic function to retrieve the value of the attribute more easily.
	 *
	 * @since 1.0
	 * @param string $prop_name The attribute name
	 * @return mixed The attribute value
	 */
	public function __get( $prop_name )
	{
		if ( isset( $this->$prop_name ) )
			return $this->$prop_name;

		if ( in_array( $prop_name, $this->prefix_post_fields ) ) :
			$this->$prop_name = get_post_field( "post_{$prop_name}", $this->ID );
			return $this->$prop_name;
		endif;

		if ( in_array( $prop_name, $this->literal_post_fields ) ) :
			$this->$prop_name = get_post_field( $prop_name, $this->ID );
			return $this->$prop_name;
		endif;

		return $this->get_property( $prop_name );
	}

	public function parse( $wp_query )
	{
		if ( ! $wp_query->have_posts() )
			return false;

		foreach ( $wp_query->posts as $id ) :
			$model  = new $this( $id );
			$list[] = $model;

			unset( $model );
		endforeach;

		$std           = new \stdClass();
		$std->list     = $list;
		$std->wp_query = $wp_query;

		return $std;
	}

	/**
	 * Get Property per name
	 *
	 * @since 1.0
	 * @return void
	*/
	protected function get_property( $prop_name )
	{

	}
}
