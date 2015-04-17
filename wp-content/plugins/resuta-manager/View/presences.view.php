<?php
/**
 * Views Presences
 *
 * @package Resuta Manager
 * @subpackage Presences Views
 * @version 1.0
 */

namespace Resuta;

use Age\API\View;

class Presences_View extends View
{
	public static function render_infomation( $post )
	{
		$model = new Presence( $post->ID );

		?>
		<table class="form-table">
			<tbody>
				<tr>
					<th scope="row">Quantidade de pessoas</th>
					<td>
						<span><?php echo esc_html( $model->number_individuals ); ?></span>
					</td>
				</tr>
				<tr>
					<th scope="row">Falou que vem?</th>
					<td>
						<span><?php echo esc_html( ( $model->will_present ) ? 'Sim' : 'Não' ); ?></span>
					</td>
				</tr>
				<tr>
					<th scope="row">IP</th>
					<td>
						<span><?php echo esc_html( $model->ip ); ?></span>
					</td>
				</tr>
			</tbody>
		</table>
		<?php
	}
}
