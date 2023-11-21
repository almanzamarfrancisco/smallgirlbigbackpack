<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 * @package Travelbee
 */

get_header(); 

$error_image = get_theme_mod( '404_page_image', get_template_directory_uri() . '/images/error.png' ); ?>

<div class="error-page-top-wrapper">
    <div class="container">
        <section class="error-404 not-found">
            <div class="error-404-content-wrapper">
                <div class="error404-grid">
                    <?php if( $error_image ) { ?>
                        <figure class="error-img">
                            <img src="<?php echo esc_url( $error_image ); ?>">
                        </figure>
                    <?php } ?>
                    <div class="page-content">
                        <h1 class="page-title"><?php esc_html_e( 'Oops! Nothing Found!', 'travelbee' );?></h1>
                        <p><?php esc_html_e( 'The page you are looking for may have been moved, deleted, or possibly never existed. Go back to home and explore again.', 'travelbee' ); ?></p>
                        <a class="wc-btn wc-btn-one"
                            href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'BACK TO HOMEPAGE', 'travelbee' ); ?>
                        </a>
                        <div class="error-404-search">
                            <?php get_search_form(); ?>
                        </div>
                    </div><!-- .page-content -->
                </div>
            </div>
        </section><!-- .error-404 -->
    </div>
</div>
<div class="container">
    <div class="page-grid">
        <div id="primary" class="content-area">
            <?php
            /**
             * @see travelbee_latest_posts
            */
            do_action( 'travelbee_latest_posts' ); ?>
        </div><!-- #primary -->
    </div>
</div>
<?php    
get_footer();