<?php
/**
 * Active Callback
 * 
 * @package Travelbee
*/


/**
 * Active Callback for Banner Slider
*/
function travelbee_banner_ac( $control ){
    $banner        = $control->manager->get_setting( 'ed_banner_section' )->value();
    $slider_type   = $control->manager->get_setting( 'slider_type' )->value();
    $control_id    = $control->id;
    
    if ( $control_id == 'header_image' &&  $banner == 'static_banner' ) return true;
    if ( $control_id == 'header_video' &&  $banner == 'static_banner' )return true;
    if ( $control_id == 'external_header_video' && $banner == 'static_banner' ) return true;
    if ( $control_id == 'banner_title' && $banner == 'static_banner' ) return true;
    if ( $control_id == 'banner_description' && $banner == 'static_banner' ) return true;
    if ( $control_id == 'button_one_label' && $banner == 'static_banner' ) return true;
    if ( $control_id == 'button_one_link' && $banner == 'static_banner' ) return true;
    if ( $control_id == 'button_two_label' && $banner == 'static_banner' ) return true;
    if ( $control_id == 'button_two_link' && $banner == 'static_banner' ) return true;
    if ( $control_id == 'banner_new_tab' && $banner == 'static_banner' ) return true;
    if ( $control_id == 'banner_new_tab_two' && $banner == 'static_banner' ) return true;
    if ( $control_id == 'banner_caption_layout' &&  $banner == 'static_banner' )return true;
    
    if ( $control_id == 'slider_type' && $banner == 'slider_banner' ) return true;
    if ( $control_id == 'include_repetitive_posts' && $banner == 'slider_banner' && ( $slider_type == 'latest_posts' || $slider_type == 'cat' ) ) return true;
    if ( $control_id == 'slider_auto' && $banner == 'slider_banner' ) return true;
    if ( $control_id == 'slider_loop' && $banner == 'slider_banner' ) return true;
    if ( $control_id == 'slider_caption' && $banner == 'slider_banner' ) return true;          
    if ( $control_id == 'slider_readmore' && $banner == 'slider_banner' ) return true;    
    if ( $control_id == 'slider_cat' && $banner == 'slider_banner' && $slider_type == 'cat' ) return true;
    if ( $control_id == 'no_of_slides' && $banner == 'slider_banner' && $slider_type == 'latest_posts' ) return true;
    if ( $control_id == 'slider_animation' && $banner == 'slider_banner' ) return true;
    if ( $control_id == 'slider_speed' && $banner == 'slider_banner' ) return true;
    if ( $control_id == 'banner_hr' && $banner == 'slider_banner' ) return true;
    return false;
}


if( ! function_exists( 'travelbee_about_sec_ac' ) ) :
    /**
     * Active Callback for About Section
    */
    function travelbee_about_sec_ac( $control ){
        $about_bg_type = $control->manager->get_setting( 'about_bg' )->value();
        $control_id   = $control->id;
        
        if( $control_id == 'about_bg_image' && $about_bg_type == 'image' ) return true;
        if( $control_id == 'about_bg_color' && $about_bg_type == 'color' ) return true;
        
        return false;
    }
endif;

if( ! function_exists( 'travelbee_shop_sec_ac' ) ) :
    /**
     * Active Callback for Shop Section
    */
    function travelbee_shop_sec_ac( $control ){
        $ed_section   = $control->manager->get_setting( 'ed_shop_section' )->value();
        $shop_bg_type = $control->manager->get_setting( 'shop_bg' )->value();
        $product_type = $control->manager->get_setting( 'product_type' )->value();
        $control_id   = $control->id;
        
        if( $control_id == 'shop_bg' && $ed_section ) return true;
        if( $control_id == 'shop_section_title' && $ed_section ) return true;
        if( $control_id == 'shop_section_content' && $ed_section ) return true;
        if( $control_id == 'product_type' && $ed_section ) return true;
        if( $control_id == 'shop_btn_lbl' && $ed_section ) return true;
        if( $control_id == 'shop_btn_link' && $ed_section ) return true;
        if( $control_id == 'shop_bg_image' && $shop_bg_type == 'image' && $ed_section ) return true;
        if( $control_id == 'shop_bg_color' && $shop_bg_type == 'color' && $ed_section ) return true;
        if( $control_id == 'selected_products' && $product_type == 'custom' && $ed_section ) return true;
        
        return false;
    }
endif;

/**
 * Active Callback for post/page
*/
function travelbee_post_page_ac( $control ){
    
    $ed_related    = $control->manager->get_setting( 'ed_related' )->value();
    $ed_comment    = $control->manager->get_setting( 'ed_comments' )->value();
    $control_id    = $control->id;
    
    if ( $control_id == 'related_post_title' && $ed_related == true ) return true;
    if ( $control_id == 'toggle_comments' && $ed_comment == true ) return true;
    return false;
}

/**
 * Active Callback for CTA section
*/
function travelbee_cta_ac( $control ){
    $ed_section = $control->manager->get_setting( 'ed_cta_sec' )->value();
    
    if( $ed_section ) return true;
    
    return false;
}

/**
 * Active Callback for local fonts
*/
function travelbee_ed_localgoogle_fonts(){
    $ed_localgoogle_fonts = get_theme_mod( 'ed_localgoogle_fonts' , false );

    if( $ed_localgoogle_fonts ) return true;
    
    return false; 
}

/**
 * Active Callback for instagram
*/
function travelbee_instagram_ac( $control ){

    $ed_insta   = $control->manager->get_setting( 'ed_instagram' )->value();
    $control_id = $control->id;

    if ( $control_id == 'instagram_shortcode' && $ed_insta ) return true;

    return false;
}