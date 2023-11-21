<?php
//Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * After setup theme hook
 */
function travel_trail_theme_setup(){
    /*
     * Make chile theme available for translation.
     * Translations can be filed in the /languages/ directory.
     */
    load_child_theme_textdomain( 'travel-trail', get_stylesheet_directory() . '/languages' );
    add_image_size( 'travel-trail-slider', 600, 600, true);
}
add_action( 'after_setup_theme', 'travel_trail_theme_setup', 100 );

function travel_trail_customize_script() {

    $my_theme = wp_get_theme();
    $version = $my_theme[ 'version' ];
    wp_enqueue_script('travel-trail-customize', get_stylesheet_directory_uri() . '/js/child-customize.js', array('jquery', 'customize-controls'), $version, true);
}
add_action( 'customize_controls_enqueue_scripts', 'travel_trail_customize_script' );

function travel_trail_enqueue_style() {

    $my_theme = wp_get_theme();
    $version = $my_theme['Version'];
   
    wp_enqueue_style( 'travelbee', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'travel-trail', get_stylesheet_directory_uri() . '/style.css', array( 'travelbee' ), $version );

    wp_enqueue_script( 'travel-trail', get_stylesheet_directory_uri() . '/js/custom.js', array('jquery' ), $version, true );

    $array = array( 
        'rtl'           => is_rtl(),
        'auto'          => (bool) get_theme_mod( 'slider_auto', false ),
        'loop'          => (bool) get_theme_mod( 'slider_loop', false ),
    );

    wp_localize_script( 'travel-trail', 'travel_trail_data', $array );

}
add_action( 'wp_enqueue_scripts', 'travel_trail_enqueue_style', 10 );

//Remove a function from the parent theme
function travel_trail_remove_parent_filters(){ //Have to do it after theme setup, because child theme functions are loaded first
    remove_action( 'customize_register', 'travelbee_customizer_theme_info' );
    remove_action( 'customize_register', 'travelbee_customize_register_color' );
    remove_action( 'customize_register', 'travelbee_customize_register_appearance' );
}
add_action( 'init', 'travel_trail_remove_parent_filters' );

function travel_trail_customizer_register( $wp_customize ) {
    $wp_customize->add_section( 'theme_info', array(
        'title'       => __( 'Demo & Documentation' , 'travel-trail' ),
        'priority'    => 6,
    ) );
    
    /** Important Links */
    $wp_customize->add_setting( 'theme_info_theme',
        array(
            'default' => '',
            'sanitize_callback' => 'wp_kses_post',
        )
    );
    
    $theme_info = '<p>';
    $theme_info .= sprintf( __( 'Demo Link: %1$sClick here.%2$s', 'travel-trail' ),  '<a href="' . esc_url( 'https://rarathemes.com/previews/?theme=travel-trail' ) . '" target="_blank">', '</a>' );
    $theme_info .= '</p><p>';
    $theme_info .= sprintf( __( 'Documentation Link: %1$sClick here.%2$s', 'travel-trail' ),  '<a href="' . esc_url( 'https://docs.rarathemes.com/docs/travel-trail/' ) . '" target="_blank">', '</a>' );
    $theme_info .= '</p>';

    $wp_customize->add_control( new Travelbee_Note_Control( $wp_customize,
        'theme_info_theme', 
            array(
                'section'     => 'theme_info',
                'description' => $theme_info
            )
        )
    );

    /** Primary Color*/
    $wp_customize->add_setting( 
        'primary_color', array(
            'default'           => '#c57e83',
            'sanitize_callback' => 'sanitize_hex_color'
        ) 
    );

    $wp_customize->add_control( 
        new WP_Customize_Color_Control( 
            $wp_customize, 
            'primary_color', 
            array(
                'label'       => __( 'Primary Color', 'travel-trail' ),
                'description' => __( 'Primary color of the theme.', 'travel-trail' ),
                'section'     => 'colors',
                'priority'    => 5,                
            )
        )
    );

     /** Secondary Color*/
     $wp_customize->add_setting( 
        'body_font_color', 
        array(
            'default'           => '#171717',
            'sanitize_callback' => 'sanitize_hex_color',
        ) 
    );

    $wp_customize->add_control( 
        new WP_Customize_Color_Control( 
            $wp_customize, 
            'body_font_color', 
            array(
                'label'       => __( 'Font Color', 'travel-trail' ),
                'description' => __( 'Body font color of the theme.', 'travel-trail' ),
                'section'     => 'colors',
                'priority'    => 7,
            )
        )
    );

    /** Appearance Settings */
    $wp_customize->add_panel( 
        'appearance_settings',
         array(
            'priority'    => 50,
            'capability'  => 'edit_theme_options',
            'title'       => __( 'Appearance Settings', 'travel-trail' ),
            'description' => __( 'Customize Typography & Background Image', 'travel-trail' ),
        ) 
    );

    /** Typography */
    $wp_customize->add_section(
        'typography_settings',
        array(
            'title'    => __( 'Typography', 'travel-trail' ),
            'priority' => 40,
            'panel'    => 'appearance_settings',
        )
    );
    
    /** Primary Font */
    $wp_customize->add_setting(
        'primary_font',
        array(
            'default'           => 'Open Sans',
            'sanitize_callback' => 'travelbee_sanitize_select'
        )
    );

    $wp_customize->add_control(
        new Travelbee_Select_Control(
            $wp_customize,
            'primary_font',
            array(
                'label'       => __( 'Primary Font', 'travel-trail' ),
                'description' => __( 'Primary font of the site.', 'travel-trail' ),
                'section'     => 'typography_settings',
                'choices'     => travelbee_get_all_fonts(),   
            )
        )
    );

    /** Secondary Font */
    $wp_customize->add_setting(
        'secondary_font',
        array(
            'default'           => 'Lora',
            'sanitize_callback' => 'travelbee_sanitize_select'
        )
    );

    $wp_customize->add_control(
        new Travelbee_Select_Control(
            $wp_customize,
            'secondary_font',
            array(
                'label'       => __( 'Secondary Font', 'travel-trail' ),
                'description' => __( 'Secondary font of the site.', 'travel-trail' ),
                'section'     => 'typography_settings',
                'choices'     => travelbee_get_all_fonts(),   
            )
        )
    );

    /** Font Size*/
    $wp_customize->add_setting( 
        'font_size', 
        array(
            'default'           => 16,
            'sanitize_callback' => 'travelbee_sanitize_number_absint'
        ) 
    );
    
    $wp_customize->add_control(
        new Travelbee_Slider_Control( 
            $wp_customize,
            'font_size',
            array(
                'section'     => 'typography_settings',
                'label'       => __( 'Font Size', 'travel-trail' ),
                'description' => __( 'Change the font size of your site.', 'travel-trail' ),
                'choices'     => array(
                    'min'   => 10,
                    'max'   => 50,
                    'step'  => 1,
                )                 
            )
        )
    );

    $wp_customize->add_setting(
        'ed_localgoogle_fonts',
        array(
            'default'           => false,
            'sanitize_callback' => 'travelbee_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
        new Travelbee_Toggle_Control( 
            $wp_customize,
            'ed_localgoogle_fonts',
            array(
                'section'       => 'typography_settings',
                'label'         => __( 'Load Google Fonts Locally', 'travel-trail' ),
                'description'   => __( 'Enable to load google fonts from your own server instead from google\'s CDN. This solves privacy concerns with Google\'s CDN and their sometimes less-than-transparent policies.', 'travel-trail' )
            )
        )
    );   

    $wp_customize->add_setting(
        'ed_preload_local_fonts',
        array(
            'default'           => false,
            'sanitize_callback' => 'travelbee_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
        new Travelbee_Toggle_Control( 
            $wp_customize,
            'ed_preload_local_fonts',
            array(
                'section'       => 'typography_settings',
                'label'         => __( 'Preload Local Fonts', 'travel-trail' ),
                'description'   => __( 'Preloading Google fonts will speed up your website speed.', 'travel-trail' ),
                'active_callback' => 'travelbee_ed_localgoogle_fonts'
            )
        )
    );   

    ob_start(); ?>
        
        <span style="margin-bottom: 5px;display: block;"><?php esc_html_e( 'Click the button to reset the local fonts cache', 'travel-trail' ); ?></span>
        
        <input type="button" class="button button-primary travelbee-flush-local-fonts-button" name="travelbee-flush-local-fonts-button" value="<?php esc_attr_e( 'Flush Local Font Files', 'travel-trail' ); ?>" />
    <?php
    $travel_trail_flush_button = ob_get_clean();

    $wp_customize->add_setting(
        'ed_flush_local_fonts',
        array(
            'sanitize_callback' => 'wp_kses_post',
        )
    );
    
    $wp_customize->add_control(
        'ed_flush_local_fonts',
        array(
            'label'         => __( 'Flush Local Fonts Cache', 'travel-trail' ),
            'section'       => 'typography_settings',
            'description'   => $travel_trail_flush_button,
            'type'          => 'hidden',
            'active_callback' => 'travelbee_ed_localgoogle_fonts'
        )
    );

    /** Home Page Layout Settings */
    $wp_customize->add_panel(
        'layout_settings',
        array(
            'title'       => __( 'Layout Settings', 'travel-trail' ),
            'capability'  => 'edit_theme_options',
            'priority'    => 55,
        )
    );

    /**Header Layout */
    $wp_customize->add_section(
        'header_layout',
        array(
            'title'    => __( 'Header Layout', 'travel-trail' ),
            'panel'    => 'layout_settings',
            'priority' => 10,
        )
    );
        
    /**Header layout */
    $wp_customize->add_setting( 
        'header_layout_option', 
        array(
            'default'           => 'three',
            'sanitize_callback' => 'travelbee_sanitize_radio'
        ) 
    );
    
    $wp_customize->add_control(
        new Travelbee_Radio_Image_Control(
            $wp_customize,
            'header_layout_option',
            array(
                'section'     => 'header_layout',
                'label'       => __( 'Header Layout', 'travel-trail' ),
                'description' => __( 'it is the layout for header.', 'travel-trail' ),
                'choices'     => array(                 
                    'one'   => get_stylesheet_directory_uri() . '/images/header/one.png',
                    'three'   => get_stylesheet_directory_uri() . '/images/header/three.png',
                )
            )
        )
    );
    
    /** Slider Layout Settings */
    $wp_customize->add_section(
        'slider_layout_settings',
        array(
            'title'    => __( 'Slider Layout', 'travel-trail' ),
            'priority' => 20,
            'panel'    => 'layout_settings',
        )
    );

    $wp_customize->add_setting( 
        'slider_layout', 
        array(
            'default'           => 'three',
            'sanitize_callback' => 'travelbee_sanitize_radio'
        ) 
    );
    
    $wp_customize->add_control(
        new Travelbee_Radio_Image_Control(
            $wp_customize,
            'slider_layout',
            array(
                'section'     => 'slider_layout_settings',
                'label'       => __( 'Slider Layout', 'travel-trail' ),
                'description' => __( 'Choose the layout of the slider for your site.', 'travel-trail' ),
                'choices'     => array(
                    'one'   => get_stylesheet_directory_uri() . '/images/slider/one.png',
                    'three'   => get_stylesheet_directory_uri() . '/images/slider/three.png',
                )
            )
        )
    );

    $wp_customize->add_setting(
        'slider_banner_text',
        array(
            'default'           => '',
            'sanitize_callback' => 'wp_kses_post' 
        )
    );
    
    $wp_customize->add_control(
        new Travelbee_Note_Control( 
            $wp_customize,
            'slider_banner_text',
            array(
                'section'     => 'header_image',
                'description' => sprintf( __( '%1$sClick here%2$s to select the layout of slider banner.', 'travel-trail' ), '<span class="text-inner-link slider_banner_text">', '</span>' ),
            )
        )
    );

    $wp_customize->add_setting(
        'slider_banner_layout_text',
        array(
            'default'           => '',
            'sanitize_callback' => 'wp_kses_post' 
        )
    );
    
    $wp_customize->add_control(
        new Travelbee_Note_Control( 
            $wp_customize,
            'slider_banner_layout_text',
            array(
                'section'     => 'slider_layout_settings',
                'description' => sprintf( __( '%1$sClick here%2$s to configure slider settings.', 'travel-trail' ), '<span class="text-inner-link slider_banner_layout_text">', '</span>' ),
            )
        )
    );

    /** Home Page Layout Settings */
    $wp_customize->add_section(
        'home_layout_settings',
        array(
            'title'    => __( 'Home Page Layout', 'travel-trail' ),
            'priority' => 40,
            'panel'    => 'layout_settings',
        )
    );
    
    /** Page Sidebar layout */
    $wp_customize->add_setting( 
        'home_layout', 
        array(
            'default'           => 'seven',
            'sanitize_callback' => 'travelbee_sanitize_radio'
        ) 
    );
    
    $wp_customize->add_control(
        new Travelbee_Radio_Image_Control(
            $wp_customize,
            'home_layout',
            array(
                'section'     => 'home_layout_settings',
                'label'       => __( 'Home Page Layout', 'travel-trail' ),
                'description' => __( 'Choose the home page layout for your site.', 'travel-trail' ),
                'choices'     => array(
                    'one'        => get_stylesheet_directory_uri() . '/images/blog/one.png',
                    'seven'       => get_stylesheet_directory_uri() . '/images/blog/seven.png',
                )
            )
        )
    );
    /** Move Background Image section to appearance panel */
    $wp_customize->get_section( 'colors' )->panel                          = 'appearance_settings';
    $wp_customize->get_section( 'colors' )->priority                       = 20;
    $wp_customize->get_section( 'background_image' )->panel                = 'appearance_settings';
    $wp_customize->get_section( 'background_image' )->priority             = 30;

     /** Layout Settings */
     $wp_customize->add_section( 
        'general_layout_settings',
         array(
            'priority'    => 45,
            'capability'  => 'edit_theme_options',
            'title'       => __( 'General Sidebar layout', 'travel-trail' ),
            'panel'    => 'layout_settings',
            'description' => __( 'Change different page layout from here.', 'travel-trail' ),
        ) 
    );
    
    /** Page Sidebar layout */
    $wp_customize->add_setting( 
        'page_sidebar_layout', 
        array(
            'default'           => 'right-sidebar',
            'sanitize_callback' => 'travelbee_sanitize_radio'
        ) 
    );
    
    $wp_customize->add_control(
		new Travelbee_Radio_Image_Control(
			$wp_customize,
			'page_sidebar_layout',
			array(
				'section'	  => 'general_layout_settings',
				'label'		  => __( 'Page Sidebar Layout', 'travel-trail' ),
				'description' => __( 'This is the general sidebar layout for pages. You can override the sidebar layout for individual page in respective page.', 'travel-trail' ),
				'choices'	  => array(
					'no-sidebar'    => get_template_directory_uri() . '/images/1c.jpg',
                    'centered'      => get_template_directory_uri() . '/images/1cc.jpg',
					'left-sidebar'  => get_template_directory_uri() . '/images/2cl.jpg',
                    'right-sidebar' => get_template_directory_uri() . '/images/2cr.jpg',
				)
			)
		)
	);
    
    /** Post Sidebar layout */
    $wp_customize->add_setting( 
        'post_sidebar_layout', 
        array(
            'default'           => 'right-sidebar',
            'sanitize_callback' => 'travelbee_sanitize_radio'
        ) 
    );
    
    $wp_customize->add_control(
		new Travelbee_Radio_Image_Control(
			$wp_customize,
			'post_sidebar_layout',
			array(
				'section'	  => 'general_layout_settings',
				'label'		  => __( 'Post Sidebar Layout', 'travel-trail' ),
				'description' => __( 'This is the general sidebar layout for posts & custom post. You can override the sidebar layout for individual post in respective post.', 'travel-trail' ),
				'choices'	  => array(
					'no-sidebar'    => get_template_directory_uri() . '/images/1c.jpg',
                    'centered'      => get_template_directory_uri() . '/images/1cc.jpg',
					'left-sidebar'  => get_template_directory_uri() . '/images/2cl.jpg',
                    'right-sidebar' => get_template_directory_uri() . '/images/2cr.jpg',
				)
			)
		)
	);
    
    /** Post Sidebar layout */
    $wp_customize->add_setting( 
        'layout_style', 
        array(
            'default'           => 'right-sidebar',
            'sanitize_callback' => 'travelbee_sanitize_radio'
        ) 
    );
    
    $wp_customize->add_control(
		new Travelbee_Radio_Image_Control(
			$wp_customize,
			'layout_style',
			array(
				'section'	  => 'general_layout_settings',
				'label'		  => __( 'Default Sidebar Layout', 'travel-trail' ),
				'description' => __( 'This is the general sidebar layout for whole site.', 'travel-trail' ),
				'choices'	  => array(
					'no-sidebar'    => get_template_directory_uri() . '/images/1c.jpg',
                    'left-sidebar'  => get_template_directory_uri() . '/images/2cl.jpg',
                    'right-sidebar' => get_template_directory_uri() . '/images/2cr.jpg',
				)
			)
		)
	);

}
add_action( 'customize_register', 'travel_trail_customizer_register', 40);

function travelbee_header(){ 
    $header_layout    = get_theme_mod( 'header_layout_option', 'three' ); 
    
    if ( $header_layout == 'one' ) {?>
    <header id="masthead" class="site-header style-<?php echo esc_attr( $header_layout ); ?>" itemscope itemtype="http://schema.org/WPHeader">
        <?php travelbee_sticky_header();?>
        <div class="header-top">
            <div class="container">
                <div class="header-left">
                    <?php travelbee_social_links(); ?>
                </div>
                <div class="header-main">
                    <?php travelbee_primary_nagivation(); ?>
                </div>
                <div class="header-right">
                    <?php 
                        travelbee_header_cart(); 
                        travelbee_search();
                    ?>
                </div>
            </div>
        </div>
        <div class="header-middle">
            <div class="container">
                <?php travelbee_site_branding(); ?>
            </div>
        </div>
        <?php 
            travelbee_mobile_navigation();  
        ?>
    </header>
    <?php } else { ?>
    <header id="masthead" class="site-header style-three" itemscope itemtype="http://schema.org/WPHeader">
        <div class="header-middle">
            <div class="container">
                <?php travelbee_site_branding(); ?>
            </div>
        </div>
        <div class="header-main">
            <div class="container">
                <div class="header-left">
                    <?php travelbee_social_links(); ?>
                </div>
                <?php travelbee_primary_nagivation(); ?>
                <div class="header-right">
                    <?php 
                        travelbee_header_cart();
                        travelbee_search();
                    ?>
                </div>
            </div>
        </div>
        <?php 
            travelbee_mobile_navigation(); 
            travelbee_sticky_header();
        ?>
  </header>
    <?php }
}

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function travelbee_body_classes( $classes ) {
    $editor_options      = get_option( 'classic-editor-replace' );
    $allow_users_options = get_option( 'classic-editor-allow-users' );
    $home_layout         = get_theme_mod( 'home_layout', 'seven' );

    if( is_home() || ( is_archive() && !( travelbee_is_woocommerce_activated() && ( is_shop() || is_product_category() || is_product_tag() ) ) || is_search() ) ){
        $classes[] = 'classic-' . $home_layout;
    }
    
    // Adds a class of hfeed to non-singular pages.
    if ( ! is_singular() ) {
        $classes[] = 'hfeed';
    }
    
    // Adds a class of custom-background-color to sites with a custom background color.
    if( get_background_color() != 'ffffff' ) {
        $classes[] = 'custom-background-color';
    }

    if( is_singular( 'post' ) ) $classes[] = ' style-one';
    
    if ( !travelbee_is_classic_editor_activated() || ( travelbee_is_classic_editor_activated() && $editor_options == 'block' ) || ( travelbee_is_classic_editor_activated() && $allow_users_options == 'allow' && has_blocks() ) ) {
        $classes[] = 'travelbee-has-blocks';
    }

    $classes[] = travelbee_sidebar( true );
    
    return $classes;
}

function travelbee_get_banner( ){
    $ed_banner             = get_theme_mod( 'ed_banner_section', 'slider_banner' );
    $slider_type           = get_theme_mod( 'slider_type', 'latest_posts' );
    $slider_cat            = get_theme_mod( 'slider_cat' );
    $posts_per_page        = get_theme_mod( 'no_of_slides', 3 );
    $ed_caption            = get_theme_mod( 'slider_caption', true );
    $read_more             = get_theme_mod( 'slider_readmore', __( 'Continue Reading', 'travel-trail' ) );
    $banner_title          = get_theme_mod( 'banner_title' );
    $banner_description    = get_theme_mod( 'banner_description' );
    $button_one_label      = get_theme_mod( 'button_one_label' );
    $button_one_link       = get_theme_mod( 'button_one_link' );
    $button_two_label      = get_theme_mod( 'button_two_label' );
    $button_two_link       = get_theme_mod( 'button_two_link' );
    $banner_new_tab        = get_theme_mod( 'banner_new_tab', false );
    $banner_new_tab_two    = get_theme_mod( 'banner_new_tab_two', false );
    $banner_caption_layout = get_theme_mod( 'banner_caption_layout', 'left' );
    $target_one            = $banner_new_tab ? 'target="_blank"' : '';
    $target_two            = $banner_new_tab_two ? 'target="_blank"' : '';
    $slider_layout         = get_theme_mod( 'slider_layout', 'three' );
    
    if( $ed_banner == 'static_banner' ) {
        $class = 'static-cta style-one';
    }else{
        $class = '';
    }

    if( $slider_layout == 'three' ){
        $image_size = 'travel-trail-slider';
    }else{
        $image_size = 'travelbee-slider';
    }
    
    if( ( $ed_banner == 'static_banner' ) && has_custom_header() ){ ?>
        <div id="banner_section" class="site-banner <?php echo esc_attr( $class ); if( has_header_video() ) echo esc_attr( ' video-banner' ); ?>">
            <div class="banner-wrapper">
                <div class="item <?php echo esc_attr( $banner_caption_layout ); ?>">
                    <?php the_custom_header_markup(); 
                        echo '<div class="container">'; 
                        if( $ed_banner == 'static_banner' && ( $banner_title || $banner_description || ( $button_one_label && $button_one_link ) ) ){
                            echo '<div class="caption-wrapper"><div class="banner-caption">';
                            if( $banner_title ) echo '<h2 class="banner-title">' . esc_html( $banner_title ) . '</h2>';
                            if( $banner_description ) echo '<div class="banner-description">' . wp_kses_post( wpautop( $banner_description ) ). '</div>';
                            if ( $button_one_label || $button_two_label){
                                echo '<div class="banner-button-wrap">';
                                    if( $button_one_label && $button_one_link ) echo '<a href="' . esc_url( $button_one_link ) . '" class="wc-btn wc-btn-one" '. $target_one .'>' . esc_html( $button_one_label ) . '</a>';
                                    if( $button_two_label && $button_two_link ) echo '<a href="' . esc_url( $button_two_link ) . '" class="wc-btn wc-btn-two" '. $target_two .'>' . esc_html( $button_two_label ) . '</a>';
                                echo '</div>';
                            }
                            echo '</div></div>';
                        } 
                        echo'</div>';  
                        ?>
                </div>
            </div>
        </div>
        <?php
    }elseif( $ed_banner == 'slider_banner' ){
        if( $slider_type == 'latest_posts' || $slider_type == 'cat' ){
        
            $args = array(
                'post_status'         => 'publish',            
                'ignore_sticky_posts' => true
            );
            
            if( $slider_type === 'cat' && $slider_cat ){
                $args['post_type']      = 'post';
                $args['cat']            = $slider_cat; 
                $args['posts_per_page'] = -1;  
            }else{
                $args['post_type']      = 'post';
                $args['posts_per_page'] = $posts_per_page;
            }
                
            $qry = new WP_Query( $args );
        
            if( $qry->have_posts() ){ ?>
                <div id="banner_section" class="site-banner banner-layout-<?php echo esc_attr( $slider_layout ); ?>">
                    <div class="container">
                        <div class="banner-wrapper owl-carousel">
                            <?php while( $qry->have_posts() ){ $qry->the_post(); ?>
                                <div class="item">
                                    <?php 
                                    echo '<div class="banner-img-wrap"><a href="' . esc_url( get_permalink( ) ) . '">';
                                    if( has_post_thumbnail() ){
                                        the_post_thumbnail( $image_size , array( 'itemprop' => 'image' ) );    
                                    }else{ 
                                        travelbee_get_fallback_svg( $image_size );//fallback
                                    }
                                    echo '</a></div>';
                                    if( $ed_caption ){  ?>               
                                        <div class="banner-caption">
                                            <?php
                                                echo '<div class="entry-meta">';
                                                travelbee_category();
                                                echo '</div>';

                                                the_title( '<h2 class="banner-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );

                                            
                                                echo '<div class="entry-content">';
                                                    the_excerpt();
                                                echo '</div>';
                                                echo '<div class="post-footer">';
                                                    if( $read_more ) {
                                                        echo '<div class="button-wrap"><a href="' . esc_url( get_permalink() ) . '" class="btn-link">';
                                                            echo esc_html( $read_more );
                                                        echo '</a></div>';
                                                    }
                                                echo '</div>';
                                             ?>
                                        </div>
                                        <?php
                                    } ?>
                                </div>
                            <?php } ?>                        
                        </div>
                    </div>
                </div>
            <?php
            wp_reset_postdata();
            }
        }    
    } 
}

function travelbee_entry_content(){ 
    $ed_excerpt          = get_theme_mod( 'ed_excerpt', true );
    $home_layout         = get_theme_mod( 'home_layout', 'seven');

    if ( is_single() ) {
        echo '<div class="article-wrapper"><div class="inner-content-wrap">';
        travelbee_article_meta();
        echo '</div>';
    }

    if( is_singular() || ! $ed_excerpt || ( get_post_format() != false ) ){
        echo '<div class="entry-content" itemprop="text">';
        the_content();    
        wp_link_pages( array(
            'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'travel-trail' ),
            'after'  => '</div>',
        ) );
        echo '</div><!-- .entry-content -->';
    }elseif( $home_layout == 'seven'){
        echo '<div class="entry-content" itemprop="text">';
        the_excerpt();
        echo '</div><!-- .entry-content -->';
    }else{
        '';
    }
}

function travelbee_dynamic_css(){
    
    $primary_font    = get_theme_mod( 'primary_font', 'Open Sans' );
    $primary_fonts   = travelbee_get_fonts( $primary_font, 'regular' );
    $secondary_font  = get_theme_mod( 'secondary_font', 'Lora' );
    $secondary_fonts = travelbee_get_fonts( $secondary_font, 'regular' );
    $font_size       = get_theme_mod( 'font_size', 16 );
    $font_color      = "#171717";
    
    $site_title_font      = get_theme_mod( 'site_title_font', array( 'font-family'=>'Lora', 'variant'=>'regular' ) );
    $site_title_fonts     = travelbee_get_fonts( $site_title_font['font-family'], $site_title_font['variant'] );
    $site_title_font_size = get_theme_mod( 'site_title_font_size', 30 );
    
    $primary_color    = get_theme_mod( 'primary_color', '#c57e83' );
    $body_font_color  = get_theme_mod( 'body_font_color', '#171717' );
    $site_title_color = get_theme_mod( 'site_title_color', '#141414' );
    $logo_width       = get_theme_mod( 'logo_width', 150 );
    
    $rgb = travelbee_hex2rgb( travelbee_sanitize_hex_color( $primary_color ) );
    $rgb2 = travelbee_hex2rgb( travelbee_sanitize_hex_color( $body_font_color ) );
    
    $about_sec_color = get_theme_mod( 'about_bg_color', '#f5ede8' );
    $about_type      = get_theme_mod( 'about_bg', 'color' );

    $shop_sec_image   = get_theme_mod( 'shop_bg_image' );
	$shop_sec_color   = get_theme_mod( 'shop_bg_color', '#fafafa' );
	$shop_type 		  = get_theme_mod( 'shop_bg', 'color' );

    $newsletter_bg_image = get_theme_mod( 'newsletter_bg_image');
    $newsletter_bg_color = get_theme_mod( 'newsletter_bg_color', '#faf6f4' );

    $cta_bg_color   = get_theme_mod( 'cta_bg_color', '#faf6f4' );
    
         
    echo "<style type='text/css' media='all'>"; ?>

    :root {
		--primary-color: <?php echo travelbee_sanitize_hex_color( $primary_color ); ?>;
		--primary-color-rgb: <?php printf('%1$s, %2$s, %3$s', $rgb[0], $rgb[1], $rgb[2] ); ?>;
        --font-color: <?php echo travelbee_sanitize_hex_color( $body_font_color ); ?>;
		--font-color-rgb: <?php printf('%1$s, %2$s, %3$s', $rgb2[0], $rgb2[1], $rgb2[2] ); ?>;
        --primary-font: <?php echo esc_html( $primary_fonts['font'] ); ?>;
        --secondary-font: <?php echo esc_html( $secondary_fonts['font'] ); ?>;
	}

    .site-title{
        font-size   : <?php echo absint( $site_title_font_size ); ?>px;
        font-family : <?php echo esc_html( $site_title_fonts['font'] ); ?>;
        font-weight : <?php echo esc_html( $site_title_fonts['weight'] ); ?>;
        font-style  : <?php echo esc_html( $site_title_fonts['style'] ); ?>;
    }
    
    .site-title a{
		color: <?php echo travelbee_sanitize_hex_color( $site_title_color ); ?>;
	}
     

    .custom-logo-link img{
        width: <?php echo absint( $logo_width ); ?>px;
        max-width: 100%;
	}

    .advance-cta .advance-cta-wrapper{
        background-color: <?php echo travelbee_sanitize_hex_color( $cta_bg_color ); ?>; 
    }

    <?php if( $about_type == 'color' && $about_sec_color ){ ?>   
        .about-section {
            background-color: <?php echo travelbee_sanitize_hex_color( $about_sec_color ); ?>;
        }
    <?php } 

    if( ( $shop_type == 'image' && $shop_sec_image ) || ( $shop_type == 'color' && $shop_sec_color ) ){ ?>
        .product-section {
            <?php if( $shop_type == 'image' ){ ?>
                background-image: url( <?php echo esc_url( $shop_sec_image ); ?> );
            <?php }elseif( $shop_type == 'color' ){ ?>
                background-color: <?php echo travelbee_sanitize_hex_color( $shop_sec_color ); ?>;
            <?php } ?>
        }
    <?php } 
    
    if( $newsletter_bg_image ){ ?>   
        .newsletter-section .grid-item.background-image::before {
            content : "";
            background-image: url( <?php echo esc_url( $newsletter_bg_image ); ?> );
        }
    <?php }

    if( $newsletter_bg_color ){ ?>   
        .newsletter-section {
            background-color: <?php echo travelbee_sanitize_hex_color( $newsletter_bg_color ); ?>;
        }
    <?php } 

    if( $newsletter_bg_color ){ ?>
        .newsletter {
                background-color: <?php echo travelbee_sanitize_hex_color( $newsletter_bg_color ); ?>;
            }
        <?php } 
    ?>

    /* Typography */

    body {
        font-family : <?php echo esc_html( $primary_fonts['font'] ); ?>;
        font-size   : <?php echo absint( $font_size ); ?>px;        
    }

    blockquote::before{
      background-image: url("data:image/svg+xml,%3Csvg width='72' height='54' viewBox='0 0 72 54' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M16.32 54C11.2 54 7.168 52.1684 4.224 48.5053C1.408 44.7158 0 39.7895 0 33.7263C0 26.5263 1.856 19.9579 5.568 14.0211C9.408 8.08422 15.104 3.41053 22.656 0L32.64 8.14737C27.392 9.91579 22.976 12.5684 19.392 16.1053C15.808 19.5158 13.44 23.3684 12.288 27.6632L13.248 28.0421C14.272 27.0316 16.064 26.5263 18.624 26.5263C21.824 26.5263 24.64 27.7263 27.072 30.1263C29.632 32.4 30.912 35.6211 30.912 39.7895C30.912 43.8316 29.504 47.2421 26.688 50.0211C23.872 52.6737 20.416 54 16.32 54ZM55.68 54C50.56 54 46.528 52.1684 43.584 48.5053C40.768 44.7158 39.36 39.7895 39.36 33.7263C39.36 26.5263 41.216 19.9579 44.928 14.0211C48.768 8.08422 54.464 3.41053 62.016 0L72 8.14737C66.752 9.91579 62.336 12.5684 58.752 16.1053C55.168 19.5158 52.8 23.3684 51.648 27.6632L52.608 28.0421C53.632 27.0316 55.424 26.5263 57.984 26.5263C61.184 26.5263 64 27.7263 66.432 30.1263C68.992 32.4 70.272 35.6211 70.272 39.7895C70.272 43.8316 68.864 47.2421 66.048 50.0211C63.232 52.6737 59.776 54 55.68 54Z' fill='<?php echo travelbee_hash_to_percent23( travelbee_sanitize_hex_color( $font_color ) ); ?>'/%3E%3C/svg%3E%0A");
    }
      
    nav.post-navigation .nav-links .nav-next:hover .meta-nav::before, nav.post-navigation .nav-links .nav-previous:hover .meta-nav::before {
        background-image: url("data:image/svg+xml,%3Csvg width='41' height='15' viewBox='0 0 41 15' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cline y1='-0.5' x2='39' y2='-0.5' transform='matrix(-1 0 0 1 40.5 8)' stroke='<?php echo travelbee_hash_to_percent23( travelbee_sanitize_hex_color( $primary_color ) ); ?>'/%3E%3Cpath d='M9 0C9 5 1 7.5 1 7.5C1 7.5 9 10 9 15' stroke='<?php echo travelbee_hash_to_percent23( travelbee_sanitize_hex_color( $primary_color ) ); ?>' stroke-linejoin='round'/%3E%3C/svg%3E ");
    }
    
    
    .newsletter-section .newsletter-section-grid .grid-item.background-image:after {
       background-image: url("data:image/svg+xml,%3Csvg width='148' height='41' viewBox='0 0 148 41' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1 24.4579C31.8897 43.7472 98.653 52.3941 141.5 6' stroke='<?php echo travelbee_hash_to_percent23( travelbee_sanitize_hex_color( $primary_color ) ); ?>'/%3E%3Cpath d='M131 5.93066C134.653 9.39553 141.942 5.19738 141.942 5.19738C141.942 5.19738 138.305 12.8604 141.958 16.3253' stroke='<?php echo travelbee_hash_to_percent23( travelbee_sanitize_hex_color( $primary_color ) ); ?>' stroke-linejoin='round'/%3E%3C/svg%3E ");
    }
    
    <?php 
    echo "</style>";
}

function travelbee_fonts_url(){
    $fonts_url = '';
    
    $primary_font       = get_theme_mod( 'primary_font', 'Open Sans' );
    $ig_primary_font    = travelbee_is_google_font( $primary_font );    
    $secondary_font     = get_theme_mod( 'secondary_font', 'Lora' );
    $ig_secondary_font  = travelbee_is_google_font( $secondary_font );    
    $site_title_font    = get_theme_mod( 'site_title_font', array( 'font-family'=>'Lora', 'variant'=>'regular' ) );
    $ig_site_title_font = travelbee_is_google_font( $site_title_font['font-family'] );
        
    /* Translators: If there are characters in your language that are not
    * supported by respective fonts, translate this to 'off'. Do not translate
    * into your own language.
    */
    $primary    = _x( 'on', 'Primary Font: on or off', 'travel-trail' );
    $secondary  = _x( 'on', 'Secondary Font: on or off', 'travel-trail' );
    $signature  = _x( 'on', 'Signature Font: on or off', 'travel-trail' );
    $site_title = _x( 'on', 'Site Title Font: on or off', 'travel-trail' );
    
    
    if ( 'off' !== $primary || 'off' !== $secondary || 'off' !== $site_title || 'off' == $signature ) {
        
        $font_families = array();
        
        if ( 'off' !== $primary && $ig_primary_font ) {
            $primary_variant = travelbee_check_varient( $primary_font, 'regular', true );
            if( $primary_variant ){
                $primary_var = ':' . $primary_variant;
            }else{
                $primary_var = '';    
            }            
            $font_families[] = $primary_font . $primary_var;
        }
            
        if ( 'off' !== $secondary && $ig_secondary_font ) {
            $secondary_variant = travelbee_check_varient( $secondary_font, 'regular', true );
            if( $secondary_variant ){
                $secondary_var = ':' . $secondary_variant;    
            }else{
                $secondary_var = '';
            }
            $font_families[] = $secondary_font . $secondary_var;
        }
        
        if ( 'off' !== $site_title && $ig_site_title_font ) {
            
            if( ! empty( $site_title_font['variant'] ) ){
                $site_title_var = ':' . travelbee_check_varient( $site_title_font['font-family'], $site_title_font['variant'] );    
            }else{
                $site_title_var = '';
            }
            $font_families[] = $site_title_font['font-family'] . $site_title_var;
        }

        if ( 'off' !== $signature ) {
            $font_families[] = 'Caveat:400';
        }
        
        $font_families = array_diff( array_unique( $font_families ), array('') );
        
        $query_args = array(
            'family' => urlencode( implode( '|', $font_families ) ),            
        );
        
        $fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
    }

    if( get_theme_mod( 'ed_localgoogle_fonts', false ) ) {
        $fonts_url = travelbee_get_webfont_url( add_query_arg( $query_args, 'https://fonts.googleapis.com/css' ) );
    }
        
    return esc_url( $fonts_url );
}

/**
 * Gutenberg Dynamic Style
 */
function travelbee_gutenberg_inline_style(){

    $primary_font    = get_theme_mod( 'primary_font', 'Open Sans' );
    $primary_fonts   = travelbee_get_fonts( $primary_font, 'regular' );
    $secondary_font  = get_theme_mod( 'secondary_font', 'Lora' );
    $secondary_fonts = travelbee_get_fonts( $secondary_font, 'regular' );
    $primary_color    = get_theme_mod( 'primary_color', '#c57e83' );
    $body_font_color  = get_theme_mod( 'body_font_color', '#171717' );
    $font_color      = "#171717";

    $rgb  = travelbee_hex2rgb( travelbee_sanitize_hex_color( $primary_color ) );
    $rgb3 = travelbee_hex2rgb( travelbee_sanitize_hex_color( $body_font_color ) );
    
    $custom_css = ':root .block-editor-page {
        --primary-font: ' . esc_html($primary_fonts['font']) . ';
        --secondary-font: ' . esc_html($secondary_fonts['font']) . ';
        --primary-color: ' . travelbee_sanitize_hex_color($primary_color) . ';
        --primary-color-rgb: ' . sprintf('%1$s, %2$s, %3$s', $rgb[0], $rgb[1], $rgb[2]) . ';
        --font-color: ' . travelbee_sanitize_hex_color($body_font_color) . ';
        --font-color-rgb: ' . sprintf('%1$s, %2$s, %3$s', $rgb3[0], $rgb3[1], $rgb3[2]) . ';
    }

    blockquote.wp-block-quote::before ,.wp-block-pullquote::before {
        background-image: url("data:image/svg+xml,%3Csvg width="72" height="54" viewBox="0 0 72 54" fill="none" xmlns="http://www.w3.org/2000/svg" %3E%3Cpath d="M16.32 54C11.2 54 7.168 52.1684 4.224 48.5053C1.408 44.7158 0 39.7895 0 33.7263C0 26.5263 1.856 19.9579 5.568 14.0211C9.408 8.08422 15.104 3.41053 22.656 0L32.64 8.14737C27.392 9.91579 22.976 12.5684 19.392 16.1053C15.808 19.5158 13.44 23.3684 12.288 27.6632L13.248 28.0421C14.272 27.0316 16.064 26.5263 18.624 26.5263C21.824 26.5263 24.64 27.7263 27.072 30.1263C29.632 32.4 30.912 35.6211 30.912 39.7895C30.912 43.8316 29.504 47.2421 26.688 50.0211C23.872 52.6737 20.416 54 16.32 54ZM55.68 54C50.56 54 46.528 52.1684 43.584 48.5053C40.768 44.7158 39.36 39.7895 39.36 33.7263C39.36 26.5263 41.216 19.9579 44.928 14.0211C48.768 8.08422 54.464 3.41053 62.016 0L72 8.14737C66.752 9.91579 62.336 12.5684 58.752 16.1053C55.168 19.5158 52.8 23.3684 51.648 27.6632L52.608 28.0421C53.632 27.0316 55.424 26.5263 57.984 26.5263C61.184 26.5263 64 27.7263 66.432 30.1263C68.992 32.4 70.272 35.6211 70.272 39.7895C70.272 43.8316 68.864 47.2421 66.048 50.0211C63.232 52.6737 59.776 54 55.68 54Z" fill="' . travelbee_hash_to_percent23( travelbee_sanitize_hex_color(  $font_color  ) ) . '"/%3E%3C/svg%3E%0A");
    }';

    return $custom_css;
}

/**
 * Ajax Callback
 */
function travelbee_dynamic_mce_css_ajax_callback(){
     
    /* Check nonce for security */
    $nonce = isset( $_REQUEST['_nonce'] ) ? $_REQUEST['_nonce'] : '';
    if( ! wp_verify_nonce( $nonce, 'travelbee_dynamic_mce_nonce' ) ){
        die(); // don't print anything
    }

    $primary_font    = get_theme_mod( 'primary_font', 'Open Sans' );
    $primary_fonts   = travelbee_get_fonts( $primary_font, 'regular' );
    $secondary_font  = get_theme_mod( 'secondary_font', 'Lora' );
    $secondary_fonts = travelbee_get_fonts( $secondary_font, 'regular' );
    $primary_color   = get_theme_mod( 'primary_color', '#c57e83' );
    $body_font_color  = get_theme_mod( 'body_font_color', '#171717' );
    $font_color      = "#171717";

    $rgb  = travelbee_hex2rgb( travelbee_sanitize_hex_color( $primary_color ) );
    $rgb3 = travelbee_hex2rgb( travelbee_sanitize_hex_color( $body_font_color ) );
    
    /* Set File Type and Print the CSS Declaration */
    header( 'Content-type: text/css' );
    echo ':root .mce-content-body {
        --primary-font: ' . esc_html( $primary_fonts['font'] ) . ';
        --secondary-font: ' . esc_html( $secondary_fonts['font'] ) . ';
        --primary-color: ' . travelbee_sanitize_hex_color( $primary_color ) . ';
        --primary-color-rgb: ' . sprintf( '%1$s, %2$s, %3$s', $rgb[0], $rgb[1], $rgb[2] ) . ';
        --font-color: ' . travelbee_sanitize_hex_color($body_font_color) . ';
        --font-color-rgb: ' . sprintf('%1$s, %2$s, %3$s', $rgb3[0], $rgb3[1], $rgb3[2]) . ';
    }

    blockquote.wp-block-quote::before ,.wp-block-pullquote::before {
        background-image: url("data:image/svg+xml,%3Csvg width="72" height="54" viewBox="0 0 72 54" fill="none" xmlns="http://www.w3.org/2000/svg" %3E%3Cpath d="M16.32 54C11.2 54 7.168 52.1684 4.224 48.5053C1.408 44.7158 0 39.7895 0 33.7263C0 26.5263 1.856 19.9579 5.568 14.0211C9.408 8.08422 15.104 3.41053 22.656 0L32.64 8.14737C27.392 9.91579 22.976 12.5684 19.392 16.1053C15.808 19.5158 13.44 23.3684 12.288 27.6632L13.248 28.0421C14.272 27.0316 16.064 26.5263 18.624 26.5263C21.824 26.5263 24.64 27.7263 27.072 30.1263C29.632 32.4 30.912 35.6211 30.912 39.7895C30.912 43.8316 29.504 47.2421 26.688 50.0211C23.872 52.6737 20.416 54 16.32 54ZM55.68 54C50.56 54 46.528 52.1684 43.584 48.5053C40.768 44.7158 39.36 39.7895 39.36 33.7263C39.36 26.5263 41.216 19.9579 44.928 14.0211C48.768 8.08422 54.464 3.41053 62.016 0L72 8.14737C66.752 9.91579 62.336 12.5684 58.752 16.1053C55.168 19.5158 52.8 23.3684 51.648 27.6632L52.608 28.0421C53.632 27.0316 55.424 26.5263 57.984 26.5263C61.184 26.5263 64 27.7263 66.432 30.1263C68.992 32.4 70.272 35.6211 70.272 39.7895C70.272 43.8316 68.864 47.2421 66.048 50.0211C63.232 52.6737 59.776 54 55.68 54Z" fill="' . travelbee_hash_to_percent23( travelbee_sanitize_hex_color( $font_color ) ) . '"/%3E%3C/svg%3E%0A");
    }';
    die(); // end ajax process.
}

/**
 * Footer Bottom
*/
function travelbee_footer_bottom(){ ?>
    <div class="footer-b">
        <div class="container">
            <div class="footer-bottom-t">
                <?php 
                travelbee_footer_navigation();
                travelbee_social_links(); ?>
            </div>
            <div class="site-info">            
                <?php
                    travelbee_get_footer_copyright();
                    esc_html_e( ' Travel Trail | Developed By ', 'travel-trail' );
                    echo '<span class="author-link"><a href="' . esc_url( 'https://rarathemes.com/' ) .'" rel="nofollow" target="_blank">' . esc_html__( 'Rara Themes', 'travel-trail' ) . '</a></span>.';
                    printf( esc_html__( '%1$s Powered by %2$s%3$s.', 'travel-trail' ), '<span class="wp-link">', '<a href="'. esc_url( __( 'https://wordpress.org/', 'travel-trail' ) ) .'" target="_blank">WordPress</a>', '</span>' );
                    if ( function_exists( 'the_privacy_policy_link' ) ) {
                        the_privacy_policy_link();
                    }
                ?>           
            </div>
        </div>
    </div>
    <?php
}