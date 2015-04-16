<?php
/**
 * Widgets
 *
 * @package Age WP API
 * @subpackage Widgets
 * @version 1.0
 */

namespace Age\API;

class Implement_Widget extends \WP_Widget
{
	protected function get_property( $instance, $property, $default = '' )
	{
		return ( isset( $instance[ $property ] ) && ! empty( $instance[ $property ] ) ) ? $instance[ $property ] : $default;
	}
}
