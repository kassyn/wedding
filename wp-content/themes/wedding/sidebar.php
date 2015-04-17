<?php if ( ! function_exists( 'add_action' ) ) exit; ?>
<?php
/**
 * The sidebar template file.
 *
 * @package WordPress
 * @subpackage Theme
 */
?>

<aside id="sidebar">
	<div class="form">
		<form action="" data-component="presence">
			<ul>
				<li>
					<label for="field-name">Nome como está no convite</label>
					<input id="field-name" type="text" placeholder="Ex.: Fulano e Família" name="name">
				</li>
				<li>
					<label for="field-number">Quantidade de pessoas</label>
					<input id="field-number" type="number" min="1" placeholder="Ex.: 1, 2, 8 ou 5" name="individuals">
				</li>
				<li class="field-radio">
					<label for="field-present-yes">
						SIM <input id="field-present-yes" checked="checked" type="radio" value="1" name="will_present">
					</label>
					<label for="field-present-no">
						NÃO <input id="field-present-no" type="radio" value="0" name="will_present">
					</label>
				</li>
				<li>
					<input type="hidden" name="action" value="set-person-registration">
					<input data-element-send type="submit" value="Confirmar Presença">
				</li>
			</ul>
			
			<div data-element-message class="form-message"></div>
		</form>
	</div>	
	
	<nav class="navigation">
		<ul>
			<li class="date">
				<a href="#top" title="Accácio e Natália">faltam <span><?php w_the_last_days(); ?></span></a>
			</li>
			<li class="grooms">
				<a href="#os-noivos" title="os noivos">Os noivos</a>
			</li>
			<li class="maps">
				<a href="#cerimonia" title="cerimônia">Cerimônia</a>
			</li>
			<li class="presents">
				<a href="#presentes" title="presentes">Presentes</a>
			</li>
			<li class="confirm">
				<a href="#" data-action="confirm" title="confirmar">Confirmar</a>
			</li>
		</ul>
	</nav>
</aside>