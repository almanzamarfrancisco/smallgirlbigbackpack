<?php
/**
 * Frontpage Settings
 *
 * @package Travelbee
 */

function travelbee_customize_frontpage( $wp_customize ) {
    
    /** Frontpage Settings */
    $wp_customize->add_panel( 
        'frontpage_settings',
         array(
            'priority'    => 50,
            'capability'  => 'edit_theme_options',
            'title'       => __( 'Front Page Settings', 'travelbee' ),
        )
    );

	$wp_customize->get_section( 'header_image' )->panel                    = 'frontpage_settings';
    $wp_customize->get_section( 'header_image' )->title                    = __( 'Banner Section', 'travelbee' );
    $wp_customize->get_section( 'header_image' )->priority                 = 20;
    $wp_customize->get_control( 'header_image' )->active_callback          = 'travelbee_banner_ac';
    $wp_customize->get_control( 'header_video' )->active_callback          = 'travelbee_banner_ac';
    $wp_customize->get_control( 'external_header_video' )->active_callback = 'travelbee_banner_ac';
    $wp_customize->get_section( 'header_image' )->description              = '';                                               
    $wp_customize->get_setting( 'header_image' )->transport                = 'refresh';
    $wp_customize->get_setting( 'header_video' )->transport                = 'refresh';
    $wp_customize->get_setting( 'external_header_video' )->transport       = 'refresh';
    
    /** Banner Options */
    $wp_customize->add_setting(
		'ed_banner_section',
		array(
			'default'			=> 'slider_banner',
			'sanitize_callback' => 'travelbee_sanitize_select'
		)
	);

	$wp_customize->add_control(
        new Travelbee_Select_Control(
    		$wp_customize,
    		'ed_banner_section',
    		array(
                'label'	      => __( 'Banner Options', 'travelbee' ),
                'description' => __( 'Choose banner as static image/video or as a slider.', 'travelbee' ),
    			'section'     => 'header_image',
    			'choices'     => array(
                    'no_banner'        => __( 'Disable Banner Section', 'travelbee' ),
                    'static_banner'    => __( 'Static/Video CTA Banner', 'travelbee' ),
                    'slider_banner'    => __( 'Banner as Slider', 'travelbee' ),
                ),
                'priority' => 5	
     		)            
		)
    );
    
    /** Title */
    $wp_customize->add_setting(
        'banner_title',
        array(
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage'
        )
    );
    
    $wp_customize->add_control(
        'banner_title',
        array(
            'label'           => __( 'Title', 'travelbee' ),
            'section'         => 'header_image',
            'type'            => 'text',
            'active_callback' => 'travelbee_banner_ac'
        )
    );
    
    $wp_customize->selective_refresh->add_partial( 'banner_title', array(
        'selector'        => '.banner-caption .banner-title',
        'render_callback' => 'travelbee_get_banner_title',
    ) );
    
    /** Sub Title */
    $wp_customize->add_setting(
        'banner_description',
        array(
            'default'           => '',
            'sanitize_callback' => 'wp_kses_post',
            'transport'         => 'postMessage'
        )
    );
    
    $wp_customize->add_control(
        'banner_description',
        array(
            'label'           => __( 'Description', 'travelbee' ),
            'section'         => 'header_image',
            'type'            => 'textarea',
            'active_callback' => 'travelbee_banner_ac'
        )
    );
    
    $wp_customize->selective_refresh->add_partial( 'banner_description', array(
        'selector'        => '.banner-caption .banner-description',
        'render_callback' => 'travelbee_get_banner_description',
    ) );

    /** Button One Label */
    $wp_customize->add_setting(
        'button_one_label',
        array(
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage'
        )
    );
    
    $wp_customize->add_control(
        'button_one_label',
        array(
            'label'           => __( 'Button One Label', 'travelbee' ),
            'section'         => 'header_image',
            'type'            => 'text',
            'active_callback' => 'travelbee_banner_ac'
        )
    );

    $wp_customize->selective_refresh->add_partial( 'button_one_label', array(
        'selector'        => '.banner-button-wrap .wc-btn-one',
        'render_callback' => 'travelbee_get_banner_button_one_label',
    ) );
    
    /** Button Link */
    $wp_customize->add_setting(
        'button_one_link',
        array(
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
        )
    );
    
    $wp_customize->add_control(
        'button_one_link',
        array(
            'label'           => __( 'Button One Link', 'travelbee' ),
            'section'         => 'header_image',
            'type'            => 'url',
            'active_callback' => 'travelbee_banner_ac'
        )
    );

    /** link in new tab` */
    $wp_customize->add_setting(
        'banner_new_tab',
        array(
            'default'           => false,
            'sanitize_callback' => 'travelbee_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
        new Travelbee_Toggle_Control( 
            $wp_customize,
            'banner_new_tab',
            array(
                'section'         => 'header_image',
                'label'           => __( 'Open Link in New Tab ', 'travelbee' ),
                'description'     => __( 'Enable to open button one link in new tab.', 'travelbee' ),
                'active_callback' => 'travelbee_banner_ac'
            )
        )
    );
    
    /** Button Two Label Two*/
    $wp_customize->add_setting(
        'button_two_label',
        array(
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage'
        )
    );
    
    $wp_customize->add_control(
        'button_two_label',
        array(
            'label'           => __( 'Button Two Label', 'travelbee' ),
            'section'         => 'header_image',
            'type'            => 'url',
            'active_callback' => 'travelbee_banner_ac'
        )
    );

    $wp_customize->selective_refresh->add_partial( 'button_two_label', array(
        'selector'        => '.banner-button-wrap .wc-btn-two',
        'render_callback' => 'travelbee_get_banner_button_two_label',
    ) );
    
    /** Button Link Two */
    $wp_customize->add_setting(
        'button_two_link',
        array(
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
        )
    );
    
    $wp_customize->add_control(
        'button_two_link',
        array(
            'label'           => __( 'Button Link', 'travelbee' ),
            'section'         => 'header_image',
            'type'            => 'text',
            'active_callback' => 'travelbee_banner_ac'
        )
    );

    $wp_customize->add_setting(
        'banner_new_tab_two',
        array(
            'default'           => false,
            'sanitize_callback' => 'travelbee_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
        new Travelbee_Toggle_Control( 
            $wp_customize,
            'banner_new_tab_two',
            array(
                'section'         => 'header_image',
                'label'           => __( 'Open Link in New Tab ', 'travelbee' ),
                'description'     => __( 'Enable to open button two link in new tab.', 'travelbee' ),
                'active_callback' => 'travelbee_banner_ac'
            )
        )
    );

    // Banner Caption Alignment
    $wp_customize->add_setting( 
        'banner_caption_layout', 
        array(
            'default'           => 'left',
            'sanitize_callback' => 'travelbee_sanitize_radio'
        ) 
    );
    
    $wp_customize->add_control(
        new Travelbee_Radio_Buttonset_Control(
            $wp_customize,
            'banner_caption_layout',
            array(
                'section'     => 'header_image',
                'label'       => __( 'Banner Caption Alignment', 'travelbee' ),
                'description' => __( 'Choose alignment for banner caption.', 'travelbee' ),
                'choices'     => array(
                    'left'      => __( 'Left', 'travelbee' ),
                    'right'     => __( 'Right', 'travelbee' ),
                ),
                'active_callback' => 'travelbee_banner_ac' 
            )
        )
    );
    
    /** Slider Content Style */
    $wp_customize->add_setting(
		'slider_type',
		array(
			'default'			=> 'latest_posts',
			'sanitize_callback' => 'travelbee_sanitize_select'
		)
	);

	$wp_customize->add_control(
		new Travelbee_Select_Control(
    		$wp_customize,
    		'slider_type',
    		array(
                'label'	  => __( 'Slider Content Style', 'travelbee' ),
    			'section' => 'header_image',
    			'choices' => array(
                    'latest_posts' => __( 'Latest Posts', 'travelbee' ),
                    'cat'          => __( 'Category', 'travelbee' ),
                ),
                'active_callback' => 'travelbee_banner_ac'	
     		)
		)
	);
    
    /** Slider Category */
    $wp_customize->add_setting(
		'slider_cat',
		array(
			'default'			=> '',
			'sanitize_callback' => 'travelbee_sanitize_select'
		)
	);

	$wp_customize->add_control(
        new Travelbee_Select_Control(
    		$wp_customize,
    		'slider_cat',
    		array(
                'label'	          => __( 'Slider Category', 'travelbee' ),
    			'section'         => 'header_image',
    			'choices'         => travelbee_get_categories(),
                'active_callback' => 'travelbee_banner_ac'	
     		)
		)
	);
    
    /** No. of slides */
    $wp_customize->add_setting(
        'no_of_slides',
        array(
            'default'           => 3,
            'sanitize_callback' => 'travelbee_sanitize_number_absint'
        )
    );
    
    $wp_customize->add_control(
		new Travelbee_Slider_Control( 
			$wp_customize,
			'no_of_slides',
			array(
				'section'     => 'header_image',
                'label'       => __( 'Number of Slides', 'travelbee' ),
                'description' => __( 'Choose the number of slides you want to display', 'travelbee' ),
                'choices'	  => array(
					'min' 	=> 1,
					'max' 	=> 20,
					'step'	=> 1,
				),
                'active_callback' => 'travelbee_banner_ac'                 
			)
		)
	);
        
    
    /** HR */
    $wp_customize->add_setting(
        'banner_hr',
        array(
            'default'           => '',
            'sanitize_callback' => 'wp_kses_post' 
        )
    );
    
    $wp_customize->add_control(
        new Travelbee_Note_Control( 
			$wp_customize,
			'banner_hr',
			array(
				'section'	  => 'header_image',
				'description' => '<hr/>',
                'active_callback' => 'travelbee_banner_ac'
			)
		)
    );
    
    /** Include Repetitive Posts */
    $wp_customize->add_setting(
        'include_repetitive_posts',
        array(
            'default'           => true,
            'sanitize_callback' => 'travelbee_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
        new Travelbee_Toggle_Control( 
			$wp_customize,
			'include_repetitive_posts',
			array(
				'section'         => 'header_image',
				'label'           => __( 'Include Repetitive Posts', 'travelbee' ),
				'description'     => __( 'Enable to add posts included in slider in blog page too.', 'travelbee' ),
				'active_callback' => 'travelbee_banner_ac'
			)
		)
    );
    
    /** Slider Auto */
    $wp_customize->add_setting(
        'slider_auto',
        array(
            'default'           => false,
            'sanitize_callback' => 'travelbee_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
        new Travelbee_Toggle_Control( 
			$wp_customize,
			'slider_auto',
			array(
				'section'     => 'header_image',
				'label'       => __( 'Slider Auto', 'travelbee' ),
                'description' => __( 'Enable slider auto transition.', 'travelbee' ),
                'active_callback' => 'travelbee_banner_ac'
			)
		)
	);
    
    /** Slider Loop */
    $wp_customize->add_setting(
        'slider_loop',
        array(
            'default'           => false,
            'sanitize_callback' => 'travelbee_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
        new Travelbee_Toggle_Control( 
			$wp_customize,
			'slider_loop',
			array(
				'section'     => 'header_image',
				'label'       => __( 'Slider Loop', 'travelbee' ),
                'description' => __( 'Enable slider loop.', 'travelbee' ),
                'active_callback' => 'travelbee_banner_ac'
			)
		)
	);
    
    /** Slider Caption */
    $wp_customize->add_setting(
        'slider_caption',
        array(
            'default'           => true,
            'sanitize_callback'=> 'travelbee_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
        new Travelbee_Toggle_Control( 
			$wp_customize,
			'slider_caption',
			array(
				'section'     => 'header_image',
				'label'       => __( 'Slider Caption', 'travelbee' ),
                'description' => __( 'Enable slider caption.', 'travelbee' ),
                'active_callback' => 'travelbee_banner_ac'
			)
		)
	);
    
    /** Slider Animation */
    $wp_customize->add_setting(
		'slider_animation',
		array(
			'default'			=> '',
			'sanitize_callback' => 'travelbee_sanitize_select'
		)
	);

	$wp_customize->add_control(
        new Travelbee_Select_Control(
    		$wp_customize,
    		'slider_animation',
    		array(
                'label'	      => __( 'Slider Animation', 'travelbee' ),
                'section'     => 'header_image',
    			'choices'     => array(
                    'bounceOut'      => __( 'Bounce Out', 'travelbee' ),
                    'bounceOutLeft'  => __( 'Bounce Out Left', 'travelbee' ),
                    'bounceOutRight' => __( 'Bounce Out Right', 'travelbee' ),
                    'bounceOutUp'    => __( 'Bounce Out Up', 'travelbee' ),
                    'bounceOutDown'  => __( 'Bounce Out Down', 'travelbee' ),
                    'fadeOut'        => __( 'Fade Out', 'travelbee' ),
                    'fadeOutLeft'    => __( 'Fade Out Left', 'travelbee' ),
                    'fadeOutRight'   => __( 'Fade Out Right', 'travelbee' ),
                    'fadeOutUp'      => __( 'Fade Out Up', 'travelbee' ),
                    'fadeOutDown'    => __( 'Fade Out Down', 'travelbee' ),
                    'flipOutX'       => __( 'Flip OutX', 'travelbee' ),
                    'flipOutY'       => __( 'Flip OutY', 'travelbee' ),
                    'hinge'          => __( 'Hinge', 'travelbee' ),
                    'pulse'          => __( 'Pulse', 'travelbee' ),
                    'rollOut'        => __( 'Roll Out', 'travelbee' ),
                    'rotateOut'      => __( 'Rotate Out', 'travelbee' ),
                    'rubberBand'     => __( 'Rubber Band', 'travelbee' ),
                    'shake'          => __( 'Shake', 'travelbee' ),
                    ''               => __( 'Slide', 'travelbee' ),
                    'slideOutLeft'   => __( 'Slide Out Left', 'travelbee' ),
                    'slideOutRight'  => __( 'Slide Out Right', 'travelbee' ),
                    'slideOutUp'     => __( 'Slide Out Up', 'travelbee' ),
                    'slideOutDown'   => __( 'Slide Out Down', 'travelbee' ),
                    'swing'          => __( 'Swing', 'travelbee' ),
                    'tada'           => __( 'Tada', 'travelbee' ),
                    'zoomOut'        => __( 'Zoom Out', 'travelbee' ),
                    'zoomOutLeft'    => __( 'Zoom Out Left', 'travelbee' ),
                    'zoomOutRight'   => __( 'Zoom Out Right', 'travelbee' ),
                    'zoomOutUp'      => __( 'Zoom Out Up', 'travelbee' ),
                    'zoomOutDown'    => __( 'Zoom Out Down', 'travelbee' ),                    
                ),
                'active_callback' => 'travelbee_banner_ac'                                	
     		)
		)
    );
    
    /** Slider Speed */
    $wp_customize->add_setting(
        'slider_speed',
        array(
            'default'           => 5000,
            'sanitize_callback' => 'travelbee_sanitize_number_absint'
        )
    );
    
    $wp_customize->add_control(
        new Travelbee_Slider_Control( 
            $wp_customize,
            'slider_speed',
            array(
                'section'     => 'header_image',
                'label'       => __( 'Slider Speed', 'travelbee' ),
                'description' => __( 'Controls the speed of slider in miliseconds.', 'travelbee' ),
                'choices'     => array(
                    'min'  => 1000,
                    'max'  => 20000,
                    'step' => 500,
                ),
                'active_callback' => 'travelbee_banner_ac'
            )
        )
    );
    
    /** Read More Text */
    $wp_customize->add_setting(
        'slider_readmore',
        array(
            'default'           => __( 'Continue Reading', 'travelbee' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage' 
        )
    );
    
    $wp_customize->add_control(
        'slider_readmore',
        array(
            'type'            => 'text',
            'section'         => 'header_image',
            'label'           => __( 'Slider Read More', 'travelbee' ),
            'active_callback' => 'travelbee_banner_ac'
        )
    );
    
    $wp_customize->selective_refresh->add_partial( 'slider_readmore', array(
        'selector' => '.site-banner .button-wrap .btn-link',
        'render_callback' => 'travelbee_get_slider_readmore',
    ) );

     /** Featured Section */
     $wp_customize->add_section(
        'featured',
        array(
            'title'    => __( 'Featured Section', 'travelbee' ),
            'priority' => 25,
            'panel'    => 'frontpage_settings',
        )
    );

    $wp_customize->add_setting(
        'featured_note_text',
        array(
            'default'           => '',
            'sanitize_callback' => 'wp_kses_post' 
        )
    );
    
    $wp_customize->add_control(
        new Travelbee_Note_Control( 
            $wp_customize,
            'featured_note_text',
            array(
                'section'     => 'featured',
                'description' => __( '<hr/>Add "Rara: Image Text" widget for featured area section.', 'travelbee' ),
                'priority'    => -1
            )
        )
    );

    $featured_section = $wp_customize->get_section( 'sidebar-widgets-featured' );
    if ( ! empty( $featured_section ) ) {
        $featured_section->panel     = 'frontpage_settings';
        $featured_section->priority  = 30;
        $wp_customize->get_control( 'featured_note_text' )->section = 'sidebar-widgets-featured';
    }  
    
    /** Featured Section Ends */ 


    /** About Section */

    $wp_customize->add_section(
        'about',
        array(
            'title'    => __( 'About Section', 'travelbee' ),
            'panel'    => 'frontpage_settings',
        )
    );

    /** Related Post Taxonomy */    
    $wp_customize->add_setting( 
        'about_bg', 
        array(
            'default'           => 'color',
            'sanitize_callback' => 'travelbee_sanitize_radio'
        ) 
    );
    
    $wp_customize->add_control(
        new Travelbee_Radio_Buttonset_Control(
            $wp_customize,
            'about_bg',
            array(
                'section'	  => 'about',
                'label'       => __( 'About Background', 'travelbee' ),
                'description' => __( 'Choose background of about section. The recommended size for image is 422px by 780px in PNG format.', 'travelbee' ),
                'choices'	  => array(
                    'image'  => __( 'Image', 'travelbee' ),
                    'color'  => __( 'Color', 'travelbee' ),
                ),
            )
        )
    );

    /**Background image */
    $wp_customize->add_setting( 'about_bg_image',
        array(
            'default'           => '',
            'sanitize_callback' => 'travelbee_sanitize_image',
        )
    );
    
    $wp_customize->add_control( 
        new WP_Customize_Image_Control( 
            $wp_customize, 
           'about_bg_image',
            array(
                'label'         => esc_html__( 'Background Image', 'travelbee' ),
                'section'       => 'about',
                'type'          => 'image',
                'active_callback'   => 'travelbee_about_sec_ac'
            )
        )
    );

    $wp_customize->add_setting( 
        'about_bg_color', 
        array(
            'default'           => '#f5ede8', 
            'sanitize_callback' => 'sanitize_hex_color',                       
        )
    );
 
 
    // Add Controls
    $wp_customize->add_control( 
        new WP_Customize_Color_Control( 
            $wp_customize, 
            'about_bg_color', 
            array(
                'label'             => 'About Background Color',
                'section'           => 'about',
                'active_callback'   => 'travelbee_about_sec_ac'
            )
        )
    );

    $wp_customize->add_setting(
        'about_note_text',
        array(
            'default'           => '',
            'sanitize_callback' => 'wp_kses_post' 
        )
    );
    
    $wp_customize->add_control(
        new Travelbee_Note_Control( 
            $wp_customize,
            'about_note_text',
            array(
                'section'     => 'about',
                'description' => __( '<hr/>Add "Rara: Featured Page" widget for featured area section.', 'travelbee' ),
                'priority'    => -1
            )
        )
    );

    $about_section = $wp_customize->get_section( 'sidebar-widgets-about' );
    if ( ! empty( $about_section ) ) {

        $about_section->panel     = 'frontpage_settings';
        $about_section->priority  = 35;
        $wp_customize->get_control( 'about_bg' )->section  = 'sidebar-widgets-about';
        $wp_customize->get_control( 'about_bg_image' )->section  = 'sidebar-widgets-about';
        $wp_customize->get_control( 'about_bg_color' )->section  = 'sidebar-widgets-about';
        $wp_customize->get_control( 'about_note_text' )->section = 'sidebar-widgets-about';
    }  
    
    /** About Section Ends */  

     
    /** Shop Settings */
    $wp_customize->add_section(
        'shop_settings',
        array(
            'title'    => __( 'Shop Settings', 'travelbee' ),
            'priority' => 40,
            'panel'    => 'frontpage_settings',
        )
    );
    
    if( travelbee_is_woocommerce_activated() ){        
        /** Shop Section */
        $wp_customize->add_setting( 
            'ed_shop_section', 
            array(
                'default'           => false,
                'sanitize_callback' => 'travelbee_sanitize_checkbox'
            ) 
        );
        
        $wp_customize->add_control(
    		new Travelbee_Toggle_Control( 
    			$wp_customize,
    			'ed_shop_section',
    			array(
    				'section'     => 'shop_settings',
    				'label'	      => __( 'Shop Section', 'travelbee' ),
                    'description' => __( 'Enable to show Shop Section below Featured Section', 'travelbee' ),
    			)
    		)
    	);
        
        /** Related Post Taxonomy */    
        $wp_customize->add_setting( 
            'shop_bg', 
            array(
                'default'           => 'color',
                'sanitize_callback' => 'travelbee_sanitize_radio'
            ) 
        );
        
        $wp_customize->add_control(
    		new Travelbee_Radio_Buttonset_Control(
    			$wp_customize,
    			'shop_bg',
    			array(
    				'section'	  => 'shop_settings',
    				'label'       => __( 'Shop Background', 'travelbee' ),
                    'description' => __( 'Choose background of shop section. The recommended size for image is 1920px by 790px in PNG format.', 'travelbee' ),
    				'choices'	  => array(
    					'image'  => __( 'Image', 'travelbee' ),
                        'color'  => __( 'Color', 'travelbee' ),
    				),
                    'active_callback' => 'travelbee_shop_sec_ac'
    			)
    		)
    	);
    
        $wp_customize->add_setting( 
            'shop_bg_image', 
            array(
                'default' 			=> '',
                'sanitize_callback' => 'travelbee_sanitize_image'
            )
        );
     
        $wp_customize->add_control( 
            new WP_Customize_Image_Control( 
                $wp_customize, 
                'shop_bg_image', 
                array(
                    'label'             => __( 'Upload an image', 'travelbee' ),
                    'section'           => 'shop_settings',
                    'active_callback'   => 'travelbee_shop_sec_ac'
                )
            )
        );

        $wp_customize->add_setting( 
            'shop_bg_color', 
            array(
                'default'           => '#fafafa', 
                'sanitize_callback' => 'sanitize_hex_color',                       
            )
        );
     
     
        // Add Controls
        $wp_customize->add_control( 
            new WP_Customize_Color_Control( 
                $wp_customize, 
                'shop_bg_color', 
                array(
                    'label'             => 'Shop Background Color',
                    'section'           => 'shop_settings',
                    'active_callback'   => 'travelbee_shop_sec_ac'
                )
            )
        );

        /** Shop Section Title */
        $wp_customize->add_setting(
            'shop_section_title',
            array(
                'default'           => __( 'Shop', 'travelbee' ),
                'sanitize_callback' => 'sanitize_text_field',
                'transport'         => 'postMessage'
            )
        );
        
        $wp_customize->add_control(
            'shop_section_title',
            array(
                'type'        => 'text',
                'section'     => 'shop_settings',
                'label'       => __( 'Shop Section Title', 'travelbee' ),
                'active_callback' => 'travelbee_shop_sec_ac'
            )
        );
        
        $wp_customize->selective_refresh->add_partial( 'shop_section_title', array(
            'selector' => '.product-section .section-header h2.section-title',
            'render_callback' => 'travelbee_get_shop_title',
        ) );
    
        /** Shop Section Content */
        $wp_customize->add_setting(
            'shop_section_content',
            array(
                'default'           => '',
                'sanitize_callback' => 'sanitize_text_field',
                'transport'         => 'postMessage'
            )
        );
        
        $wp_customize->add_control(
            'shop_section_content',
            array(
                'type'        => 'text',
                'section'     => 'shop_settings',
                'label'       => __( 'Section Description', 'travelbee' ),
                'active_callback' => 'travelbee_shop_sec_ac'
            )
        );
        
        $wp_customize->selective_refresh->add_partial( 'shop_section_content', array(
            'selector' => '.product-section .section-header .section-desc p',
            'render_callback' => 'travelbee_get_shop_content',
        ) );
        
        $wp_customize->add_setting(
    		'product_type',
    		array(
    			'default'			=> 'latest-products',
    			'sanitize_callback' => 'travelbee_sanitize_select'
    		)
    	);
    
    	$wp_customize->add_control(
    		new Travelbee_Select_Control(
        		$wp_customize,
        		'product_type',
        		array(
                    'label'	  => __( 'Product Category', 'travelbee' ),
        			'section' => 'shop_settings',
        			'choices' => array(
                        'latest-products'   => __( 'Latest Products', 'travelbee' ),
                        'popular-products'  => __( 'Popular Products', 'travelbee' ),
                        'sale-products'     => __( 'Sale Products', 'travelbee' ),
                        'custom'            => __( 'Custom', 'travelbee' )
                    ),
                    'active_callback' => 'travelbee_shop_sec_ac'
                )
    		)
    	);

        $wp_customize->add_setting(
            'selected_products',
            array(
                'default'			=> '',
                'sanitize_callback' => 'travelbee_sanitize_select'
            )
        );
    
        $wp_customize->add_control(
            new Travelbee_Select_Control(
                $wp_customize,
                'selected_products',
                array(
                    'label'	  	=> __( 'Select Products', 'travelbee' ),
                    'section' 	=> 'shop_settings',
                    'choices' 	=> travelbee_get_posts( 'product' ),
                    'multiple'	=> 4, 
                    'active_callback' => 'travelbee_shop_sec_ac'
                )
            )
        );

        $wp_customize->add_setting( 
            'shop_btn_lbl', 
            array(
                'default'           => __( 'Go To Shop', 'travelbee' ),
                'sanitize_callback' => 'sanitize_text_field',
                'transport'         => 'postMessage'
            ) 
        );
        
        $wp_customize->add_control(
            'shop_btn_lbl',
            array(
                'section'         => 'shop_settings',
                'label'           => __( 'Shop Button Label', 'travelbee' ),
                'type'            => 'text',
                'active_callback' => 'travelbee_shop_sec_ac'
            )
        );

        $wp_customize->selective_refresh->add_partial( 'shop_btn_lbl', array(
            'selector' => '.product-section .button-wrap a.btn-readmore ',
            'render_callback' => 'travelbee_get_shop_btn_lbl',
        ) );
    
        $wp_customize->add_setting( 
            'shop_btn_link', 
            array(
                'default'           => '',
                'sanitize_callback' => 'esc_url_raw'
            ) 
        );
        
        $wp_customize->add_control(
            'shop_btn_link',
            array(
                'section'         => 'shop_settings',
                'label'           => __( 'Shop Button Link', 'travelbee' ),
                'type'            => 'url',
                'active_callback' => 'travelbee_shop_sec_ac'
            )
        );
        
    }else{
        /** Note */
        $wp_customize->add_setting(
			'woocommerce_recommend',
			array(
				'sanitize_callback' => 'wp_kses_post',
			)
		);

		$wp_customize->add_control(
			new Travelbee_Plugin_Recommend_Control(
				$wp_customize,
				'woocommerce_recommend',
				array(
					'section'     => 'shop_settings',
					'capability'  => 'install_plugins',
					'plugin_slug' => 'woocommerce',//This is the slug of recommended plugin.
					'description' => sprintf( __( 'Please install and activate the recommended plugin %1$sWooCommerce%2$s. After that option related with this section will be visible.', 'travelbee' ), '<strong>', '</strong>' ),
				)
			)
		);
    }
    /** Shop Settings Ends */
    
    /** Cta Section */
    $wp_customize->add_section(
        'cta',
        array(
            'title'    => __( 'CTA Section', 'travelbee' ),
            'priority' => 60,
            'panel'    => 'frontpage_settings',
        )
    );

    /** Enable CTA Section */
    $wp_customize->add_setting( 
        'ed_cta_sec', 
        array(
            'default'           => false,
            'sanitize_callback' => 'travelbee_sanitize_checkbox'
        ) 
    );
    
    $wp_customize->add_control(
		new Travelbee_Toggle_Control( 
			$wp_customize,
			'ed_cta_sec',
			array(
				'section'     => 'cta',
				'label'	      => __( 'Enable CTA Section', 'travelbee' ),
			)
		)
	);

    $wp_customize->add_setting(
        'cta_subtitle',
        array(
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage'
        )
    );
    
    $wp_customize->add_control(
        'cta_subtitle',
        array(
            'type'    => 'text',
            'section' => 'cta',
            'label'   => __( 'Section Subtitle', 'travelbee' ),
            'active_callback' => 'travelbee_cta_ac'
        )
    );

    $wp_customize->selective_refresh->add_partial( 'cta_subtitle', array(
        'selector'            => '.advance-cta  span.sub-title',
        'render_callback'     => 'travelbee_get_cta_subtitle',
    ) );

    $wp_customize->add_setting(
        'cta_title',
        array(
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage'
        )
    );
    
    $wp_customize->add_control(
        'cta_title',
        array(
            'type'    => 'text',
            'section' => 'cta',
            'label'   => __( 'Section Title', 'travelbee' ),
            'active_callback' => 'travelbee_cta_ac'
        )
    );

    $wp_customize->selective_refresh->add_partial( 'cta_title', array(
        'selector'            => '.advance-cta  h2.title',
        'render_callback'     => 'travelbee_get_cta_title',
    ) );

    $wp_customize->add_setting(
        'cta_content',
        array(
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage'
        )
    );
    
    $wp_customize->add_control(
        'cta_content',
        array(
            'type'    => 'text',
            'section' => 'cta',
            'label'   => __( 'Section Description', 'travelbee' ),
            'active_callback' => 'travelbee_cta_ac'
        )
    );

    $wp_customize->selective_refresh->add_partial( 'cta_content', array(
        'selector'            => '.advance-cta .section-desc',
        'render_callback'     => 'travelbee_get_cta_content',
    ) );

    $wp_customize->add_setting(
        'cta_btn_one',
        array(
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage'
        )
    );
    
    $wp_customize->add_control(
        'cta_btn_one',
        array(
            'type'    => 'text',
            'section' => 'cta',
            'label'   => __( 'Button One Label', 'travelbee' ),
            'active_callback' => 'travelbee_cta_ac'
        )
    );

    $wp_customize->selective_refresh->add_partial( 'cta_btn_one', array(
        'selector'            => '.advance-cta .button-wrapper .btn-cta.btn-1',
        'render_callback'     => 'travelbee_get_cta_btn_one',
    ) );

    /** Button Link */
    $wp_customize->add_setting(
        'cta_btn_one_link',
        array(
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
        )
    );
    
    $wp_customize->add_control(
        'cta_btn_one_link',
        array(
            'label'           => __( 'Button One Link', 'travelbee' ),
            'section'         => 'cta',
            'type'            => 'url',
            'active_callback' => 'travelbee_cta_ac'
        )
    );

    $wp_customize->add_setting(
        'cta_btn_two',
        array(
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage'
        )
    );
    
    $wp_customize->add_control(
        'cta_btn_two',
        array(
            'type'    => 'text',
            'section' => 'cta',
            'label'   => __( 'Button Two Label', 'travelbee' ),
            'active_callback' => 'travelbee_cta_ac'
        )
    );

    $wp_customize->selective_refresh->add_partial( 'cta_btn_two', array(
        'selector'            => '.advance-cta .button-wrapper .btn-cta.btn-2',
        'render_callback'     => 'travelbee_get_cta_btn_two',
    ) );

    $wp_customize->add_setting(
        'cta_btn_two_link',
        array(
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
        )
    );
    
    $wp_customize->add_control(
        'cta_btn_two_link',
        array(
            'label'           => __( 'Button Two Link', 'travelbee' ),
            'section'         => 'cta',
            'type'            => 'url',
            'active_callback' => 'travelbee_cta_ac'
        )
    );

    $wp_customize->add_setting( 
        'cta_bg_color', 
        array(
            'default'           => '#faf6f4', 
            'sanitize_callback' => 'sanitize_hex_color',                       
        )
    );

    $wp_customize->add_control( 
        new WP_Customize_Color_Control( 
            $wp_customize, 
            'cta_bg_color', 
            array(
                'label'             => 'CTA Background Color',
                'section'           => 'cta',
                'active_callback' => 'travelbee_cta_ac'
            )
        )
    );

    $wp_customize->add_setting( 
        'cta_image', 
        array(
            'default'           => '',
            'sanitize_callback' => 'travelbee_sanitize_image'
        ) 
    );

    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'cta_image',
            array(
                'section'     => 'cta',
                'label'       => __( 'Upload an image for CTA section', 'travelbee' ),
                'description' => esc_html__( 'Choose Image of your choice. Recommended size for this image is 422px by 562px.', 'travelbee' ),
                'active_callback' => 'travelbee_cta_ac'
            )
        )
    );

    $wp_customize->add_setting( 
        'cta_image_align', 
        array(
            'default'           => 'left-align',
            'sanitize_callback' => 'travelbee_sanitize_radio'
        ) 
    );
    
    $wp_customize->add_control(
        new Travelbee_Radio_Buttonset_Control(
            $wp_customize,
            'cta_image_align',
            array(
                'section'	  => 'cta',
                'label'       => __( 'Image Alignment', 'travelbee' ),
                'choices'	  => array(
                    'left-align'  => __( 'Left Align', 'travelbee' ),
                    'right-align' => __( 'Right Align', 'travelbee' ),
                ),
                'active_callback' => 'travelbee_cta_ac'
            )
        )
    );
    
    /** Cta Section Ends */  


}
add_action( 'customize_register', 'travelbee_customize_frontpage' );
