<?php
/**
 * Resuta Manager
 *
 * @package Resuta Manager
 * @version 1.0
 */

namespace Resuta;

//Controller
App::uses( 'presences', 'Controller' );

class Core
{
	/**
	 * Initialize the plugin by setting localization, filters, and administration functions.
	 *
	 * @since 1.0
	 */
	public function __construct()
	{
		// Load public-facing style sheet and JavaScript.
		add_action( 'admin_enqueue_scripts', array( &$this, 'scripts_admin' ) );
		add_action( 'admin_enqueue_scripts', array( &$this, 'styles_admin' ) );

		$presences = new Presences_Controller();
	}

	/**
	 * Register Script Admin
	 *
	 * @since 1.0
	 * @return void.
	 */
	public function scripts_admin()
	{
		// $this->_load_wp_media();

		// wp_enqueue_script(
		// 	'admin-script-' . App::PLUGIN_SLUG,
		// 	App::plugins_url( '/assets/javascripts/built.js' ),
		// 	array( 'jquery', 'wp-color-picker' ),
		// 	App::filemtime( 'assets/javascripts/built.js' ),
		// 	true
		// );

		// wp_localize_script(
		// 	'admin-script-' . App::PLUGIN_SLUG,
		// 	'AdminGlobalVars',
		// 	array(
		// 		'urlAjax' => admin_url( 'admin-ajax.php' ),
		// 	)
		// );
	}

	public function styles_admin()
	{
		// wp_enqueue_style(
		// 	'admin-style-' . App::PLUGIN_SLUG,
		// 	App::plugins_url( 'style.css' ),
		// 	array(),
		// 	App::filemtime( 'style.css' )
		// );
	}

	public static function activate()
	{

	}

	/**
	 * Loads wp.media class on pages that do not.
	 *
	 * @since 1.0
	 * @return void
	 */
	private function _load_wp_media()
	{
		global $pagenow;

		if ( did_action( 'wp_enqueue_media' ) )
			return;

		if ( in_array( $pagenow, array( 'post.php', 'post-new.php', 'themes.php' ) ) )
			wp_enqueue_media();
	}
}
