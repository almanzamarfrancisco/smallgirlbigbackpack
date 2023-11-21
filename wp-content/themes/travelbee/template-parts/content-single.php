<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Travelbee
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php 
        /**
         * @hooked travelbee_single_post_content   - 15 
        */
        do_action( 'travelbee_single_post_content' );
    
        /**
         * @hooked travelbee_entry_content - 15
         * @hooked travelbee_entry_footer  - 20
        */
        do_action( 'travelbee_post_entry_content' );
    ?>
</article><!-- #post-<?php the_ID(); ?> -->
