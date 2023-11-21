<?php
/**
 * Travelbee Newsletter Functions.
 *
 * @package Travelbee
 */

if( ! function_exists( 'travelbee_add_inner_div' ) ) :
    function travelbee_add_inner_div(){
        return true;
    }
endif;
add_filter( 'bt_newsletter_widget_inner_wrap_display', 'travelbee_add_inner_div' );

if( ! function_exists( 'travelbee_start_inner_div' ) ) :
    function travelbee_start_inner_div(){
        echo '<div class="container">';
    }
endif;
add_action( 'bt_newsletter_widget_inner_wrap_start', 'travelbee_start_inner_div' );

if( ! function_exists( 'travelbee_end_inner_div' ) ) :
    function travelbee_end_inner_div(){
        echo '</div>';
    }
endif;
add_action( 'bt_newsletter_widget_inner_wrap_close', 'travelbee_end_inner_div' );

if( ! function_exists( 'travelbee_shortcode_add_inner_div' ) ) :
    function travelbee_shortcode_add_inner_div(){
        return true;
    }
endif;
add_filter( 'bt_newsletter_shortcode_inner_wrap_display', 'travelbee_shortcode_add_inner_div' );

if( ! function_exists( 'travelbee_shortcode_start_inner_div' ) ) :
    function travelbee_shortcode_start_inner_div(){
        echo '<div class="container">';
    }
endif;
add_action( 'bt_newsletter_shortcode_inner_wrap_start', 'travelbee_shortcode_start_inner_div' );

if( ! function_exists( 'travelbee_shortcode_end_inner_div' ) ) :
    function travelbee_shortcode_end_inner_div(){
        echo '</div>';
    }
endif;
add_action( 'bt_newsletter_shortcode_inner_wrap_close', 'travelbee_shortcode_end_inner_div' );