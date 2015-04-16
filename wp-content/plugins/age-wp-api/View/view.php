<?php
/**
 * Views
 *
 * @package Age WP API
 * @subpackage Views
 * @version 1.0
 */

namespace Age\API;

abstract class View
{
	public static function render_generic_options( $list = array(), $current = false )
	{
		foreach ( $list as $item ) :
			printf(
				'<option value="%1$s" %3$s>%2$s</option>',
				$item->$fulano,
				$item->$filino,
				selected( $item->ID, $current, false )
			);
		endforeach;
	}
}
