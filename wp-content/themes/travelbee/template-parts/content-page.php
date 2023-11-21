<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Travelbee
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php
        /**
         * Post Thumbnail
         * 
         * @hooked travelbee_post_thumbnail
        */
        do_action( 'travelbee_before_page_entry_content' );
    
        /**
         * Entry Content
         * 
         * @hooked travelbee_entry_content - 15
         * @hooked travelbee_entry_footer  - 20
        */
        do_action( 'travelbee_page_entry_content' );    
    ?>
</article><!-- #post-<?php the_ID(); ?> -->
