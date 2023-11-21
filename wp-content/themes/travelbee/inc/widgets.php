<?php
/**
 * Travelbee Widget Areas
 * 
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 * @package Travelbee
 */

function travelbee_widgets_init(){    
    $sidebars = array(
        'sidebar'   => array(
            'name'        => __( 'Sidebar', 'travelbee' ),
            'id'          => 'sidebar', 
            'description' => __( 'Default Sidebar', 'travelbee' ),
        ),
        'about'   => array(
            'name'        => __( 'About Section', 'travelbee' ),
            'id'          => 'about', 
            'description' => __( 'Add "Rara: Featured Page" widget for about section.', 'travelbee' ),
        ),
        'featured'   => array(
            'name'        => __( 'Featured Area Section', 'travelbee' ),
            'id'          => 'featured', 
            'description' => __( 'Add "Rara: Image Text" widget for featured area section', 'travelbee' ),
        ),
        'footer-one'=> array(
            'name'        => __( 'Footer One', 'travelbee' ),
            'id'          => 'footer-one', 
            'description' => __( 'Add footer one widgets here.', 'travelbee' ),
        ),
        'footer-two'=> array(
            'name'        => __( 'Footer Two', 'travelbee' ),
            'id'          => 'footer-two', 
            'description' => __( 'Add footer two widgets here.', 'travelbee' ),
        ),
        'footer-three'=> array(
            'name'        => __( 'Footer Three', 'travelbee' ),
            'id'          => 'footer-three', 
            'description' => __( 'Add footer three widgets here.', 'travelbee' ),
        ),
        'footer-four'=> array(
            'name'        => __( 'Footer Four', 'travelbee' ),
            'id'          => 'footer-four', 
            'description' => __( 'Add footer four widgets here.', 'travelbee' ),
        )
    );
    
    foreach( $sidebars as $sidebar ){
        register_sidebar( array(
    		'name'          => esc_html( $sidebar['name'] ),
    		'id'            => esc_attr( $sidebar['id'] ),
    		'description'   => esc_html( $sidebar['description'] ),
    		'before_widget' => '<section id="%1$s" class="widget %2$s">',
    		'after_widget'  => '</section>',
    		'before_title'  => '<h2 class="widget-title" itemprop="name">',
    		'after_title'   => '</h2>',
    	) );
    }
    
}
add_action( 'widgets_init', 'travelbee_widgets_init' );