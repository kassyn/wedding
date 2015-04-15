<?php if ( ! function_exists( 'add_action' ) ) exit; ?>
<?php
/**
 * The front page template file.
 *
 * @package WordPress
 * @subpackage Theme
 */
get_header();
?>	
	<?php get_sidebar(); ?>

	<div id="content">

		<?php get_template_part( 'template-parts/template-part', 'names' ); ?>

		<?php get_template_part( 'template-parts/template-part', 'photos' ); ?>
		
		<?php get_template_part( 'template-parts/template-part', 'ceremony' ); ?>

		<?php get_template_part( 'template-parts/template-part', 'gifts' ); ?>		

		<section id="confirmar" class="confirm-presence">
			<a data-action="confirm" class="btn-confirm-footer" href="#" title="confirmar presença">
				confirmar <strong>presença</strong>
			</a>
		</section>
	</div>

<?php get_footer(); ?>