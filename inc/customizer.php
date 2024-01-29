<?php
/**
 * eMega Theme Customizer
 *
 * @package eMega
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function emega_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
	//   $wp_customize->add_control();
//   $wp_customize->get_control();
//   $wp_customize->remove_control();
$wp_customize->add_setting('emega_theme_options[color_scheme]', array(
'default'        => 'value2',
'capability'     => 'edit_theme_options',
'type'           => 'option',
));
$wp_customize->add_control('emega_color_scheme', array(
'label'      => __('Color Scheme', 'emega'),
'section'    => 'emega_color_scheme',
'settings'   => 'emega_theme_options[color_scheme]',
'type'       => 'radio',
'choices'    => array(
'value1' => 'Choice 1',
'value2' => 'Choice 2',
'value3' => 'Choice 3',
),
));

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			'blogname',
			array(
				'selector'        => '.site-title a',
				'render_callback' => 'emega_customize_partial_blogname',
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'blogdescription',
			array(
				'selector'        => '.site-description',
				'render_callback' => 'emega_customize_partial_blogdescription',
			)
		);
	}
	$wp_customize->add_control('emega_text_test', array(
'label'      => __('Text Test', 'emega'),
'section'    => 'emega_color_scheme',
'settings'   => 'emega_theme_options[text_test]',
));
}
add_action( 'customize_register', 'emega_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function emega_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function emega_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function emega_customize_preview_js() {
	wp_enqueue_script( 'emega-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), _S_VERSION, true );
}
add_action( 'customize_preview_init', 'emega_customize_preview_js' );
