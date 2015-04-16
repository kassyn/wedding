<?php
/*
	Plugin Name: Age WP API
	Plugin URI: http://resuta.com.br/
	Version: 1.0.0
	Author: Resuta
	Author URI: http://resuta.com.br/
	License: MIT
	Description: Plugin para utilização do Age WP API. Mantenha o plugin ativado para desfrutar de todas suas funcionalidades.
*/

namespace Age\API;

class App
{
	public static function uses( $class_name, $location )
	{
		include "{$location}/{$class_name}.php";
	}
}

App::uses( 'core', 'Config' );

$core = new Core();
