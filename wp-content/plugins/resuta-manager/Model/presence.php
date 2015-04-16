<?php
/**
 * Presence
 *
 * @package Resuta Manager
 * @subpackage Presence
 */

namespace Resuta;

use Age\API\Post;

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

			default :
				return false;
				break;
		}

		return $this->$prop_name;
	}
}
