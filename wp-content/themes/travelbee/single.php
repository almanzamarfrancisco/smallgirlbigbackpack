<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Travelbee
 */

get_header(); 
?>
<div class="page-grid">
        <div id="primary" class="content-area">
                <main id="main" class="site-main">

                <?php
                while ( have_posts() ) : the_post();

                	get_template_part( 'template-parts/content', 'single' );

                endwhile; // End of the loop.
                ?>

                </main><!-- #main -->

                <?php
                /**
                 * @hooked travelbee_newsletter           - 20
                 * @hooked travelbee_author               - 25
                 * @hooked travelbee_navigation           - 30
                 * @hooked travelbee_related_posts        - 35
                 * @hooked travelbee_comment              - 45
                */
                do_action( 'travelbee_after_post_content' );
                ?>

        </div><!-- #primary -->

        <?php
        get_sidebar();
echo '</div>';

get_footer();
