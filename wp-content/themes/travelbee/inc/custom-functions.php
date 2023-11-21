<?php
/**
 * Travelbee Custom functions and definitions
 *
 * @package Travelbee
 */


if ( ! function_exists( 'travelbee_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function travelbee_setup() {
    
    $build  = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '/build' : '';
    $suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';
    
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Travelbee, use a find and replace
	 * to change 'travelbee' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'travelbee', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary'   => esc_html__( 'Primary', 'travelbee' ),
        'footer'    => esc_html__( 'Footer', 'travelbee' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-list',
		'gallery',
		'caption',
	) );
    
    // Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'travelbee_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
    
	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support( 
        'custom-logo', 
        array( 
            'header-text' => array( 'site-title', 'site-description' ) 
        )
    );
    
    /**
     * Add support for custom header.
    */
    add_theme_support( 
        'custom-header', 
        apply_filters( 
            'travelbee_custom_header_args', 
            array(
                'default-image' => '',
                'video'         => true,
                'width'         => 1920,
                'height'        => 760,
                'header-text'   => false
            ) 
        ) 
    );
 
    /**
     * Add Custom Images sizes.
    */    
    add_image_size( 'travelbee-slider', 585, 440, true );
    add_image_size( 'travelbee-blog-home', 750, 500, true ); 
    add_image_size( 'travelbee-with-sidebar', 750, 565, true );  
    add_image_size( 'travelbee-shop', 265, 350, true );
    add_image_size( 'travelbee-related', 365, 275, true );
    add_image_size( 'travelbee-popular', 364, 364, true );
    add_image_size( 'travelbee-latest', 364, 496, true );
    
    // Add theme support for Responsive Videos.
    add_theme_support( 'jetpack-responsive-videos' );

    // Add excerpt support for pages
    add_post_type_support( 'page', 'excerpt' );

    // Add support for full and wide align images.
    add_theme_support( 'align-wide' );

    // Add support for editor styles.
    add_theme_support( 'editor-styles' );

    /*
     * This theme styles the visual editor to resemble the theme style,
     * specifically font, colors, and column width.
     *
     */
    add_editor_style( array(
        'css' . $build . '/editor-style' . $suffix . '.css',
        travelbee_fonts_url()
        )
    );

    // Add support for block editor styles.
    add_theme_support( 'wp-block-styles' );

    //Remove block widgets
    remove_theme_support( 'widgets-block-editor' );
}
endif;
add_action( 'after_setup_theme', 'travelbee_setup' );

if( ! function_exists( 'travelbee_content_width' ) ) :
/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function travelbee_content_width() {
	
    $GLOBALS['content_width'] = apply_filters( 'travelbee_content_width', 750 );
}
endif;
add_action( 'after_setup_theme', 'travelbee_content_width', 0 );

if( ! function_exists( 'travelbee_template_redirect_content_width' ) ) :
/**
* Adjust content_width value according to template.
*
* @return void
*/
function travelbee_template_redirect_content_width(){
	$sidebar = travelbee_sidebar();
    if( $sidebar ){	      
        $GLOBALS['content_width'] = 750;       
	}else{
        
        if( is_singular() ){
            if( travelbee_sidebar( true ) === 'full-width centered' ){
                $GLOBALS['content_width'] = 750;
            }else{
                $GLOBALS['content_width'] = 1170;                
            }                
        }else{
            $GLOBALS['content_width'] = 1170;
        }
	}
}
endif;
add_action( 'template_redirect', 'travelbee_template_redirect_content_width' );

if( ! function_exists( 'travelbee_scripts' ) ) :
/**
 * Enqueue scripts and styles.
 */
function travelbee_scripts() {
	// Use minified libraries if SCRIPT_DEBUG is false
    $build  = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '/build' : '';
    $suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';

    if( travelbee_is_woocommerce_activated() )
    wp_enqueue_style( 'travelbee-woocommerce', get_template_directory_uri(). '/css' . $build . '/woocommerce' . $suffix . '.css', array(), TRAVELBEE_THEME_VERSION );
    
    if ( get_theme_mod( 'ed_localgoogle_fonts', false ) && ! is_customize_preview() && ! is_admin() && get_theme_mod( 'ed_preload_local_fonts', false ) ) {
        travelbee_preload_local_fonts( travelbee_fonts_url() );
    }

    wp_enqueue_style( 'travelbee-google-fonts', travelbee_fonts_url(), array(), null );

    wp_enqueue_style( 'all', get_template_directory_uri(). '/css/all.min.css', array(), '6.1.1' );
    wp_enqueue_style( 'owl-carousel', get_template_directory_uri(). '/css' . $build . '/owl.carousel' . $suffix . '.css', array(), '2.3.4' );
    wp_enqueue_style( 'animate', get_template_directory_uri(). '/css' . $build . '/animate' . $suffix . '.css', array(), '3.5.2' );

    wp_enqueue_style( 'travelbee', get_template_directory_uri() . '/style' . $suffix . '.css', TRAVELBEE_THEME_VERSION );

    if( travelbee_is_elementor_activated() )
    wp_enqueue_style( 'travelbee-elementor', get_template_directory_uri(). '/css' . $build . '/elementor' . $suffix . '.css', array(), TRAVELBEE_THEME_VERSION );
    
    if( is_singular() )
    wp_enqueue_style( 'travelbee-gutenberg', get_template_directory_uri(). '/css' . $build . '/gutenberg' . $suffix . '.css', array(), TRAVELBEE_THEME_VERSION );

    wp_enqueue_script( 'all', get_template_directory_uri() . '/js' . $build . '/all' . $suffix . '.js', array( 'jquery' ), '6.1.1', true );
    wp_enqueue_script( 'v4-shims', get_template_directory_uri() . '/js' . $build . '/v4-shims' . $suffix . '.js', array( 'jquery', 'all' ), '6.1.1', true );
	wp_enqueue_script( 'owl-carousel', get_template_directory_uri() . '/js' . $build . '/owl.carousel' . $suffix . '.js', array( 'jquery' ), '2.3.4', true );
	wp_enqueue_script( 'travelbee', get_template_directory_uri() . '/js' . $build . '/custom' . $suffix . '.js',  array( 'jquery' ), TRAVELBEE_THEME_VERSION, true );
    wp_enqueue_script( 'travelbee-accessibility', get_template_directory_uri() . '/js' . $build . '/modal-accessibility' . $suffix . '.js', array( 'jquery' ),TRAVELBEE_THEME_VERSION, true );

    $array = array( 
        'rtl'           => is_rtl(),
        'auto'          => (bool) get_theme_mod( 'slider_auto', false ),
        'loop'          => (bool) get_theme_mod( 'slider_loop', false ),
        'animation'     => esc_attr( get_theme_mod( 'slider_animation' ) ),
        'speed'         => absint( get_theme_mod( 'slider_speed', 5000 ) ),
        'sticky'        => (bool) get_theme_mod( 'ed_sticky_header', false ),
    );

    wp_localize_script( 'travelbee', 'travelbee_data', $array );
    
    if ( travelbee_is_jetpack_activated( true ) ) {
        wp_enqueue_style( 'tiled-gallery', plugins_url() . '/jetpack/modules/tiled-gallery/tiled-gallery/tiled-gallery.css' );            
    }
    
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
endif;
add_action( 'wp_enqueue_scripts', 'travelbee_scripts' );

if( ! function_exists( 'travelbee_admin_scripts' ) ) :
/**
 * Enqueue admin scripts and styles.
*/
function travelbee_admin_scripts( $hook ){
    if( $hook == 'post-new.php' || $hook == 'post.php' || $hook == 'user-new.php' || $hook == 'user-edit.php' || $hook == 'profile.php' ){
        wp_enqueue_style( 'travelbee-admin', get_template_directory_uri() . '/inc/css/admin.css', '', TRAVELBEE_THEME_VERSION );
    }
}
endif; 
add_action( 'admin_enqueue_scripts', 'travelbee_admin_scripts' );

if( ! function_exists( 'travelbee_block_editor_styles' ) ) :
/**
 * Enqueue editor styles for Gutenberg
 */
function travelbee_block_editor_styles() {
    // Use minified libraries if SCRIPT_DEBUG is false
    $build  = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '/build' : '';
    $suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';
    
    // Block styles.
    wp_enqueue_style( 'travelbee-block-editor-style', get_template_directory_uri() . '/css' . $build . '/editor-block' . $suffix . '.css' );

    wp_add_inline_style( 'travelbee-block-editor-style', travelbee_gutenberg_inline_style() );

    // Add custom fonts.
    wp_enqueue_style( 'travelbee-google-fonts', travelbee_fonts_url(), array(), null );

}
endif;
add_action( 'enqueue_block_editor_assets', 'travelbee_block_editor_styles' );

if( ! function_exists( 'travelbee_body_classes' ) ) :
/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function travelbee_body_classes( $classes ) {
    $editor_options      = get_option( 'classic-editor-replace' );
    $allow_users_options = get_option( 'classic-editor-allow-users' );

    if( is_home() || ( is_archive() && !( travelbee_is_woocommerce_activated() && ( is_shop() || is_product_category() || is_product_tag() ) ) || is_search() ) ){
        $classes[] = 'classic-one';
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
endif;
add_filter( 'body_class', 'travelbee_body_classes' );

if( ! function_exists( 'travelbee_post_classes' ) ) :
/**
 * Add custom classes to the array of post classes.
*/
function travelbee_post_classes( $classes ){
    $ed_featured          = get_theme_mod( 'ed_featured_image', true );
    $classes[]            = 'has-meta';
    
    if( ( is_single() ) && (! has_post_thumbnail() || !$ed_featured  ) ) $classes[] = 'no-thumbnail';

    return $classes;
}
endif;
add_filter( 'post_class', 'travelbee_post_classes' );

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function travelbee_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'travelbee_pingback_header' );

if( ! function_exists( 'travelbee_change_comment_form_default_fields' ) ) :
/**
 * Change Comment form default fields i.e. author, email & url.
 * https://blog.josemcastaneda.com/2016/08/08/copy-paste-hurting-theme/
*/
function travelbee_change_comment_form_default_fields( $fields ){    
    // get the current commenter if available
    $commenter = wp_get_current_commenter();
 
    // core functionality
    $req = get_option( 'require_name_email' );
    $aria_req = ( $req ? " aria-required='true'" : '' );    
 
    // Change just the author field
    $fields['author'] = '<p class="comment-form-author"><label for="author">' . esc_html__( 'Name', 'travelbee' ) . '<span class="required">*</span></label><input id="author" name="author" placeholder="' . esc_attr__( 'Name*', 'travelbee' ) . '" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /></p>';
    
    $fields['email'] = '<p class="comment-form-email"><label for="email">' . esc_html__( 'Email', 'travelbee' ) . '<span class="required">*</span></label><input id="email" name="email" placeholder="' . esc_attr__( 'Email*', 'travelbee' ) . '" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' /></p>';
    
    $fields['url'] = '<p class="comment-form-url"><label for="url">' . esc_html__( 'Website', 'travelbee' ) . '</label><input id="url" name="url" placeholder="' . esc_attr__( 'Website', 'travelbee' ) . '" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></p>'; 
    
    return $fields;    
}
endif;
add_filter( 'comment_form_default_fields', 'travelbee_change_comment_form_default_fields' );

if( ! function_exists( 'travelbee_change_comment_form_defaults' ) ) :
/**
 * Change Comment Form defaults
 * https://blog.josemcastaneda.com/2016/08/08/copy-paste-hurting-theme/
*/
function travelbee_change_comment_form_defaults( $defaults ){    
    $defaults['comment_field'] = '<p class="comment-form-comment"><label for="comment">' . esc_html__( 'Comment', 'travelbee' ) . '</label><textarea id="comment" name="comment" placeholder="' . esc_attr__( 'Comment', 'travelbee' ) . '" cols="45" rows="8" aria-required="true"></textarea></p>';
    
    return $defaults;    
}
endif;
add_filter( 'comment_form_defaults', 'travelbee_change_comment_form_defaults' );

if ( ! function_exists( 'travelbee_excerpt_more' ) ) :
/**
 * Replaces "[...]" (appended to automatically generated excerpts) with ... * 
 */
function travelbee_excerpt_more( $more ) {
	return is_admin() ? $more : ' &hellip; ';
}

endif;
add_filter( 'excerpt_more', 'travelbee_excerpt_more' );

if ( ! function_exists( 'travelbee_excerpt_length' ) ) :
/**
 * Changes the default 55 character in excerpt 
*/
function travelbee_excerpt_length( $length ) {
	$excerpt_length = get_theme_mod( 'excerpt_length', 25 );
    return is_admin() ? $length : absint( $excerpt_length );    
}
endif;
add_filter( 'excerpt_length', 'travelbee_excerpt_length', 999 );

if( ! function_exists( 'travelbee_exclude_cat' ) ) :
/**
 * Exclude post with Category from blog and archive page. 
*/
function travelbee_exclude_cat( $query ){
    $ed_banner        = get_theme_mod( 'ed_banner_section', 'slider_banner' );
    $slider_type      = get_theme_mod( 'slider_type', 'latest_posts' );
    $slider_cat       = get_theme_mod( 'slider_cat' );
    $posts_per_page   = get_theme_mod( 'no_of_slides', 3 );
    $repetitive_posts = get_theme_mod( 'include_repetitive_posts', true );
    
    if( ! is_admin() && $query->is_main_query() && $query->is_home() && ( $ed_banner == 'slider_banner' ) && ! $repetitive_posts ){
        if( $slider_type === 'cat' && $slider_cat  ){            
 			$query->set( 'category__not_in', array( $slider_cat ) );    		
        }elseif( $slider_type == 'latest_posts' ){
            $args = array(
                'post_type'           => 'post',
                'post_status'         => 'publish',
                'posts_per_page'      => $posts_per_page,
                'ignore_sticky_posts' => true
            );
            $latest = get_posts( $args );
            $excludes = array();
            foreach( $latest as $l ){
                array_push( $excludes, $l->ID );
            }
            $query->set( 'post__not_in', $excludes );
        }  
    }  
}
endif;
add_filter( 'pre_get_posts', 'travelbee_exclude_cat' );

if( ! function_exists( 'travelbee_get_the_archive_title' ) ) :
/**
 * Filter Archive Title
*/
function travelbee_get_the_archive_title( $title ){
    $ed_prefix = get_theme_mod( 'ed_prefix_archive', true );

    if( is_post_type_archive( 'product' ) ){
        $title = '<h1 class="page-title">' . get_the_title( get_option( 'woocommerce_shop_page_id' ) ) . '</h1>';
    }else{
        if( is_category() ){
            if( $ed_prefix ) {
                $title = '<h1 class="page-title">' . esc_html( single_cat_title( '', false ) ) . '</h1>';
            }else{
                $title = '<span class="sub-title">'. esc_html__( 'Category', 'travelbee' ) . '</span><h1 class="page-title">' . esc_html( single_cat_title( '', false ) ) . '</h1>';
            }
        }
        elseif( is_tag() ){
            if( $ed_prefix ) {
                $title = '<h1 class="page-title">' . esc_html( single_tag_title( '', false ) ) . '</h1>';
            }else{
                $title = '<span class="sub-title">'. esc_html__( 'Tag', 'travelbee' ) . '</span><h1 class="page-title">' . esc_html( single_tag_title( '', false ) ) . '</h1>';
            }
        }elseif( is_year() ){
            if( $ed_prefix ){
                $title = '<h1 class="page-title">' . get_the_date( _x( 'Y', 'yearly archives date format', 'travelbee' ) ) . '</h1>';                   
            }else{
                $title = '<span class="sub-title">'. esc_html__( 'Year', 'travelbee' ) . '</span><h1 class="page-title">' . get_the_date( _x( 'Y', 'yearly archives date format', 'travelbee' ) ) . '</h1>';
            }
        }elseif( is_month() ){
            if( $ed_prefix ){
                $title = '<h1 class="page-title">' . get_the_date( _x( 'F Y', 'monthly archives date format', 'travelbee' ) ) . '</h1>';                                   
            }else{
                $title = '<span class="sub-title">'. esc_html__( 'Month', 'travelbee' ) . '</span><h1 class="page-title">' . get_the_date( _x( 'F Y', 'monthly archives date format', 'travelbee' ) ) . '</h1>';
            }
        }elseif( is_day() ){
            if( $ed_prefix ){
                $title = '<h1 class="page-title">' . get_the_date( _x( 'F j, Y', 'daily archives date format', 'travelbee' ) ) . '</h1>';                                   
            }else{
                $title = '<span class="sub-title">'. esc_html__( 'Day', 'travelbee' ) . '</span><h1 class="page-title">' . get_the_date( _x( 'F j, Y', 'daily archives date format', 'travelbee' ) ) .  '</h1>';
            }
        }elseif( is_post_type_archive() ) {
            if( $ed_prefix ){
                $title = '<h1 class="page-title">'  . post_type_archive_title( '', false ) . '</h1>';                            
            }else{
                $title = '<span class="sub-title">'. esc_html__( 'Archives', 'travelbee' ) . '</span><h1 class="page-title">'  . post_type_archive_title( '', false ) . '</h1>';
            }
        }elseif( is_tax() ) {
            $tax = get_taxonomy( get_queried_object()->taxonomy );
            if( $ed_prefix ){
                $title = '<h1 class="page-title">' . single_term_title( '', false ) . '</h1>';                                   
            }else{
                $title = '<span class="sub-title">' . $tax->labels->singular_name . '</span><h1 class="page-title">' . single_term_title( '', false ) . '</h1>';
            }
        }
    } 

    return $title;
    
}
endif;
add_filter( 'get_the_archive_title', 'travelbee_get_the_archive_title' );


if( ! function_exists( 'travelbee_get_comment_author_link' ) ) :
/**
 * Filter to modify comment author link
 * @link https://developer.wordpress.org/reference/functions/get_comment_author_link/
 */
function travelbee_get_comment_author_link( $return, $author, $comment_ID ){
    $comment = get_comment( $comment_ID );
    $url     = get_comment_author_url( $comment );
    $author  = get_comment_author( $comment );
 
    if ( empty( $url ) || 'http://' == $url )
        $return = '<span itemprop="name">'. esc_html( $author ) .'</span>';
    else
        $return = '<span itemprop="name"><a href=' . esc_url( $url ) . ' rel="external nofollow noopener" class="url" itemprop="url">' . esc_html( $author ) . '</a></span>';

    return $return;
}
endif;
add_filter( 'get_comment_author_link', 'travelbee_get_comment_author_link', 10, 3 );


if( ! function_exists( 'travelbee_admin_notice' ) ) :
/**
 * Addmin notice for getting started page
*/
function travelbee_admin_notice(){
    global $pagenow;
    $theme_args      = wp_get_theme();
    $meta            = get_option( 'travelbee_admin_notice' );
    $name            = $theme_args->__get( 'Name' );
    $current_screen  = get_current_screen();
    
    if( 'themes.php' == $pagenow && !$meta ){
        
        if( $current_screen->id !== 'dashboard' && $current_screen->id !== 'themes' ){
            return;
        }

        if( is_network_admin() ){
            return;
        }

        if( ! current_user_can( 'manage_options' ) ){
            return;
        } ?>
        <div class="welcome-message notice notice-info">
            <div class="notice-wrapper">
                <div class="notice-text">
                    <h3><?php esc_html_e( 'Congratulations!', 'travelbee' ); ?></h3>
                    <p><?php printf( __( '%1$s is now installed and ready to use. Click below to see theme documentation, plugins to install and other details to get started.', 'travelbee' ), esc_html( $name ) ) ; ?></p>
                    <p><a href="<?php echo esc_url( admin_url( 'themes.php?page=travelbee-getting-started' ) ); ?>" class="button button-primary"><?php esc_html_e( 'Go to the getting started.', 'travelbee' ); ?></a></p>
                    <p class="dismiss-link"><strong><a href="?travelbee_admin_notice=1"><?php esc_html_e( 'Dismiss', 'travelbee' ); ?></a></strong></p>
                </div>
            </div>
        </div>
    <?php }
}
endif;
add_action( 'admin_notices', 'travelbee_admin_notice' );

if( ! function_exists( 'travelbee_update_admin_notice' ) ) :
/**
 * Updating admin notice on dismiss
*/
function travelbee_update_admin_notice(){
    if ( isset( $_GET['travelbee_admin_notice'] ) && $_GET['travelbee_admin_notice'] = '1' ) {
        update_option( 'travelbee_admin_notice', true );
    }
}
endif;
add_action( 'admin_init', 'travelbee_update_admin_notice' );

if ( ! function_exists( 'travelbee_get_fontawesome_ajax' ) ) :
/**
 * Return an array of all icons.
 */
function travelbee_get_fontawesome_ajax() {
    // Bail if the nonce doesn't check out
    if ( ! isset( $_POST['travelbee_customize_nonce'] ) || ! wp_verify_nonce( sanitize_key( $_POST['travelbee_customize_nonce'] ), 'travelbee_customize_nonce' ) ) {
        wp_die();
    }

    // Do another nonce check
    check_ajax_referer( 'travelbee_customize_nonce', 'travelbee_customize_nonce' );

    // Bail if user can't edit theme options
    if ( ! current_user_can( 'edit_theme_options' ) ) {
        wp_die();
    }

    // Get all of our fonts
    $fonts = travelbee_get_fontawesome_list();
    
    ob_start();
    if( $fonts ){ ?>
        <ul class="font-group">
            <?php 
                foreach( $fonts as $font ){
                    echo '<li data-font="' . esc_attr( $font ) . '"><i class="' . esc_attr( $font ) . '"></i></li>';                        
                }
            ?>
        </ul>
        <?php
    }
    echo ob_get_clean();

    // Exit
    wp_die();
}
endif;
add_action( 'wp_ajax_travelbee_get_fontawesome_ajax', 'travelbee_get_fontawesome_ajax' );

if ( ! function_exists( 'travelbee_dynamic_mce_css' ) ) :
/**
 * Add Editor Style 
 * Add Link Color Option in Editor Style (MCE CSS)
 */
function travelbee_dynamic_mce_css( $mce_css ){
    $mce_css .= ', ' . add_query_arg( array( 'action' => 'travelbee_dynamic_mce_css', '_nonce' => wp_create_nonce( 'travelbee_dynamic_mce_nonce', __FILE__ ) ), admin_url( 'admin-ajax.php' ) );
    return $mce_css;
}
endif;
add_filter( 'mce_css', 'travelbee_dynamic_mce_css' );
     
if ( ! function_exists( 'travelbee_dynamic_mce_css_ajax_callback' ) ) : 
/**
 * Ajax Callback
 */
function travelbee_dynamic_mce_css_ajax_callback(){
     
    /* Check nonce for security */
    $nonce = isset( $_REQUEST['_nonce'] ) ? $_REQUEST['_nonce'] : '';
    if( ! wp_verify_nonce( $nonce, 'travelbee_dynamic_mce_nonce' ) ){
        die(); // don't print anything
    }

    $primary_font    = get_theme_mod( 'primary_font', 'Work Sans' );
    $primary_fonts   = travelbee_get_fonts( $primary_font, 'regular' );
    $secondary_font  = get_theme_mod( 'secondary_font', 'Ovo' );
    $secondary_fonts = travelbee_get_fonts( $secondary_font, 'regular' );
    $primary_color   = get_theme_mod( 'primary_color', '#e79372' );
    $font_color      = "#575757";

    $rgb  = travelbee_hex2rgb( travelbee_sanitize_hex_color( $primary_color ) );
    
    /* Set File Type and Print the CSS Declaration */
    header( 'Content-type: text/css' );
    echo ':root .mce-content-body {
        --primary-font: ' . esc_html( $primary_fonts['font'] ) . ';
        --secondary-font: ' . esc_html( $secondary_fonts['font'] ) . ';
        --primary-color: ' . travelbee_sanitize_hex_color( $primary_color ) . ';
        --primary-color-rgb: ' . sprintf( '%1$s, %2$s, %3$s', $rgb[0], $rgb[1], $rgb[2] ) . ';
    }

    blockquote.wp-block-quote::before ,.wp-block-pullquote::before {
        background-image: url("data:image/svg+xml,%3Csvg width="72" height="54" viewBox="0 0 72 54" fill="none" xmlns="http://www.w3.org/2000/svg" %3E%3Cpath d="M16.32 54C11.2 54 7.168 52.1684 4.224 48.5053C1.408 44.7158 0 39.7895 0 33.7263C0 26.5263 1.856 19.9579 5.568 14.0211C9.408 8.08422 15.104 3.41053 22.656 0L32.64 8.14737C27.392 9.91579 22.976 12.5684 19.392 16.1053C15.808 19.5158 13.44 23.3684 12.288 27.6632L13.248 28.0421C14.272 27.0316 16.064 26.5263 18.624 26.5263C21.824 26.5263 24.64 27.7263 27.072 30.1263C29.632 32.4 30.912 35.6211 30.912 39.7895C30.912 43.8316 29.504 47.2421 26.688 50.0211C23.872 52.6737 20.416 54 16.32 54ZM55.68 54C50.56 54 46.528 52.1684 43.584 48.5053C40.768 44.7158 39.36 39.7895 39.36 33.7263C39.36 26.5263 41.216 19.9579 44.928 14.0211C48.768 8.08422 54.464 3.41053 62.016 0L72 8.14737C66.752 9.91579 62.336 12.5684 58.752 16.1053C55.168 19.5158 52.8 23.3684 51.648 27.6632L52.608 28.0421C53.632 27.0316 55.424 26.5263 57.984 26.5263C61.184 26.5263 64 27.7263 66.432 30.1263C68.992 32.4 70.272 35.6211 70.272 39.7895C70.272 43.8316 68.864 47.2421 66.048 50.0211C63.232 52.6737 59.776 54 55.68 54Z" fill="' . travelbee_hash_to_percent23( travelbee_sanitize_hex_color( $font_color ) ) . '"/%3E%3C/svg%3E%0A");
    }';
    die(); // end ajax process.
}
endif;
add_action( 'wp_ajax_travelbee_dynamic_mce_css', 'travelbee_dynamic_mce_css_ajax_callback' );
add_action( 'wp_ajax_no_priv_travelbee_dynamic_mce_css', 'travelbee_dynamic_mce_css_ajax_callback' );