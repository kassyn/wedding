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
		<form action="">
			<ul>
				<li>
					<label for="">Nome como está no convite</label>
					<input type="text">
				</li>
				<li>
					<label for="">Quantidade de pessoas</label>
					<input type="text">
				</li>
				<li class="field-radio">
					<label for="">SIM <input type="radio"></label>
					<label for="">NÃO <input type="radio"></label>
				</li>
				<li><input type="submit" value="Confirmar Presença"></li>
			</ul>
		</form>
	</div>
	<nav class="navigation">
		<ul>
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
				<a href="#confirmar" title="confirmar">Confirmar</a>
			</li>
		</ul>
	</nav>
</aside>