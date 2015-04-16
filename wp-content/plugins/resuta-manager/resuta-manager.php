<?php
/*
	Plugin Name: Gerenciador do Site
	Plugin URI: http://resuta.com.br/
	Version: 1.0.0
	Author: Resuta
	Author URI: http://resuta.com.br/
	License: MIT
	Description: Esse plugin deve estar ativo para implementar as regras de negócio do site.
	             Ao ativar serão habilitados Custom Post Types, Taxonomias, Metaboxes e outras customizações do projeto.
*/

namespace Resuta;

class App
{
	/**
	 * locations
	 *
	 * @since 1.0
	 * @var array
	 */
	public static $locations = array(
		'Controller',
		'View',
		'Helper',
		'Widget',
		'Vendor'
	);

	/**
	 * Slug Plugin
	 *
	 * @since 1.0
	 */
	const PLUGIN_SLUG = 'resuta-manager';

	public static function uses( $class_name, $location )
	{
		$extension = 'php';

		if ( in_array( $location, self::$locations ) )
			$extension = strtolower( $location ) . '.php';

		include "{$location}/{$class_name}.{$extension}";
	}

	public static function plugins_url( $path )
	{
		return plugins_url( $path, __FILE__ );
	}

	public static function plugin_dir_path( $path )
	{
		return plugin_dir_path( __FILE__  ) . $path;
	}

	public static function filemtime( $path )
	{
		return filemtime( self::plugin_dir_path( $path ) );
	}

	public static function get_image( $file )
	{
		return self::plugins_url( "assets/images/{$file}" );
	}
}

App::uses( 'core', 'Config' );

register_activation_hook( __FILE__, array( 'Resuta\Core', 'activate' ) );

$core = new Core();
