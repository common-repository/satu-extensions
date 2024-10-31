<?php
/**
 * Function to switch between breadcrumbs and menu
 *
 * @author    Satrya
 * @copyright Copyright (c) 2013, Satrya & ThemePhe
 * @license   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * @since     1.0
 */

/* Hook 'wp_loaded' to load all required function. */
add_action( 'wp_loaded', 'satu_extensions_menu_setup', 1 );

/**
 * Setup menu function.
 *
 * @since  1.0
 */
function satu_extensions_menu_setup() {

	/* Get the navigation value from theme customizer. */
	$menu = get_theme_mod( 'satu_extensions_menu', 'breadcrumbs' );

	/* If menu selected. */
	if ( $menu == 'menu' ) {

		/* Register new primary menu. */
		register_nav_menu( 'primary', __( 'Primary Menu', 'satu-extensions' ) );

		/* Remove breadcrumbs. */
		remove_action( 'satu_header_after', 'satu_content_after_header', 1 );

		/* Replace breacrumbs with menu. */
		add_action( 'satu_header_after', 'satu_extensions_content_after_header', 1 );

		/* Enqueue style and script for the menu. */
		add_action( 'wp_enqueue_scripts', 'satu_extensions_menu_stylesheet' );

	}

}

/**
 * Load primary nav.
 *
 * @since  1.0
 */
function satu_extensions_content_after_header() {
	?>
	
	<div class="after-header">
		<div class="container">
			
			<nav role="navigation" class="site-navigation primary-navigation">
				<?php
					wp_nav_menu(
						array(
							'theme_location'  => 'primary',
							'container_class' => 'menu-primary-wrap',
							'menu_id'         => '',
							'menu_class'      => 'menu-primary-items reset-list',
							'fallback_cb'     => ''
						)
					);
				?>
			</nav>

		</div><!-- .container -->
	</div><!-- .after-header -->

	<?php
}

/**
 * Enqueue style and script for the menu.
 *
 * @since 1.0
 */
function satu_extensions_menu_stylesheet() {

	/* Load custom style for the menu. */
	wp_enqueue_style( 'satu-extensions-menu-stylesheet', trailingslashit( SE_URI ) . 'inc/assets/menu.css', array(), '1.0', 'all' );

	/* Load bundled jQuery library. */
	wp_enqueue_script( 'jquery' );

	/* Load custom script for the menu. */
	wp_enqueue_script( 'satu-extensions-menu-script', trailingslashit( SE_URI ) . 'inc/assets/menu.js', array( 'jquery' ), '1.0', true );
}
?>