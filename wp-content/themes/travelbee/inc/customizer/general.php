<?php
/**
 * General Settings
 *
 * @package Travelbee
 */

function travelbee_customize_register_general( $wp_customize ){
    
    /** General Settings */
    $wp_customize->add_panel( 
        'general_settings',
         array(
            'priority'    => 60,
            'capability'  => 'edit_theme_options',
            'title'       => __( 'General Settings', 'travelbee' ),
            'description' => __( 'Customize Header, Social,  SEO, Post/Page, Newsletter & Instagram and Miscellaneous settings.', 'travelbee' ),
        ) 
    );

    /** Header Settings */
    $wp_customize->add_section(
        'header_settings',
        array(
            'title'    => __( 'Header Settings', 'travelbee' ),
            'priority' => 8,
            'panel'    => 'general_settings',
        )
    );

    /** Header Search */
    $wp_customize->add_setting(
        'ed_header_search',
        array(
            'default'           => false,
            'sanitize_callback' => 'travelbee_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
		new Travelbee_Toggle_Control( 
			$wp_customize,
			'ed_header_search',
			array(
				'section'		=> 'header_settings',
				'label'			=> __( 'Header Search', 'travelbee' ),
				'description'	=> __( 'Enable to display search form in header.', 'travelbee' ),
			)
		)
	);
    
    /** Sticky Header */
    $wp_customize->add_setting(
        'ed_sticky_header',
        array(
            'default'           => false,
            'sanitize_callback' => 'travelbee_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
		new Travelbee_Toggle_Control( 
			$wp_customize,
			'ed_sticky_header',
			array(
				'section'		=> 'header_settings',
				'label'			=> __( 'Sticky Header', 'travelbee' ),
				'description'	=> __( 'Enable to stick header at top.', 'travelbee' ),
			)
		)
	);

    if ( travelbee_is_woocommerce_activated() ) {
        /** Shop Cart*/
        $wp_customize->add_setting( 
            'ed_shopping_cart', 
            array(
                'default'           => false,
                'sanitize_callback' => 'travelbee_sanitize_checkbox'
            ) 
        );
        
        $wp_customize->add_control(
    		new Travelbee_Toggle_Control( 
    			$wp_customize,
    			'ed_shopping_cart',
    			array(
    				'section'     => 'header_settings',
    				'label'	      => __( 'Shopping Cart', 'travelbee' ),
                    'description' => __( 'Enable to show Shopping cart in the header.', 'travelbee' ),
    			)
    		)
    	);
    }
    /** Header Settings Ends */

    /** Instagram Settings */
    $wp_customize->add_section(
        'instagram_settings',
        array(
            'title'    => __( 'Instagram Settings', 'travelbee' ),
            'priority' => 70,
            'panel'    => 'general_settings',
        )
    );
    
    /** Enable Instagram Section */
    $wp_customize->add_setting( 
        'ed_instagram', 
        array(
            'default'           => false,
            'sanitize_callback' => 'travelbee_sanitize_checkbox'
        ) 
    );
    
    $wp_customize->add_control(
        new Travelbee_Toggle_Control( 
            $wp_customize,
            'ed_instagram',
            array(
                'section'     => 'instagram_settings',
                'label'	      => __( 'Instagram Section', 'travelbee' ),
                'description' => __( 'Enable to show Instagram Section', 'travelbee' ),
            )
        )
    );
    
    $wp_customize->add_setting( 
        'instagram_shortcode', 
        array(
            'default'           => '[instagram-feed]',
            'sanitize_callback' => 'sanitize_text_field'
        )
    );

    $wp_customize->add_control(
        'instagram_shortcode',
        array(
            'section'         => 'instagram_settings',
            'label'           => __( 'Shortcode', 'travelbee' ),
            'type'            => 'text',
            'description'     => __( 'Add shortcode for your instagram profile below:', 'travelbee' ),
            'active_callback' => 'travelbee_instagram_ac',
        )
    ); 

    /** Instagram Settings End */

    /** Miscellaneous Settings */
    $wp_customize->add_section(
        'misc_settings',
        array(
            'title'    => __( 'Misc Settings', 'travelbee' ),
            'priority' => 85,
            'panel'    => 'general_settings',
        )
    );
    
    /** Page Header Background Image */
    $wp_customize->add_setting( 
        'page_header_image', 
        array(
            'default'           => '',
            'sanitize_callback' => 'travelbee_sanitize_image'
        ) 
    );

    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'page_header_image',
            array(
                'section'     => 'misc_settings',
                'label'       => __( 'Header Background Image', 'travelbee' ),
                'description' => __( 'Upload image for category page header background image.', 'travelbee' ),
            )
        )
    );
    
    /** Search Page Title  */
    $wp_customize->add_setting(
        'search_title',
        array(
            'default'           => __( 'Search Result For', 'travelbee' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage'
        )
    );
    
    $wp_customize->add_control(
        'search_title',
        array(
            'label'       => __( 'Search Page Title', 'travelbee' ),
            'description' => __( 'You can change title of your search page from here.', 'travelbee' ),
            'section'     => 'misc_settings',
            'type'        => 'text',                                 
        )
    );

    $wp_customize->selective_refresh->add_partial( 'search_title', array(
        'selector'        => '.search-wrapper span',
        'render_callback' => 'travelbee_get_search_title',
    ) );

    /** 404 Page Image Settings */
    $wp_customize->add_setting( 
        '404_page_image', 
        array(
            'default'           => get_template_directory_uri() . '/images/error.png',
            'sanitize_callback' => 'travelbee_sanitize_image'
        ) 
    );

    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            '404_page_image',
            array(
                'section'     => 'misc_settings',
                'label'       => __( '404 Page Image', 'travelbee' ),
                'description' => __( 'Upload image for 404 page.', 'travelbee' ),
            )
        )
    ); 

    /** Portfolio Related Projects Title  */
    $wp_customize->add_setting(
        'related_portfolio_title',
        array(
            'default'           => __( 'Related Projects', 'travelbee' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage'
        )
    );
    
    $wp_customize->add_control(
        'related_portfolio_title',
        array(
            'label'       => __( 'Portfolio Related Projects Title', 'travelbee' ),
            'description' => __( 'You can change title of your portfolio related projects from here.', 'travelbee' ),
            'section'     => 'misc_settings',
            'type'        => 'text',                                 
        )
    );

    $wp_customize->selective_refresh->add_partial( 'related_portfolio_title', array(
        'selector'        => '.related-portfolio .related-portfolio-title',
        'render_callback' => 'travelbee_get_related_portfolio_title',
    ) );
    /** Miscellaneous Settings End */

    /** Newsletter Settings */
    $wp_customize->add_section(
        'newsletter_settings',
        array(
            'title'    => __( 'Newsletter Settings', 'travelbee' ),
            'priority' => 60,
            'panel'    => 'general_settings',
        )
    );
    
    if( travelbee_is_btnw_activated() ){
		
        /** Enable Newsletter Section */
        $wp_customize->add_setting( 
            'ed_newsletter', 
            array(
                'default'           => false,
                'sanitize_callback' => 'travelbee_sanitize_checkbox'
            ) 
        );
        
        $wp_customize->add_control(
    		new Travelbee_Toggle_Control( 
    			$wp_customize,
    			'ed_newsletter',
    			array(
    				'section'     => 'newsletter_settings',
    				'label'	      => __( 'Newsletter Section', 'travelbee' ),
                    'description' => __( 'Enable to show Newsletter Section', 'travelbee' ),
    			)
    		)
    	);
    
        /** Newsletter Shortcode */
        $wp_customize->add_setting(
            'newsletter_shortcode',
            array(
                'default'           => '',
                'sanitize_callback' => 'wp_kses_post',
            )
        );
        
        $wp_customize->add_control(
            'newsletter_shortcode',
            array(
                'type'        => 'text',
                'section'     => 'newsletter_settings',
                'label'       => __( 'Newsletter Shortcode', 'travelbee' ),
                'description' => __( 'Enter the BlossomThemes Email Newsletters Shortcode. Ex. [BTEN id="356"]', 'travelbee' ),
            )
        );
        
        $wp_customize->add_setting( 
            'newsletter_bg_color', 
            array(
                'default'           => '#faf6f4', 
                'sanitize_callback' => 'sanitize_hex_color',                       
            )
        );
     
     
        // Add Controls
        $wp_customize->add_control( 
            new WP_Customize_Color_Control( 
                $wp_customize, 
                'newsletter_bg_color', 
                array(
                    'label'             => 'Newsletter Background Color',
                    'section'           => 'newsletter_settings',
                )
            )
        );

        $wp_customize->add_setting( 
            'newsletter_bg_image', 
            array(
                'default' 			=> '',
                'sanitize_callback' => 'travelbee_sanitize_image'
            )
        );
     
        $wp_customize->add_control( 
            new WP_Customize_Image_Control( 
                $wp_customize, 
                'newsletter_bg_image', 
                array(
                    'label'             => __( 'Upload an image', 'travelbee' ),
                    'section'           => 'newsletter_settings',
                    'description'       => __( 'Background image for homepage newsletter section. The recommended image size is 200px by 235px in PNG format.', 'travelbee' )
                )
            )
        );

        $wp_customize->add_setting( 
            'newsletter_image', 
            array(
                'default'           => '',
                'sanitize_callback' => 'travelbee_sanitize_image'
            )
        );
     
        $wp_customize->add_control( 
            new WP_Customize_Image_Control( 
                $wp_customize, 
                'newsletter_image', 
                array(
                    'label'             => __( 'Upload an image', 'travelbee' ),
                    'section'           => 'newsletter_settings',
                    'description'       => __( 'Primary image for homepage newsletter section. The recommended image size is 475px by 475px in JPG format.', 'travelbee' )
                )
            )
        );

	} else {
		$wp_customize->add_setting(
			'newsletter_recommend',
			array(
				'sanitize_callback' => 'wp_kses_post',
			)
		);

		$wp_customize->add_control(
			new Travelbee_Plugin_Recommend_Control(
				$wp_customize,
				'newsletter_recommend',
				array(
					'section'     => 'newsletter_settings',
					'label'       => __( 'Newsletter Shortcode', 'travelbee' ),
					'capability'  => 'install_plugins',
					'plugin_slug' => 'blossomthemes-email-newsletter',//This is the slug of recommended plugin.
					'description' => sprintf( __( 'Please install and activate the recommended plugin %1$sBlossomThemes Email Newsletter%2$s. After that option related with this section will be visible.', 'travelbee' ), '<strong>', '</strong>' ),
				)
			)
		);
	}    
    /** Newsletter Settings Ends*/

    /** Posts(Blog) & Pages Settings */
    $wp_customize->add_section(
        'post_page_settings',
        array(
            'title'    => __( 'Posts(Blog) & Pages Settings', 'travelbee' ),
            'priority' => 50,
            'panel'    => 'general_settings',
        )
    );
    
    /** Prefix Archive Page */
    $wp_customize->add_setting( 
        'ed_prefix_archive', 
        array(
            'default'           => true,
            'sanitize_callback' => 'travelbee_sanitize_checkbox'
        ) 
    );
    
    $wp_customize->add_control(
		new Travelbee_Toggle_Control( 
			$wp_customize,
			'ed_prefix_archive',
			array(
				'section'     => 'post_page_settings',
				'label'	      => __( 'Hide Prefix in Archive Page', 'travelbee' ),
                'description' => __( 'Enable to hide prefix in archive page.', 'travelbee' ),
			)
		)
    );
    
    /** Blog Post Image Crop */
    $wp_customize->add_setting( 
        'ed_crop_blog', 
        array(
            'default'           => false,
            'sanitize_callback' => 'travelbee_sanitize_checkbox'
        ) 
    );
    
    $wp_customize->add_control(
        new Travelbee_Toggle_Control( 
            $wp_customize,
            'ed_crop_blog',
            array(
                'section'     => 'post_page_settings',
                'label'       => __( 'Blog Post Image Crop', 'travelbee' ),
                'description' => __( 'Enable to avoid automatic cropping of featured image in home, archive and search posts.', 'travelbee' ),
            )
        )
    );
        
    /** Blog Excerpt */
    $wp_customize->add_setting( 
        'ed_excerpt', 
        array(
            'default'           => true,
            'sanitize_callback' => 'travelbee_sanitize_checkbox'
        ) 
    );
    
    $wp_customize->add_control(
		new Travelbee_Toggle_Control( 
			$wp_customize,
			'ed_excerpt',
			array(
				'section'     => 'post_page_settings',
				'label'	      => __( 'Enable Blog Excerpt', 'travelbee' ),
                'description' => __( 'Enable to show excerpt or disable to show full post content.', 'travelbee' ),
			)
		)
	);
    
    /** Excerpt Length */
    $wp_customize->add_setting( 
        'excerpt_length', 
        array(
            'default'           => 25,
            'sanitize_callback' => 'travelbee_sanitize_number_absint'
        ) 
    );
    
    $wp_customize->add_control(
		new Travelbee_Slider_Control( 
			$wp_customize,
			'excerpt_length',
			array(
				'section'	  => 'post_page_settings',
				'label'		  => __( 'Excerpt Length', 'travelbee' ),
				'description' => __( 'Automatically generated excerpt length (in words).', 'travelbee' ),
                'choices'	  => array(
					'min' 	=> 10,
					'max' 	=> 100,
					'step'	=> 5,
				)                 
			)
		)
	);

    // blog Title
    $wp_customize->add_setting(
        'blog_text',
        array(
            'default'           => __( 'Latest Articles', 'travelbee' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage' 
        )
    );
    
    $wp_customize->add_control(
        'blog_text',
        array(
            'label'   => __( 'Blog Section Title', 'travelbee' ),
            'section' => 'post_page_settings',
            'type'    => 'text',
        )
    );

    $wp_customize->selective_refresh->add_partial( 'blog_text', array(
        'selector' => '.section-header .blog-title',
        'render_callback' => 'travelbee_get_blog_text',
    ) );

    
    /** Read More Text */
    $wp_customize->add_setting(
        'read_more_text',
        array(
            'default'           => __( 'Read More', 'travelbee' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage' 
        )
    );
    
    $wp_customize->add_control(
        'read_more_text',
        array(
            'type'    => 'text',
            'section' => 'post_page_settings',
            'label'   => __( 'Read More Text', 'travelbee' ),
        )
    );
    
    $wp_customize->selective_refresh->add_partial( 'read_more_text', array(
        'selector' => '.entry-footer .btn-readmore',
        'render_callback' => 'travelbee_get_read_more',
    ) );
    
    /** Note */
    $wp_customize->add_setting(
        'post_note_text',
        array(
            'default'           => '',
            'sanitize_callback' => 'wp_kses_post' 
        )
    );
    
    $wp_customize->add_control(
        new Travelbee_Note_Control( 
			$wp_customize,
			'post_note_text',
			array(
				'section'	  => 'post_page_settings',
                'description' => sprintf( __( '%s These options affect your individual posts.', 'travelbee' ), '<hr/>' ),
			)
		)
    );

    /** Single Post Image Crop */
    $wp_customize->add_setting( 
        'ed_crop_single', 
        array(
            'default'           => false,
            'sanitize_callback' => 'travelbee_sanitize_checkbox'
        ) 
    );
    
    $wp_customize->add_control(
        new Travelbee_Toggle_Control( 
            $wp_customize,
            'ed_crop_single',
            array(
                'section'     => 'post_page_settings',
                'label'       => __( 'Single Post Image Crop', 'travelbee' ),
                'description' => __( 'Enable to avoid automatic cropping of featured image in single post.', 'travelbee' ),
            )
        )
    );

    /** Hide Author Section */
    $wp_customize->add_setting( 
        'ed_author', 
        array(
            'default'           => false,
            'sanitize_callback' => 'travelbee_sanitize_checkbox'
        ) 
    );
    
    $wp_customize->add_control(
		new Travelbee_Toggle_Control( 
			$wp_customize,
			'ed_author',
			array(
				'section'     => 'post_page_settings',
				'label'	      => __( 'Hide Author Section', 'travelbee' ),
                'description' => __( 'Enable to hide author section.', 'travelbee' ),
			)
		)
	);
    
    /** Author Section title */
    $wp_customize->add_setting(
        'author_title',
        array(
            'default'           => __( 'About Author', 'travelbee' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage' 
        )
    );
    
    $wp_customize->add_control(
        'author_title',
        array(
            'type'    => 'text',
            'section' => 'post_page_settings',
            'label'   => __( 'Author Section Title', 'travelbee' ),
        )
    );
    
    $wp_customize->selective_refresh->add_partial( 'author_title', array(
        'selector' => '.author-section .title',
        'render_callback' => 'travelbee_get_author_title',
    ) );
    
    /** Show Related Posts */
    $wp_customize->add_setting( 
        'ed_related', 
        array(
            'default'           => true,
            'sanitize_callback' => 'travelbee_sanitize_checkbox'
        ) 
    );
    
    $wp_customize->add_control(
		new Travelbee_Toggle_Control( 
			$wp_customize,
			'ed_related',
			array(
				'section'     => 'post_page_settings',
				'label'	      => __( 'Show Related Posts', 'travelbee' ),
                'description' => __( 'Enable to show related posts in single page.', 'travelbee' ),
			)
		)
	);
    
    /** Related Posts section title */
    $wp_customize->add_setting(
        'related_post_title',
        array(
            'default'           => __( 'You may also like...', 'travelbee' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage' 
        )
    );
    
    $wp_customize->add_control(
        'related_post_title',
        array(
            'type'            => 'text',
            'section'         => 'post_page_settings',
            'label'           => __( 'Related Posts Section Title', 'travelbee' ),
            'active_callback' => 'travelbee_post_page_ac'
        )
    );
    
    $wp_customize->selective_refresh->add_partial( 'related_post_title', array(
        'selector' => '.related-posts .title',
        'render_callback' => 'travelbee_get_related_title',
    ) );
    
    
    /** Comments */
    $wp_customize->add_setting(
        'ed_comments',
        array(
            'default'           => true,
            'sanitize_callback' => 'travelbee_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
		new Travelbee_Toggle_Control( 
			$wp_customize,
			'ed_comments',
			array(
				'section'     => 'post_page_settings',
				'label'       => __( 'Show Comments', 'travelbee' ),
                'description' => __( 'Enable to show Comments in Single Post/Page.', 'travelbee' ),
			)
		)
    );
    
    /** Comments Below Post Content */
    $wp_customize->add_setting(
        'toggle_comments',
        array(
            'default'           => false,
            'sanitize_callback' => 'travelbee_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
		new Travelbee_Toggle_Control( 
			$wp_customize,
			'toggle_comments',
			array(
				'section'         => 'post_page_settings',
				'label'           => __( 'Comments Below Post Content', 'travelbee' ),
				'description'     => __( 'Enable to show comment section right after post content. Refresh site for changes.', 'travelbee' ),
				'active_callback' => 'travelbee_post_page_ac'
			)
		)
	);

    /** Hide Category */
    $wp_customize->add_setting( 
        'ed_category', 
        array(
            'default'           => false,
            'sanitize_callback' => 'travelbee_sanitize_checkbox'
        ) 
    );
    
    $wp_customize->add_control(
		new Travelbee_Toggle_Control( 
			$wp_customize,
			'ed_category',
			array(
				'section'     => 'post_page_settings',
				'label'	      => __( 'Hide Category', 'travelbee' ),
                'description' => __( 'Enable to hide category.', 'travelbee' ),
			)
		)
	);
    
    /** Hide Post Author */
    $wp_customize->add_setting( 
        'ed_post_author', 
        array(
            'default'           => false,
            'sanitize_callback' => 'travelbee_sanitize_checkbox'
        ) 
    );
    
    $wp_customize->add_control(
		new Travelbee_Toggle_Control( 
			$wp_customize,
			'ed_post_author',
			array(
				'section'     => 'post_page_settings',
				'label'	      => __( 'Hide Post Author', 'travelbee' ),
                'description' => __( 'Enable to hide post author.', 'travelbee' ),
			)
		)
	);
    
    /** Hide Posted Date */
    $wp_customize->add_setting( 
        'ed_post_date', 
        array(
            'default'           => false,
            'sanitize_callback' => 'travelbee_sanitize_checkbox'
        ) 
    );
    
    $wp_customize->add_control(
		new Travelbee_Toggle_Control( 
			$wp_customize,
			'ed_post_date',
			array(
				'section'     => 'post_page_settings',
				'label'	      => __( 'Hide Posted Date', 'travelbee' ),
                'description' => __( 'Enable to hide posted date.', 'travelbee' ),
			)
		)
	);
    
    /** Show Featured Image */
    $wp_customize->add_setting( 
        'ed_featured_image', 
        array(
            'default'           => true,
            'sanitize_callback' => 'travelbee_sanitize_checkbox'
        ) 
    );
    
    $wp_customize->add_control(
		new Travelbee_Toggle_Control( 
			$wp_customize,
			'ed_featured_image',
			array(
				'section'         => 'post_page_settings',
				'label'	          => __( 'Show Featured Image', 'travelbee' ),
                'description'     => __( 'Enable to show featured image in post detail (single post).', 'travelbee' ),
			)
		)
	);

    /** Posts(Blog) & Pages Settings Ends */


    /** SEO Settings */
    $wp_customize->add_section(
        'seo_settings',
        array(
            'title'    => __( 'SEO Settings', 'travelbee' ),
            'priority' => 40,
            'panel'    => 'general_settings',
        )
    );
    
    /** Enable Social Links */
    $wp_customize->add_setting( 
        'ed_post_update_date', 
        array(
            'default'           => false,
            'sanitize_callback' => 'travelbee_sanitize_checkbox'
        ) 
    );
    
    $wp_customize->add_control(
		new Travelbee_Toggle_Control( 
			$wp_customize,
			'ed_post_update_date',
			array(
				'section'     => 'seo_settings',
				'label'	      => __( 'Enable Last Update Post Date', 'travelbee' ),
                'description' => __( 'Enable to show last updated post date on listing as well as in single post.', 'travelbee' ),
			)
		)
	);
    
    /** Enable Social Links */
    $wp_customize->add_setting( 
        'ed_breadcrumb', 
        array(
            'default'           => true,
            'sanitize_callback' => 'travelbee_sanitize_checkbox'
        ) 
    );
    
    $wp_customize->add_control(
		new Travelbee_Toggle_Control( 
			$wp_customize,
			'ed_breadcrumb',
			array(
				'section'     => 'seo_settings',
				'label'	      => __( 'Enable Breadcrumb', 'travelbee' ),
                'description' => __( 'Enable to show breadcrumb in inner pages.', 'travelbee' ),
			)
		)
	);
    
    /** Breadcrumb Home Text */
    $wp_customize->add_setting(
        'home_text',
        array(
            'default'           => __( 'Home', 'travelbee' ),
            'sanitize_callback' => 'sanitize_text_field' 
        )
    );
    
    $wp_customize->add_control(
        'home_text',
        array(
            'type'    => 'text',
            'section' => 'seo_settings',
            'label'   => __( 'Breadcrumb Home Text', 'travelbee' ),
        )
    );  
    /** SEO Settings Ends */

    /** Social Media Settings */
    $wp_customize->add_section(
        'social_media_settings',
        array(
            'title'    => __( 'Social Media Settings', 'travelbee' ),
            'priority' => 30,
            'panel'    => 'general_settings',
        )
    );
    
    /** Enable Social Links */
    $wp_customize->add_setting( 
        'ed_social_links', 
        array(
            'default'           => false,
            'sanitize_callback' => 'travelbee_sanitize_checkbox'
        ) 
    );
    
    $wp_customize->add_control(
		new Travelbee_Toggle_Control( 
			$wp_customize,
			'ed_social_links',
			array(
				'section'     => 'social_media_settings',
				'label'	      => __( 'Enable Social Links', 'travelbee' ),
                'description' => __( 'Enable to show social links at header.', 'travelbee' ),
			)
		)
	);
    
    $wp_customize->add_setting( 
        new Travelbee_Repeater_Setting( 
            $wp_customize, 
            'social_links', 
            array(
                'default' => '',
                'sanitize_callback' => array( 'Travelbee_Repeater_Setting', 'sanitize_repeater_setting' ),
            ) 
        ) 
    );
    
    $wp_customize->add_control(
		new Travelbee_Control_Repeater(
			$wp_customize,
			'social_links',
			array(
				'section' => 'social_media_settings',				
				'label'	  => __( 'Social Links', 'travelbee' ),
				'fields'  => array(
                    'font' => array(
                        'type'        => 'font',
                        'label'       => __( 'Font Awesome Icon', 'travelbee' ),
                        'description' => __( 'Example: fab fa-facebook-f', 'travelbee' ),
                    ),
                    'link' => array(
                        'type'        => 'url',
                        'label'       => __( 'Link', 'travelbee' ),
                        'description' => __( 'Example: https://facebook.com', 'travelbee' ),
                    )
                ),
                'row_label' => array(
                    'type' => 'field',
                    'value' => __( 'links', 'travelbee' ),
                    'field' => 'link'
                )                        
			)
		)
	);
    /** Social Media Settings Ends */
    
}
add_action( 'customize_register', 'travelbee_customize_register_general' );