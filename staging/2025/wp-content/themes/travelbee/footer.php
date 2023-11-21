<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Travelbee
 */
    
    /**
     * After Content
     * 
     * @hooked travelbee_content_end - 20
    */
    do_action( 'travelbee_before_footer' );

    /**
     * Before Footer
     * 
     * @hooked travelbee_shop_section  - 10
     * @hooked travelbee_cta_section          - 20
     * @hooked travelbee_footer_newsletter    - 30
    */
    do_action( 'travelbee_footer_start' );
    
    /**
     * Footer
     * @hooked travelbee_footer_instagram_section - 15
     * @hooked travelbee_footer_start             - 20
     * @hooked travelbee_footer_top               - 30
     * @hooked travelbee_footer_bottom            - 40
     * @hooked travelbee_footer_end               - 50
    */
    do_action( 'travelbee_footer' );
    
    /**
     * After Footer
     * 
     * @hooked travelbee_back_to_top - 15
     * @hooked travelbee_page_end    - 20
    */
    do_action( 'travelbee_after_footer' );

    wp_footer(); ?>

</body>
</html>
