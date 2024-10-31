<?php
/**
 * Extends theme customizer to add more functionality.
 *
 * @author    Satrya
 * @copyright Copyright (c) 2013, Satrya & ThemePhe
 * @license   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * @since     1.0
 */

/* Register custom sections, settings, and controls. */
add_action( 'customize_register', 'satu_extensions_customizer_register' );

/* Hook wp_head to display the favicon. */
add_action( 'wp_head', 'satu_extensions_favicon_output', 10 );

/* Output settings CSS into the head. */
add_action( 'wp_head', 'satu_extensions_customize_css', 11 );

/**
 * Register custom sections, settings, and controls.
 *
 * @since 1.0 
 */
function satu_extensions_customizer_register( $wp_customize ) {

	global $wp_customize;

	$wp_customize->get_setting( 'blogname' )->transport        = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';

	/* Javascript for live preview purpose. */
	if ( $wp_customize->is_preview() && ! is_admin() )
		add_action( 'wp_footer', 'satu_extensions_customize_preview_js', 21 );

	/* Set the priority of background color function. */
	$wp_customize->get_control( 'background_color' )->priority = 0;

	/**
	 * Favicon Settings.
	 *
	 * @since 1.0 
	 */
	$wp_customize->add_section( 'satu_extensions_favicon_settings' , array(
		'title'    => __( 'Satu Favicon', 'satu-extensions' ),
		'priority' => 130,
	) );

	$wp_customize->add_setting( 'satu_extensions_favicon', array(
		'capability'        => 'edit_theme_options',
		'sanitize_callback'	=> 'esc_url_raw'
	) );
	
		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'satu_extensions_favicon', array(
			'label'   => __( 'Upload Favicon', 'satu-extensions' ),
			'section' => 'satu_extensions_favicon_settings'
		) ) );

	/**
	 * Top border color
	 *
	 * @since 1.0
	 */
	$wp_customize->add_setting( 'satu_extensions_top_border_color' , array(
		'default'    => '#f00533',
		'capability' => 'edit_theme_options'
	) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'satu_extensions_top_border_color', array(
			'label'   => __( 'Top Border Color', 'satu-extensions' ),
			'section' => 'colors'
		) ) );

	/**
	 * Link Color
	 *
	 * @since 1.0
	 */
	$wp_customize->add_setting( 'satu_extensions_link_color' , array(
		'default'    => '#f00533',
		'capability' => 'edit_theme_options'
	) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'satu_extensions_link_color', array(
			'label'   => __( 'Link Color', 'satu-extensions' ),
			'section' => 'colors'
		) ) );

	/**
	 * Entry Link Hover Background Color
	 *
	 * @since 1.0
	 */
	$wp_customize->add_setting( 'satu_extensions_hover_color' , array(
		'default'    => '#f00533',
		'capability' => 'edit_theme_options'
	) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'satu_extensions_hover_color', array(
			'label'   => __( 'Entry Link Hover Background Color', 'satu-extensions' ),
			'section' => 'colors'
		) ) );

	/**
	 * Button Color
	 *
	 * @since 1.0
	 */
	$wp_customize->add_setting( 'satu_extensions_btn_color' , array(
		'default'    => '#f00533',
		'capability' => 'edit_theme_options'
	) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'satu_extensions_btn_color', array(
			'label'   => __( 'Button Color', 'satu-extensions' ),
			'section' => 'colors'
		) ) );

	/**
	 * Button Hover Color
	 *
	 * @since 1.0
	 */
	$wp_customize->add_setting( 'satu_extensions_btn_hover_color' , array(
		'default'    => '#f00533',
		'capability' => 'edit_theme_options'
	) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'satu_extensions_btn_hover_color', array(
			'label'   => __( 'Button Hover Color', 'satu-extensions' ),
			'section' => 'colors'
		) ) );

	/**
	 * Switch breadcrumbs to menu
	 *
	 * @since 1.0
	 */
	$wp_customize->add_section( 'satu_extensions_menu_settings' , array(
		'title'    => __( 'Satu Navigation', 'satu-extensions' ),
		'priority' => 140
	) );

	$wp_customize->add_setting( 'satu_extensions_menu', array(
		'default'    => 'breadcrumbs',
		'capability' => 'edit_theme_options'
	) );
	
		$wp_customize->add_control( 'satu_extensions_menu', array(
			'label'   => __( 'Choose which type of navigation you like/need.', 'satu-extensions' ),
			'section' => 'satu_extensions_menu_settings',
			'type'    => 'radio',
			'choices' => array(
				'breadcrumbs' => __( 'Use Breadcrumbs', 'satu-extensions' ),
				'menu'        => __( 'Use Menu', 'satu-extensions' )
			),
		) );

}

/**
 * Bind JS handlers to make Theme Customizer preview reload changes asynchronously.
 * Used with blogname and blogdescription.
 *
 * @since 1.0
 */
function satu_extensions_customize_preview_js() {
	?>
	<script type="text/javascript">
		( function( $ ){
			wp.customize( 'blogname', function( value ) {
				value.bind( function( to ) {
					$( '#site-title a' ).html( to );
				} );
			} );
			wp.customize( 'blogdescription', function( value ) {
				value.bind( function( to ) {
					$( '#site-description' ).html( to );
				} );
			} );
		} )( jQuery );
	</script>
	<?php
}

/**
 * Output favicon into the head.
 *
 * @since  1.0
 */
function satu_extensions_favicon_output() {
	if ( get_theme_mod( 'satu_extensions_favicon' ) )
		echo '<link rel="shortcut icon" href="' . esc_url( get_theme_mod( 'satu_extensions_favicon' ) ) . '">' . "\n";
}

/**
 * Output settings CSS into the head.
 *
 * @since 1.0
 */
function satu_extensions_customize_css() { ?>

<style type="text/css">
/* Top border color. */
.site-header { border-color: <?php echo get_theme_mod( 'satu_extensions_top_border_color', '#f00533' ); ?>; }

/* Link color. */
a, 
a:link, 
a:visited { color: <?php echo get_theme_mod( 'satu_extensions_link_color', '#f00533' ); ?>; }

/* Entry link hover background color. */
.entry-wrap a:hover { background: <?php echo get_theme_mod( 'satu_extensions_hover_color', '#f00533' ); ?>; }
.pagination .page-numbers:hover { background: <?php echo get_theme_mod( 'satu_extensions_hover_color', '#f00533' ); ?>; border-color: <?php echo get_theme_mod( 'satu_extensions_hover_color', '#f00533' ); ?>; }

/* Button color. */
<?php $btn = get_theme_mod( 'satu_extensions_btn_color', '#f00533' ); ?>
<?php if ( $btn == '#f00533' ) { ?>
button, 
input[type="reset"], 
input[type="submit"], 
input[type="button"] {}
<?php } else { ?>
button, 
input[type="reset"], 
input[type="submit"], 
input[type="button"] { background: <?php echo $btn; ?>; text-shadow: none; border: 0; }
<?php } ?>

/* Button hover color. */
<?php $btn_hover = get_theme_mod( 'satu_extensions_btn_hover_color', '#f00533' ); ?>
<?php if ( $btn_hover == '#f00533' ) { ?>
button:hover, button:focus,
input[type="reset"]:hover,
input[type="reset"]:focus,
input[type="submit"]:hover,
input[type="submit"]:focus,
input[type="button"]:hover,
input[type="button"]:focus {}
<?php } else { ?>
button:hover, button:focus,
input[type="reset"]:hover,
input[type="reset"]:focus,
input[type="submit"]:hover,
input[type="submit"]:focus,
input[type="button"]:hover,
input[type="button"]:focus { background: <?php echo $btn_hover; ?> }
<?php } ?>

</style>	

<?php }
?>