<?php
/**
 * Travelbee Customizer Partials
 *
 * @package Travelbee
 */

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function travelbee_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function travelbee_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

if( ! function_exists( 'travelbee_get_banner_title' ) ) :
/**
 * Banner Title
*/
function travelbee_get_banner_title(){
    return esc_html( get_theme_mod( 'banner_title' ) );
}
endif;

if( ! function_exists( 'travelbee_get_banner_description' ) ) :
/**
 * Banner Description
*/
function travelbee_get_banner_description(){
    return wp_kses_post( wpautop( get_theme_mod( 'banner_description' ) ) );
}
endif;

if( ! function_exists( 'travelbee_get_banner_button_one_label' ) ) :
/**
 * Banner Button One Label
*/
function travelbee_get_banner_button_one_label(){
    return esc_html( get_theme_mod( 'button_one_label' ) );
}
endif;
    
if( ! function_exists( 'travelbee_get_banner_button_two_label' ) ) :
/**
 * Banner Button Two Label
*/
function travelbee_get_banner_button_two_label(){
    return esc_html( get_theme_mod( 'button_two_label' ) );
}
endif;

if( ! function_exists( 'travelbee_get_slider_readmore' ) ) :
/**
 * Slider Read More
*/
function travelbee_get_slider_readmore(){
    return esc_html( get_theme_mod( 'slider_readmore', __( 'Continue Reading', 'travelbee' ) ) );
}
endif;

if( ! function_exists( 'travelbee_get_cta_title' ) ) :
/**
 * Cta title
*/
function travelbee_get_cta_title(){
    return esc_html( get_theme_mod( 'cta_title' ) );
}
endif;

if( ! function_exists( 'travelbee_get_cta_subtitle' ) ) :
/**
 * Cta subtitle
*/
function travelbee_get_cta_subtitle(){
    return esc_html( get_theme_mod( 'cta_subtitle' ) );
}
endif;

if( ! function_exists( 'travelbee_get_cta_content' ) ) :
/**
 * Cta content
*/
function travelbee_get_cta_content(){
    return esc_html( get_theme_mod( 'cta_content' ) );
}
endif;

if( ! function_exists( 'travelbee_get_cta_btn_one' ) ) :
/**
 * Cta button one
*/
function travelbee_get_cta_btn_one(){
    return esc_html( get_theme_mod( 'cta_btn_one' ) );
}
endif;

if( ! function_exists( 'travelbee_get_cta_btn_two' ) ) :
/**
 * Cta button two
*/
function travelbee_get_cta_btn_two(){
    return esc_html(get_theme_mod( 'cta_btn_two' ) );
}
endif;

if( ! function_exists( 'travelbee_get_shop_title' ) ) :
/**
 * Display Shop Section Title
*/
function travelbee_get_shop_title(){
    return esc_html( get_theme_mod( 'shop_section_title', __( 'Shop', 'travelbee' ) ) );    
}
endif;

if( ! function_exists( 'travelbee_get_shop_content' ) ) :
/**
 * Display Shop Section Description
*/
function travelbee_get_shop_content(){
    return esc_html( get_theme_mod( 'shop_section_content' ) );    
}
endif;

if( ! function_exists( 'travelbee_get_shop_btn_lbl' ) ) :
/**
 * Display Shop Section Button Label
*/
function travelbee_get_shop_btn_lbl(){
    return esc_html( get_theme_mod( 'shop_btn_lbl',__( 'Go To Shop', 'travelbee' ) ) );    
}
endif;

if( ! function_exists( 'travelbee_get_blog_text' ) ) :
/**
 * Blog title
*/
function travelbee_get_blog_text(){
    return esc_html( get_theme_mod( 'blog_text', __( 'Latest Articles', 'travelbee' ) ) );
}
endif;

if( ! function_exists( 'travelbee_get_read_more' ) ) :
/**
 * Display blog readmore button
*/
function travelbee_get_read_more(){
    return esc_html( get_theme_mod( 'read_more_text', __( 'Read More', 'travelbee' ) ) );    
}
endif;

if( ! function_exists( 'travelbee_get_author_title' ) ) :
/**
 * Display blog readmore button
*/
function travelbee_get_author_title(){
    return esc_html( get_theme_mod( 'author_title', __( 'About Author', 'travelbee' )) );
}
endif;

if( ! function_exists( 'travelbee_get_related_title' ) ) :
/**
 * Display blog readmore button
*/
function travelbee_get_related_title(){
    return esc_html( get_theme_mod( 'related_post_title', __( 'You may also like...', 'travelbee' ) ) );
}
endif;

if( ! function_exists( 'travelbee_get_search_title' ) ) :
/**
 * Search Page Title
*/
function travelbee_get_search_title(){
    return esc_html( get_theme_mod( 'search_title', __( 'Search Result For', 'travelbee' ) ) );
}
endif;

if( ! function_exists( 'travelbee_get_footer_copyright' ) ) :
/**
 * Footer Copyright
*/
function travelbee_get_footer_copyright(){
    $copyright = get_theme_mod( 'footer_copyright' );
    echo '<span class="copyright">';
    if( $copyright ){
        echo wp_kses_post( $copyright );
    }else{
        esc_html_e( '&copy; Copyright ', 'travelbee' );
        echo date_i18n( esc_html__( 'Y', 'travelbee' ) );
        echo ' <a href="' . esc_url( home_url( '/' ) ) . '">' . esc_html( get_bloginfo( 'name' ) ) . '</a>. ';
        esc_html_e( 'All Rights Reserved. ', 'travelbee' );
    }
    echo '</span>'; 
}
endif;

if( ! function_exists( 'travelbee_get_related_portfolio_title' ) ) :
/**
 * Portfolio Related Projects Title
*/
function travelbee_get_related_portfolio_title(){
    return esc_html( get_theme_mod( 'related_portfolio_title', __( 'Related Projects', 'travelbee' ) ) );
}
endif;
