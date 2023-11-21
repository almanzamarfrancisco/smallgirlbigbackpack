<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Travelbee
 */
    /**
     * Doctype Hook
     * 
     * @hooked travelbee_doctype
    */
    do_action( 'travelbee_doctype' );
?>
<head itemscope itemtype="https://schema.org/WebSite">
	<?php 
    /**
     * Before wp_head
     * 
     * @hooked travelbee_head
    */
    do_action( 'travelbee_before_wp_head' );
    
    wp_head(); ?>
</head>

<body <?php body_class(); ?> itemscope itemtype="https://schema.org/WebPage">

<?php
    wp_body_open();
    
    /**
     * Before Header
     * 
     * @hooked travelbee_page_start - 20 
    */
    do_action( 'travelbee_before_header' );
    
    /**
     * Header
     * 
     * @hooked travelbee_header               - 20     
    */
    do_action( 'travelbee_header' );
    
    /**
     * Before Content
     * 
     * @hooked travelbee_banner             - 15
     * @hooked travelbee_featured_section    - 25
     * @hooked travelbee_about_section      -30
    */
    do_action( 'travelbee_after_header' );
    
    /**
     * Content
     * 
     * @hooked travelbee_content_start
    */
    do_action( 'travelbee_content' );