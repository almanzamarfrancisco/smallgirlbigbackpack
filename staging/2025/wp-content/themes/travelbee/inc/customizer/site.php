<?php
/**
 * Site Title Setting
 *
 * @package Travelbee
 */

function travelbee_customize_register( $wp_customize ) {
	
    $wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
    $wp_customize->get_setting( 'background_color' )->transport = 'refresh';
    $wp_customize->get_setting( 'background_image' )->transport = 'refresh';
	
	if( isset( $wp_customize->selective_refresh ) ){
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'        => '.site-title a',
			'render_callback' => 'travelbee_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'        => '.site-description',
			'render_callback' => 'travelbee_customize_partial_blogdescription',
		) );
	}
    
    /** Logo Width */
    $wp_customize->add_setting(
        'logo_width',
        array(
            'default'           => 150,
            'sanitize_callback' => 'travelbee_sanitize_number_absint',
            'transport'         => 'postMessage'
        )
    );

    $wp_customize->add_control(
        'logo_width',
        array(
            'label'       => __( 'Logo Width', 'travelbee' ),
            'description' => __( 'Set the width(px) of your Site Logo.', 'travelbee' ),
            'section'     => 'title_tagline',
            'type'        => 'number',
            'input_attrs' => array(
                'min' => 1
            )
        )
    );
    
    /** Site Title Font */
    $wp_customize->add_setting( 
        'site_title_font', 
        array(
            'default' => array(                                			
                'font-family' => 'Ovo',
                'variant'     => 'regular',
            ),
            'sanitize_callback' => array( 'Travelbee_Fonts', 'sanitize_typography' )
        ) 
    );

	$wp_customize->add_control( 
        new Travelbee_Typography_Control( 
            $wp_customize, 
            'site_title_font', 
            array(
                'label'       => __( 'Site Title Font', 'travelbee' ),
                'description' => __( 'Site title and tagline font.', 'travelbee' ),
                'section'     => 'title_tagline',
                'priority'    => 60, 
            ) 
        ) 
    );
    
    /** Site Title Font Size*/
    $wp_customize->add_setting( 
        'site_title_font_size', 
        array(
            'default'           => 30,
            'sanitize_callback' => 'travelbee_sanitize_number_absint'
        ) 
    );
    
    $wp_customize->add_control(
		new Travelbee_Slider_Control( 
			$wp_customize,
			'site_title_font_size',
			array(
				'section'	  => 'title_tagline',
				'label'		  => __( 'Site Title Font Size', 'travelbee' ),
				'description' => __( 'Change the font size of your site title.', 'travelbee' ),
                'priority'    => 65,
                'choices'	  => array(
					'min' 	=> 10,
					'max' 	=> 200,
					'step'	=> 1,
				)                 
			)
		)
	);
    
    /** Site Title Color*/
    $wp_customize->add_setting( 
        'site_title_color', 
        array(
            'default'           => '#141414',
            'sanitize_callback' => 'sanitize_hex_color'
        ) 
    );

    $wp_customize->add_control( 
        new WP_Customize_Color_Control( 
            $wp_customize, 
            'site_title_color', 
            array(
                'label'       => __( 'Site Title Color', 'travelbee' ),
                'description' => __( 'Site Title color of the theme.', 'travelbee' ),
                'section'     => 'title_tagline',
                'priority'    => 66,
            )
        )
    );
    
}
add_action( 'customize_register', 'travelbee_customize_register' );