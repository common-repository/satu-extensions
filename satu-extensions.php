<?php
/**
 * Plugin Name: Satu Extensions
 * Plugin URI:  https://github.com/satrya/satu-extensions
 * Description: Satu Extensions extends functionality to Satu Theme. It provides several features such as favicon uploader, switch breadcrumbs to menu and color customizer.
 * Version:     1.1
 * Author:      Satrya
 * Author URI:  http://themephe.com/
 *
 * This program is free software; you can redistribute it and/or modify it under the terms of the GNU 
 * General Public License as published by the Free Software Foundation; either version 2 of the License, 
 * or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without 
 * even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 * You should have received a copy of the GNU General Public License along with this program; if not, write 
 * to the Free Software Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA 02110-1301 USA
 *
 * @author    Satrya
 * @copyright Copyright (c) 2013, Satrya & ThemePhe
 * @license   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

class Satu_Extensions {

	/**
	 * PHP5 constructor method.
	 *
	 * @since 1.0
	 */
	public function __construct() {

		/* Set the constants needed by the plugin. */
		add_action( 'plugins_loaded', array( &$this, 'constants' ), 1 );

		/* Internationalize the text strings used. */
		add_action( 'plugins_loaded', array( &$this, 'i18n' ), 2 );

		/* Load the functions files. */
		add_action( 'init', array( &$this, 'includes' ) );

	}

	/**
	 * Defines constants used by the plugin.
	 *
	 * @since 1.0
	 */
	public function constants() {

		/* Set constant path to the plugin directory. */
		define( 'SE_DIR', trailingslashit( plugin_dir_path( __FILE__ ) ) );

		/* Set the constant path to the plugin directory URI. */
		define( 'SE_URI', trailingslashit( plugin_dir_url( __FILE__ ) ) );

		/* Set the constant path to the inc directory. */
		define( 'SE_INC', SE_DIR . trailingslashit( 'inc' ) );

	}

	/**
	 * Loads the translation files.
	 *
	 * @since 1.0
	 */
	public function i18n() {
		load_plugin_textdomain( 'satu-extensions', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
	}

	/**
	 * Loads the initial files needed by the plugin.
	 *
	 * @since 1.0
	 */
	public function includes() {
		require_once( SE_INC . 'customizer.php' );
		require_once( SE_INC . 'navigation.php' );
	}

}

new Satu_Extensions();
?>