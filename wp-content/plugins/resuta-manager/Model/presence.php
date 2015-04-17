<?php
/**
 * Presence
 *
 * @package Resuta Manager
 * @subpackage Presence
 */

namespace Resuta;

use Age\API\Post;
use Age\API\Utils;

class Presence extends Post
{
	/**
	 * number of individuals
	 *
	 * @since 1.0
	 * @var int
	 */
	private $number_individuals;

	/**
	 * will be present
	 *
	 * @since 1.0
	 * @var bool
	 */
	private $will_present;

	/**
	 * ip
	 *
	 * @since 1.0
	 * @var string
	 */
	private $ip;

	/**
	 * Post Type name
	 *
	 * @since 1.0
	 * @var string
	 */
	const POST_TYPE = 'resuta-presence';

	/**
	 * Post Metas
	 *
	 * @since 1.0
	 * @var string
	 */
	const POST_META_NUMBER_INDIVIDUALS = 'resuta-presence-number-individuals';
	
	const POST_META_WILL_PRESENT = 'resuta-presence-will-present';
	
	const POST_META_IP = 'resuta-presence-ip';

	/**
	 * Insert new item ""
	 *
	 * @since 1.0
	 */
	public function insert( $fields )
	{
		$defaults = array(
			'title'              => '',
			'number_individuals' => '',
			'will_present'       => '',
			'ip'                 => Utils::get_ipaddress(),
		);
		
		$fields   = array_map( 'esc_html', wp_parse_args( $fields, $defaults ) );
		$inserted = wp_insert_post(
			array(
				'post_title'  => $fields['title'],
				'post_status' => 'publish',
				'post_type'   => self::POST_TYPE,
			)
		);

		if ( is_wp_error( $inserted ) )
			return false;

		$this->set_metas( $fields, $inserted );

		return $inserted;
	}

	public function set_metas( $fields, $inserted )
	{
		extract( $fields );

		update_post_meta( $inserted, self::POST_META_NUMBER_INDIVIDUALS, $number_individuals );
		update_post_meta( $inserted, self::POST_META_WILL_PRESENT, $will_present );
		update_post_meta( $inserted, self::POST_META_IP, $ip );
	}

	/**
	 * Use in __get() magic method to retrieve the value of the attribute
	 * on demand. If the attribute is unset get his value before.
	 *
	 * @since 1.0
	 * @param string $prop_name The attribute name
	 * @return mixed The value of the attribute
	 */
	protected function get_property( $prop_name )
	{
		switch ( $prop_name ) {

			case 'number_individuals' :
				if ( ! isset( $this->number_individuals ) ) :
					$this->number_individuals = get_post_meta( $this->ID, self::POST_META_NUMBER_INDIVIDUALS, true );
				endif;
				break;

			case 'will_present' :
				if ( ! isset( $this->will_present ) ) :
					$this->will_present = get_post_meta( $this->ID, self::POST_META_WILL_PRESENT, true );
				endif;
				break;

			case 'ip' :
				if ( ! isset( $this->ip ) ) :
					$this->ip = get_post_meta( $this->ID, self::POST_META_IP, true );
				endif;
				break;

			default :
				return false;
				break;
		}

		return $this->$prop_name;
	}
}
