<?php
/**
 * Karma Theme Customizer
 *
 * @package Karma
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */



function karma_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'        => '.site-title a',
			'render_callback' => 'karma_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'        => '.site-description',
			'render_callback' => 'karma_customize_partial_blogdescription',
		) );
	}
}
add_action( 'customize_register', 'karma_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function karma_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function karma_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function karma_customize_preview_js() {
	wp_enqueue_script( 'karma-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'karma_customize_preview_js' );


/**
 * Kirki Customizer Framework
 */
if(class_exists('KIRKI')) {
define('KARMA_KIRKI_CONFIG', 'karma_theme_config_2019');

Kirki::add_config( KARMA_KIRKI_CONFIG, array(
	'capability'    => 'edit_theme_options',
	'option_type'   => 'theme_mod',
) );

// PANEL homepage
Kirki::add_panel( 'panel_homepage', array(
	'priority'    => 10,
	'title'       => esc_html__( 'Homepage', 'karma' ),
	'description' => esc_html__( 'Homepage section maintain', 'karma' ),
) );

// SECTION banner
Kirki::add_section( 'section_banner', array(
	'title'          => esc_html__( 'Banner Section', 'karma' ),
	'description'    => esc_html__( 'All fields which are customizable related to banner section is here', 'karma' ),
	'panel'          => 'panel_homepage',
	'priority'       => 160,
) );

// CONTROLS section->banner
Kirki::add_field( KARMA_KIRKI_CONFIG, [
	'type'     => 'text',
	'settings' => 'my_setting',
	'label'    => esc_html__( 'Text Control', 'karma' ),
	'section'  => 'section_banner',
	'default'  => esc_html__( 'This is a default value', 'karma' ),
	'priority' => 10,
] );

// SECTION latest products
Kirki::add_section( 'section_products', array(
	'title'          => esc_html__( 'Latest Products Slide Section', 'karma' ),
	'description'    => esc_html__( 'All fields which are customizable related to latest product section is here', 'karma' ),
	'panel'          => 'panel_homepage',
	'priority'       => 180,
) );

// CONTROLS section->products => select product_cat
add_action( 'init', function() {

	Kirki::add_field( KARMA_KIRKI_CONFIG, [
		'type'        => 'select',
		'settings'    => 'latest_pro_cat',
		'label'       => esc_html__( 'This is the label', 'karma' ),
		'section'     => 'section_products',
		// 'default'     => 'option-1',
		'placeholder' => esc_html__( 'Select an option...', 'karma' ),
		'priority'    => 10,
		'multiple'    => 50,
		'choices'     => Kirki_Helper::get_terms( 'product_cat' ),
	] ); 

});

/* 
		=======================================
		SECTION: FEATURES (global)
		=======================================
*/

	Kirki::add_section( 'section_features', array(
		'title'          => esc_html__( 'Features Section', 'karma' ),
		'description'    => esc_html__( 'All fields which are customizable related to featues section is here', 'karma' ),
		'panel'          => 'panel_homepage',
		'priority'       => 170,
	) );

// CONTROLS section->featues->hide
	Kirki::add_field( KARMA_KIRKI_CONFIG, [
		'type'     => 'switch',
		'settings' => 'featues_switcher',
		'label'    => esc_html__( 'Hide or show Feature section', 'karma' ),
		'section'  => 'section_features',
		'default' => 1,
		'priority' => 10,
	] );

	// CONTROLS section->fetures->repeater
	Kirki::add_field( KARMA_KIRKI_CONFIG, [
		'type'        => 'repeater',
		'section'     => 'section_features',
		'settings'     => 'features_repeater',
		'label'       => esc_html__( 'Features', 'karma' ),
		'description'       => esc_html__( 'This features will be visible at feature section of the theme', 'karma' ),
		'priority'    => 15,
		'active_callback' =>array(
			array(
				'setting' => 'featues_switcher',
				'operator' => '===',
				'value' => true
			)
		),
		'choices' => array(
			'limit' => 12,
		),
		'row_label' => [
			'type'  => 'text',
			'value' => esc_html__( 'Feature', 'karma' ),
		],
		'fields' => [
			'feature_icon' => [
				'type'        => 'upload',
				'label'       => esc_html__( 'Icon (image)', 'karma' ),
			],
			'feature_title'  => [
				'type'        => 'text',
				'label'       => esc_html__( 'Title', 'karma' ),
				'default'     => __('Section is here','karma'),
			],
			'feature_description'  => [
				'type'        => 'textarea',
				'label'       => esc_html__( 'Description', 'karma' ),
				'default'     => __('There is a more recent autosave of your changes than the one you are previewing.','karma'),
			],
		]
	] );

	/* 
		=======================================
		SECTION: EXCLUSIVE DEALS (hot deals)
		=======================================
	*/

		Kirki::add_section( 'section_hot_deal', array(
		'title'          => esc_html__( 'Exclusive Deal', 'karma' ),
		'description'    => esc_html__( 'All fields which are customizable related to Exclusive Deal section is here', 'karma' ),
		'panel'          => 'panel_homepage',
		'priority'       => 190,
	) );

		// CONTROLS section->ed->title
		Kirki::add_field( KARMA_KIRKI_CONFIG, [
			'type'     => 'text',
			'settings' => 'edt_title',
			'label'    => esc_html__( 'Counter Title', 'karma' ),
			'section'  => 'section_hot_deal',
			'priority' => 10,
			'default' => __('Exclusive Hot Deal Ends Soon!', 'karma')
		] );

		// CONTROLS section->ed->subtitle
		Kirki::add_field( KARMA_KIRKI_CONFIG, [
			'type'     => 'text',
			'settings' => 'edt_subtitle',
			'label'    => esc_html__( 'Counter Sub Title', 'karma' ),
			'section'  => 'section_hot_deal',
			'priority' => 15,
			'default' => __('Hurray Up!', 'karma'),
		] );

		// CONTROLS section->ed->days
		Kirki::add_field( KARMA_KIRKI_CONFIG, [
			'type'     => 'text',
			'settings' => 'edt_days',
			'label'    => esc_html__( 'Counter Days', 'karma' ),
			'section'  => 'section_hot_deal',
			'priority' => 20,
			'default' => __('10', 'karma'),
		] );

		// CONTROLS section->ed->hours
		Kirki::add_field( KARMA_KIRKI_CONFIG, [
			'type'     => 'text',
			'settings' => 'edt_hours',
			'label'    => esc_html__( 'Counter Hours', 'karma' ),
			'section'  => 'section_hot_deal',
			'priority' => 25,
			'default' => __('10', 'karma'),
		] );

		// CONTROLS section->ed->mins
		Kirki::add_field( KARMA_KIRKI_CONFIG, [
			'type'     => 'text',
			'settings' => 'edt_mins',
			'label'    => esc_html__( 'Counter Minutes', 'karma' ),
			'section'  => 'section_hot_deal',
			'priority' => 30,
			'default' => __('10', 'karma'),
		] );

		// CONTROLS section->ed->secs
		Kirki::add_field( KARMA_KIRKI_CONFIG, [
			'type'     => 'text',
			'settings' => 'edt_secs',
			'label'    => esc_html__( 'Counter Seconds', 'karma' ),
			'section'  => 'section_hot_deal',
			'priority' => 35,
			'default' => __('10', 'karma'),
		] );
	
	// CONTROLS section->exclusive deals => select product_cat
	add_action( 'init', function() {

		Kirki::add_field( KARMA_KIRKI_CONFIG, [
			'type'        => 'radio',
			'settings'    => 'hot_deal_cat',
			'label'       => esc_html__( 'Select Hot Deal Product Category', 'karma' ),
			'section'     => 'section_hot_deal',
			'placeholder' => esc_html__( 'Select a category', 'karma' ),
			'priority'    => 40,
			// 'multiple'    => 3,
			'choices'     => Kirki_Helper::get_terms( 'product_cat' ),
		] ); 

	});

	/* 
		=======================================
		SECTION: BRAND (global)
		=======================================
*/

	Kirki::add_section( 'section_brands', array(
		'title'          => esc_html__( 'Brands Section', 'karma' ),
		'description'    => esc_html__( 'All fields which are customizable related to Brands section is here', 'karma' ),
		'panel'          => 'panel_homepage',
		'priority'       => 200,
	) );

	// CONTROLS section->brands->hide
		Kirki::add_field( KARMA_KIRKI_CONFIG, [
			'type'     => 'switch',
			'settings' => 'brand_switcher',
			'label'    => esc_html__( 'Hide or show Brand section', 'karma' ),
			'section'  => 'section_brands',
			'default' => 1,
			'priority' => 10,
			'transport' => auto,
			// 'output' => array(
			// 	array(
			// 		'element' => '.brand-area',
			// 		'value' => 'display',
			// 	),
			// )
		] );

		// CONTROLS section->brands->repeater
		Kirki::add_field( KARMA_KIRKI_CONFIG, [
			'type'        => 'repeater',
			'section'     => 'section_brands',
			'settings'     => 'brands_repeater',
			'label'       => esc_html__( 'Brands', 'karma' ),
			'description'       => esc_html__( 'This brands will be visible at brand section of the theme', 'karma' ),
			'priority'    => 15,
			'active_callback' =>array(
				array(
					'setting' => 'brand_switcher',
					'operator' => '===',
					'value' => true
				),
			),
			'choices' => array(
				'limit' => 15,
			),
			'row_label' => [
				'type'  => 'text',
				'value' => esc_html__( 'Brand', 'karma' ),
			],
			'fields' => [
				'brand_img' => [
					'type'        => 'upload',
					'label'       => esc_html__( 'Image', 'karma' ),
				],
				'brand_title'  => [
					'type'        => 'text',
					'label'       => esc_html__( 'Title', 'karma' ),
					'default'     => __('Section is here','karma'),
				],
				'brand_url'  => [
					'type'        => 'url',
					'label'       => esc_html__( 'Link (URL)', 'karma' ),
					'default'     => __('#','karma'),
				],
			]
		] );
}