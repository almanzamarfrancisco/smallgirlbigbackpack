<?php
/**
 * Travelbee Template Functions which enhance the theme by hooking into WordPress
 *
 * @package Travelbee
 */

if( ! function_exists( 'travelbee_doctype' ) ) :
/**
 * Doctype Declaration
*/
function travelbee_doctype(){ ?>
    <!DOCTYPE html>
    <html <?php language_attributes(); ?>>
    <?php
}
endif;
add_action( 'travelbee_doctype', 'travelbee_doctype' );

if( ! function_exists( 'travelbee_head' ) ) :
/**
 * Before wp_head 
*/
function travelbee_head(){ ?>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <?php
}
endif;
add_action( 'travelbee_before_wp_head', 'travelbee_head' );

if( ! function_exists( 'travelbee_page_start' ) ) :
/**
 * Page Start
*/
function travelbee_page_start(){ ?>
    <div id="page" class="site">
        <a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content (Press Enter)', 'travelbee' ); ?></a>
    <?php
}
endif;
add_action( 'travelbee_before_header', 'travelbee_page_start', 20 );

if( ! function_exists( 'travelbee_header' ) ) :
/**
 * Header Start
*/
function travelbee_header(){ ?>
    <header id="masthead" class="site-header style-one" itemscope itemtype="http://schema.org/WPHeader">
        <?php travelbee_sticky_header();?>
        <div class="header-top">
            <div class="container">
                <div class="header-left">
                    <?php travelbee_social_links(); ?>
                </div>
                <div class="header-main">
                    <?php travelbee_primary_nagivation(); ?>
                </div>
                <div class="header-right">
                    <?php 
                        travelbee_header_cart(); 
                        travelbee_search();
                    ?>
                </div>
            </div>
        </div>
        <div class="header-middle">
            <div class="container">
                <?php travelbee_site_branding(); ?>
            </div>
        </div>
        <?php 
            travelbee_mobile_navigation();  
        ?>
    </header>
    <?php
}
endif;
add_action( 'travelbee_header', 'travelbee_header', 20 );

if( ! function_exists( 'travelbee_banner' ) ) :
/**
 * Banner Section 
*/
function travelbee_banner(){
    if( is_front_page() || is_home() ) travelbee_get_banner( );   
}
endif;
add_action( 'travelbee_after_header', 'travelbee_banner', 15 );

if( ! function_exists( 'travelbee_featured_section') ):
    /**
     * Featured Section
     */
    function travelbee_featured_section(){
        if( is_front_page() && is_active_sidebar( 'featured' ) ){ ?>
        <section id="featured-section" class="featured-section section">
            <div class="container">
                <div class="featured-wrapper">
                    <?php dynamic_sidebar( 'featured' ); ?>
                </div>
            </div>
        </section><!-- .featured-section -->
        <?php
        }
    }
    endif;
    add_action('travelbee_after_header', 'travelbee_featured_section', 25);

if( ! function_exists( 'travelbee_about_section') ):
/**
 * About Section
 */
function travelbee_about_section(){
    $about_bg_type  = get_theme_mod( 'about_bg', 'color' );
    $about_bg_image = get_theme_mod( 'about_bg_image' );

    if( is_front_page() && is_active_sidebar( 'about' ) ){ ?>
    <section id="about-section" class="about-section section" <?php if( $about_bg_image && $about_bg_type == 'image' ) echo 'style="background: url(' . esc_url( $about_bg_image ) . '); background-size: cover; background-repeat: no-repeat; background-position: center;"'; ?>>
        <div class="container">
            <div class="about-wrapper">
                <?php dynamic_sidebar( 'about' ); ?>
            </div>
        </div>
    </section><!-- .about-section -->
    <?php
    }
}
endif;
add_action('travelbee_after_header', 'travelbee_about_section', 30);

if( ! function_exists( 'travelbee_content_start' ) ) :
/**
 * Content Start
 * 
*/
function travelbee_content_start(){      
    $page_header_image  = get_theme_mod( 'page_header_image' ); 

    if ( $page_header_image ) {
       $class = 'header-bg-image'; 
    }else{
        $class = 'no-header-bg-image';
    }

    if( ! ( is_front_page() && is_home() ) ) echo '<div id="content" class="site-content">';
    
    if( ! is_front_page() ){ ?>
        <div class="page-header <?php if( is_archive() && ! is_author() ) echo esc_attr( $class ); ?>" <?php if( $page_header_image && is_archive() && ! is_author() ) echo 'style="background: url('.esc_url($page_header_image).'); background-size: cover; background-repeat: no-repeat; background-position: center;"'; ?>>

            <div class="container">
                <?php 
                    travelbee_breadcrumb(); 
                    if( is_archive() && ! is_author() ) the_archive_title( '<div class="page-title-wrapper">', '</div>');          
                    if( is_page() ) the_title( '<h1 class="page-title">', '</h1>' );          
                
                    if( is_search() ){ 
                        $search_title = get_theme_mod( 'search_title', __( 'Search Result For', 'travelbee' ) );
                        global $wp_query;
                        echo '<div class = "search-wrapper">';
                        if ($search_title) echo '<span>' . esc_html( $search_title) . '</span>';
                        get_search_form();
                        echo '</div>'; 
            
                        if( $wp_query->found_posts > 0 ) {
                            $posts_per_page = get_option( 'posts_per_page' );
                            $paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;
                            $start_post_number = 0;
                            $end_post_number   = 0;
            
                            if( $wp_query->found_posts > 0 ):                
                                $start_post_number = 1;
                                if( $wp_query->found_posts < $posts_per_page  ) {
                                    $end_post_number = $wp_query->found_posts;
                                }else{
                                    $end_post_number = $posts_per_page;
                                }
            
                                if( $paged > 1 ){
                                    $start_post_number = $posts_per_page * ( $paged - 1 ) + 1;
                                    if( $wp_query->found_posts < ( $posts_per_page * $paged )  ) {
                                        $end_post_number = $wp_query->found_posts;
                                    }else{
                                        $end_post_number = $paged * $posts_per_page;
                                    }
                                }
            
                                printf( esc_html__( '%1$s Showing: %2$s - %3$s of %4$s Articles %5$s', 'travelbee' ), '<span class="result-count">', absint( $start_post_number ), absint( $end_post_number ), esc_html( number_format_i18n( $wp_query->found_posts ) ), '</span>' );
                            endif;
                        }
                    }
                ?>
            </div>
        </div>

        <?php
        if( is_author() ){ ?>
            <div class="author-section">
                <div class="container">
                <figure class="author-img"><?php echo get_avatar( get_the_author_meta( 'ID' ), 95 ); ?></figure>
                <div class="author-content-wrap">
                    <div class="author-title-wrap">
                        <?php if ( get_the_author_meta( 'display_name' ) ) { ?>
                            <div class="author-name-holder">
                                <?php echo '<h3 class="author-name">' . esc_html( get_the_author() ) . '</h3>'; ?>
                            </div>
                        <?php } ?>
                        <?php if ( get_the_author_meta( 'description' ) ) { ?>
                            <div class="author-content">
                                <?php echo wp_kses_post( wpautop( get_the_author_meta( 'description' ) ) ); ?>
                            </div>  
                        <?php } ?>               
                    </div>   
                </div>
            </div> 
                </div>
        <?php }
    }  
    if( ! ( is_front_page() && is_home() ) && ! is_404() ) echo '<div class="container">';
}
endif;
add_action( 'travelbee_content', 'travelbee_content_start' );

if ( ! function_exists( 'travelbee_post_thumbnail' ) ) :
/**
 * Displays an optional post thumbnail.
 *
 * Wraps the post thumbnail in an anchor element on index views, or a div
 * element when on single views.
 */
function travelbee_post_thumbnail() {
	
    $ed_crop_blog   = get_theme_mod( 'ed_crop_blog', false );
    $sidebar        = travelbee_sidebar();
    
    if( is_home() ){        
        $image_size = ( $sidebar ) ? 'travelbee-with-sidebar' : 'travelbee-blog-home';
        echo '<figure class="post-thumbnail"><a href="' . esc_url( get_permalink() ) . '">';                        
            if( has_post_thumbnail() ){
                if( $ed_crop_blog ){
                    the_post_thumbnail( 'full', array( 'itemprop' => 'image' ) );    
                }else{
                    the_post_thumbnail( $image_size, array( 'itemprop' => 'image' ) );    
                }
            }else{
                travelbee_get_fallback_svg( $image_size );//fallback 
            }        
        echo '</a></figure>'; 
    }elseif( is_archive() || is_search() ){
        $image_size = ( $sidebar ) ? 'travelbee-with-sidebar' : 'travelbee-blog-home';
        echo '<figure class="post-thumbnail"><a href="' . esc_url( get_permalink() ) . '">';
        if( has_post_thumbnail() ){
            if( $ed_crop_blog ){
                the_post_thumbnail( 'full', array( 'itemprop' => 'image' ) );    
            }else{
                the_post_thumbnail( $image_size, array( 'itemprop' => 'image' ) );    
            }
        }else{
            travelbee_get_fallback_svg( $image_size );//fallback
        }
        echo '</a></figure>';
    }elseif( is_singular() ){
        $image_size = ( $sidebar ) ? 'travelbee-with-sidebar' : 'travelbee-slider';
        if( has_post_thumbnail() ){
            echo '<div class="post-thumbnail">';
            the_post_thumbnail( $image_size, array( 'itemprop' => 'image' ) );
            echo '</div>';    
        }            
    }
}
endif;
add_action( 'travelbee_before_page_entry_content', 'travelbee_post_thumbnail' );
add_action( 'travelbee_before_post_entry_content', 'travelbee_post_thumbnail', 15 );

if( ! function_exists( 'travelbee_page_header' ) ) :
/**
 * Content Start
 *   
*/
function travelbee_page_header(){ 
    if ( is_home() ){ 
        $blog_text    = get_theme_mod( 'blog_text', __( 'Latest Articles', 'travelbee' ) );
        if( $blog_text ){
            echo '<header class="section-header">';
            echo '<h2 class="section-title blog-title">' . esc_html( $blog_text) . '</h2>';
            echo '</header>';
        }
    }
}
endif;
add_action( 'travelbee_before_posts_content', 'travelbee_page_header', 10 );


if( ! function_exists( 'travelbee_entry_header' ) ) :
/**
 * Entry Header
*/
function travelbee_entry_header(){ ?>
    <div class="content-wrapper">
        <header class="entry-header">
            <?php 
                $ed_cat_single  = get_theme_mod( 'ed_category', false );

                if( ! $ed_cat_single ) travelbee_category();

                if( is_home() ){
                    the_title( '<h3 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' );
                } else {
                    the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
                }

                if( 'post' === get_post_type() ){
                    echo '<div class="entry-meta">';
                    travelbee_posted_on();
                    echo '</div>';
                }       
            ?>
        </header>   
    <?php    
}
endif;
add_action( 'travelbee_before_post_entry_content', 'travelbee_entry_header', 20 );

if ( ! function_exists( 'travelbee_single_post_content' )) :
/**
* Single Post Content.
*/
function travelbee_single_post_content(){ 
    $ed_post_date       = get_theme_mod( 'ed_post_date', false ); ?>
    <div class="content-wrap">
        <header class="entry-header">
            <?php 
                $ed_cat_single  = get_theme_mod( 'ed_category', false );
                
                if( ! $ed_cat_single ) {
                    echo '<div class="entry-meta">'; 
                    travelbee_category();
                    echo '</div>'; 
                }

                the_title( '<h1 class="entry-title">', '</h1>' ); 
            
                echo '<div class="entry-meta">';
                if( !$ed_post_date )travelbee_posted_on();
                travelbee_comment_count();
                echo '</div>';     
            ?>
        </header>      
        <?php  travelbee_post_thumbnail();
        
}
endif;
add_action( 'travelbee_single_post_content', 'travelbee_single_post_content', 15 );

if( ! function_exists( 'travelbee_entry_content' ) ) :
/**
 * Entry Content
*/
function travelbee_entry_content(){ 
    $ed_excerpt          = get_theme_mod( 'ed_excerpt', true );

    if ( is_single() ) {
        echo '<div class="article-wrapper"><div class="inner-content-wrap">';
        travelbee_article_meta();
        echo '</div>';
    }

    if( is_singular() || ! $ed_excerpt || ( get_post_format() != false ) ){
        echo '<div class="entry-content" itemprop="text">';
        the_content();    
        wp_link_pages( array(
            'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'travelbee' ),
            'after'  => '</div>',
        ) );
        echo '</div><!-- .entry-content -->';
    }
}
endif;
add_action( 'travelbee_page_entry_content', 'travelbee_entry_content', 15 );
add_action( 'travelbee_post_entry_content', 'travelbee_entry_content', 15 );

if( ! function_exists( 'travelbee_entry_footer' ) ) :
/**
 * Entry Footer
*/
function travelbee_entry_footer(){ ?>
    <footer class="entry-footer">
        <?php
            if( is_single() ) travelbee_tag();
            
            if( get_edit_post_link() ){
                edit_post_link(
                    sprintf(
                        wp_kses(
                            /* translators: %s: Name of current post. Only visible to screen readers */
                            __( 'Edit <span class="screen-reader-text">%s</span>', 'travelbee' ),
                            array(
                                'span' => array(
                                    'class' => array(),
                                ),
                            )
                        ),
                        get_the_title()
                    ),
                    '<span class="edit-link">',
                    '</span>'
                );
            }
        ?>
    </footer><!-- .entry-footer -->
    <?php
    if ( is_single() ) echo '</div><!-- .content-wrap -->';
    if( ! is_singular() ) echo '</div><!-- .content-wrapper -->';
}
endif;
add_action( 'travelbee_page_entry_content', 'travelbee_entry_footer', 20 );
add_action( 'travelbee_post_entry_content', 'travelbee_entry_footer', 20 );


if( ! function_exists( 'travelbee_newsletter' ) ) :
/**
 * Newsletter
*/
function travelbee_newsletter(){ 
    $ed_newsletter = get_theme_mod( 'ed_newsletter', false );
    $newsletter    = get_theme_mod( 'newsletter_shortcode' );
    if( $ed_newsletter && $newsletter ){ ?>
        <div class="newsletter">
            <?php echo do_shortcode( $newsletter ); ?>
        </div>
        <?php
    }
}
endif;
add_action( 'travelbee_after_post_content', 'travelbee_newsletter', 20 );

if( ! function_exists( 'travelbee_author' ) ) :
/**
 * Author Section
*/
function travelbee_author(){ 
    $ed_author    = get_theme_mod( 'ed_author', false );
    $author_title = get_theme_mod( 'author_title', __( 'About Author', 'travelbee' ) );
    if( ! $ed_author && get_the_author_meta( 'description' ) ){ ?>
        <div class="author-section">
            <div class="inner-author-section">
                <div class="author-img-title-wrap">
                    <figure class="author-img">
                        <?php echo get_avatar( get_the_author_meta( 'ID' ), 95 ); ?>
                    </figure>
                    <div class="author-content">
                        <div class="author-title-wrap">
                            <?php 
                                if( $author_title ) echo '<h5 class="title">' . esc_html( $author_title ) . '</h5>'; 
                                travelbee_posted_by(); 
                            ?>
                        </div>
                        <?php echo wp_kses_post( wpautop( get_the_author_meta( 'description' ) ) ); ?>
                    </div>
                </div>
            </div>
        </div> <?php 
    }
}
endif;
add_action( 'travelbee_after_post_content', 'travelbee_author', 25 );

if( ! function_exists( 'travelbee_navigation' ) ) :
/**
 * Navigation
*/
function travelbee_navigation(){
    if( is_single() ){
        $previous = get_previous_post_link(
            '<div class="nav-previous nav-holder">%link</div>',
            '<span class="meta-nav">' . esc_html__( 'Previous Article', 'travelbee' ) . '</span><span class="post-title">%title</span>',
            false,
            '',
            'category'
        );
    
        $next = get_next_post_link(
            '<div class="nav-next nav-holder">%link</div>',
            '<span class="meta-nav">' . esc_html__( 'Next Article', 'travelbee' ) . '</span><span class="post-title">%title</span>',
            false,
            '',
            'category'
        ); 
        
        if( $previous || $next ){?>            
            <nav class="navigation post-navigation" role="navigation">
                <h2 class="screen-reader-text"><?php esc_html_e( 'Post Navigation', 'travelbee' ); ?></h2>
                <div class="nav-links">
                    <?php
                        if( $previous ) echo $previous;
                        if( $next ) echo $next;
                    ?>
                </div>
            </nav>        
            <?php
        }
    }else{
        the_posts_pagination( array(
            'prev_text'          => __( 'Previous', 'travelbee' ),
            'next_text'          => __( 'Next', 'travelbee' ),
            'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'travelbee' ) . ' </span>',
        ) );
    }
}
endif;
add_action( 'travelbee_after_post_content', 'travelbee_navigation', 30 );
add_action( 'travelbee_after_posts_content', 'travelbee_navigation' );

if( ! function_exists( 'travelbee_related_posts' ) ) :
/**
 * Related Posts 
*/
function travelbee_related_posts(){ 
    $ed_related_post = get_theme_mod( 'ed_related', true );
    
    if( $ed_related_post ){
        travelbee_get_posts_list( 'related' );    
    }
}
endif;                                                                               
add_action( 'travelbee_after_post_content', 'travelbee_related_posts', 35 );

if( ! function_exists( 'travelbee_latest_posts' ) ) :
/**
 * Latest Posts
*/
function travelbee_latest_posts(){ 
    travelbee_get_posts_list( 'latest' );
}
endif;
add_action( 'travelbee_latest_posts', 'travelbee_latest_posts' );

if( ! function_exists( 'travelbee_comment' ) ) :
/**
 * Comments Template 
*/
function travelbee_comment(){
    // If comments are open or we have at least one comment, load up the comment template.
	if( get_theme_mod( 'ed_comments', true ) && ( comments_open() || get_comments_number() ) ) :
		comments_template();
	endif;
}
endif;
add_action( 'travelbee_after_post_content', 'travelbee_comment', travelbee_comment_toggle() );
add_action( 'travelbee_after_page_content', 'travelbee_comment' );

if( ! function_exists( 'travelbee_content_end' ) ) :
/**
 * Content End
*/
function travelbee_content_end(){ 
        if( ! ( is_front_page() && is_home() ) && ! is_404() ) echo '</div>'; //.container      
    if( ! ( is_front_page() && is_home() ) ) echo '</div>'; // .error-holder/site-content
}
endif;
add_action( 'travelbee_before_footer', 'travelbee_content_end', 20 );

if( ! function_exists( 'travelbee_footer_instagram_section' ) ) :
/**
 * Bottom Shop Section
*/
function travelbee_footer_instagram_section(){
    
    $ed_instagram = get_theme_mod( 'ed_instagram', false );
    $insta_code   = get_theme_mod('instagram_shortcode', '[instagram-feed]' );
    if( $ed_instagram ){
        echo '<div class="instagram-section">';
        echo do_shortcode( $insta_code );
        echo '</div>';    
    }
}
endif;
add_action( 'travelbee_footer', 'travelbee_footer_instagram_section', 15 );

if( ! function_exists( 'travelbee_footer_start' ) ) :
/**
 * Footer Start
*/
function travelbee_footer_start(){
    ?>
    <footer id="colophon" class="site-footer" itemscope itemtype="http://schema.org/WPFooter">
    <?php
}
endif;
add_action( 'travelbee_footer', 'travelbee_footer_start', 20 );

if( ! function_exists( 'travelbee_footer_top' ) ) :
/**
 * Footer Top
*/
function travelbee_footer_top(){    
    $footer_sidebars = array( 'footer-one', 'footer-two', 'footer-three', 'footer-four' );
    $active_sidebars = array();
    $sidebar_count   = 0;
    
    foreach ( $footer_sidebars as $sidebar ) {
        if( is_active_sidebar( $sidebar ) ){
            array_push( $active_sidebars, $sidebar );
            $sidebar_count++ ;
        }
    }
                 
    if( $active_sidebars ){ ?>
        <div class="footer-t">
    		<div class="container">
    			<div class="grid column-<?php echo esc_attr( $sidebar_count ); ?>">
                <?php foreach( $active_sidebars as $active ){ ?>
    				<div class="col">
    				   <?php dynamic_sidebar( $active ); ?>	
    				</div>
                <?php } ?>
                </div>
    		</div>
    	</div>
        <?php 
    }   
}
endif;
add_action( 'travelbee_footer', 'travelbee_footer_top', 30 );

if( ! function_exists( 'travelbee_footer_bottom' ) ) :
/**
 * Footer Bottom
*/
function travelbee_footer_bottom(){ ?>
    <div class="footer-b">
		<div class="container">
            <div class="footer-bottom-t">
                <?php 
                travelbee_footer_navigation();
                travelbee_social_links(); ?>
            </div>
			<div class="site-info">            
                <?php
                    travelbee_get_footer_copyright();
                    esc_html_e( ' Travelbee | Developed By ', 'travelbee' );
                    echo '<span class="author-link"><a href="' . esc_url( 'https://rarathemes.com/' ) .'" rel="nofollow" target="_blank">' . esc_html__( 'Rara Themes', 'travelbee' ) . '</a></span>.';
                    printf( esc_html__( '%1$s Powered by %2$s%3$s.', 'travelbee' ), '<span class="wp-link">', '<a href="'. esc_url( __( 'https://wordpress.org/', 'travelbee' ) ) .'" target="_blank">WordPress</a>', '</span>' );
                    if ( function_exists( 'the_privacy_policy_link' ) ) {
                        the_privacy_policy_link();
                    }
                ?>           
            </div>
		</div>
	</div>
    <?php
}
endif;
add_action( 'travelbee_footer', 'travelbee_footer_bottom', 40 );

if( ! function_exists( 'travelbee_footer_end' ) ) :
/**
 * Footer End 
*/
function travelbee_footer_end(){ ?>
    </footer><!-- #colophon -->
    <?php
}
endif;
add_action( 'travelbee_footer', 'travelbee_footer_end', 50 );

if( ! function_exists( 'travelbee_back_to_top' ) ) :
/**
 * Back to top
*/
function travelbee_back_to_top(){ ?>
    <button class="back-to-top">
        <svg xmlns="http://www.w3.org/2000/svg" width="14.307" height="19.619" viewBox="0 0 14.307 19.619">
            <g id="Group_1451" data-name="Group 1451" transform="translate(-652.772 -8962.446)">
                <path id="Path_5886" data-name="Path 5886" d="M0,0C.671,2.506,1.613,4.818,6.474,5.936" transform="translate(653.997 8970.118) rotate(-90)" fill="none" stroke="%23fff" stroke-linecap="round" stroke-width="2"/>
                <path id="Path_5887" data-name="Path 5887" d="M0,5.936C.671,3.43,1.613,1.118,6.474,0" transform="translate(659.918 8970.118) rotate(-90)" fill="none" stroke="%23fff" stroke-linecap="round" stroke-width="2"/>
                <path id="Path_5888" data-name="Path 5888" d="M0,0H17.422" transform="translate(659.697 8981.065) rotate(-90)" fill="none" stroke="%23fff" stroke-linecap="round" stroke-width="2"/>
            </g>
        </svg>
    </button><!-- .back-to-top -->
    <?php
}
endif;
add_action( 'travelbee_after_footer', 'travelbee_back_to_top', 15 );

if( ! function_exists( 'travelbee_page_end' ) ) :
/**
 * Page End
*/
function travelbee_page_end(){ ?>
    </div><!-- #page -->
    <?php
}
endif;
add_action( 'travelbee_after_footer', 'travelbee_page_end', 20 );


if( ! function_exists( 'travelbee_shop_section' ) ) :
/**
 * Shop Section
 * 
*/
function travelbee_shop_section(){ 
    
    $ed_shop_section = get_theme_mod( 'ed_shop_section', false );
    $section_title   = get_theme_mod( 'shop_section_title', __( 'Shop', 'travelbee' ) );
    $section_content = get_theme_mod( 'shop_section_content' );
    $product_type    = get_theme_mod( 'product_type' );
    $custom_product  = get_theme_mod( 'selected_products' );
    $button_lbl      = get_theme_mod( 'shop_btn_lbl', __( 'Go To Shop', 'travelbee' ) );
    $button_link     = get_theme_mod( 'shop_btn_link' );
    $add_class       = get_theme_mod( 'shop_bg' ) === 'image' ? ' bg-image' : '';

    if( is_front_page() && travelbee_is_woocommerce_activated() && $ed_shop_section ){ 
        
        $args = array(
            'post_type'      => 'product',
            'post_status'    => 'publish',
            'posts_per_page' => 4
        );
        
        if( $product_type == 'custom' ){
            $args['post__in'] = $custom_product;
        }elseif( $product_type == 'popular-products' ){
            $args['meta_key'] = 'total_sales';
            $args['order_by'] = 'meta_value_num';
        }elseif( $product_type == 'sale-products' ){
            $args['meta_query'] = WC()->query->get_meta_query();
            $args['post__in']   =  wc_get_product_ids_on_sale();
        }else{
            $args['orderby']     = 'date';
            $args['order']       = 'DESC';
        }

        $qry = new WP_Query( $args );
        
        if( $qry->have_posts() || $section_title || $section_content ){ ?>
            <div class="product-section section<?php echo esc_attr( $add_class ); ?>" id="product-section">
                <div class="product-section-wrapper">
                    <?php if( $section_title || $section_content ){ ?>
                        <header class="section-header">
                            <div class="container">
                                <?php
                                    if( $section_title ) echo '<h2 class="section-title">' . esc_html( $section_title ) . '</h2>';
                                    if( $section_content ) echo '<div class="section-desc">' . esc_html( $section_content )  . '</div>';
                                ?>
                            </div>
                        </header>
                    <?php } ?>
                
                    <?php
                    if( $qry->have_posts() ){ ?> 
                        <div class="container">
                            <div class="product-section-grid">
                                <?php while( $qry->have_posts() ){
                                    $qry->the_post(); 
                                    $stock = get_post_meta( get_the_ID(), '_stock_status', true );
                                    ?>
                                        <div class="product-item">
                                            <div class="product-image">
                                                <a href="<?php the_permalink(); ?>" rel="bookmark">
                                                    <?php 
                                                    if( has_post_thumbnail() ){
                                                        the_post_thumbnail( 'travelbee-shop', array( 'itemprop' => 'image' ) );    
                                                    }else{
                                                        travelbee_get_fallback_svg( 'travelbee-shop' ); //fallback
                                                    }
                                                    ?>
                                                </a>
                                                <?php 
                                                    $stock = get_post_meta( get_the_ID(), '_stock_status', true );
                                                    if( $stock == 'outofstock' ){
                                                        echo '<span class="outofstock">' . esc_html__( 'Sold Out', 'travelbee' ) . '</span>';
                                                    }else{
                                                        woocommerce_show_product_sale_flash();    
                                                    }
                                                ?> 
                                                <div class="woocommerce-button">
                                                    <?php woocommerce_template_loop_add_to_cart(); ?>
                                                </div>
                                            </div>
                                            <div class="product-detail">                                    
                                                <?php 
                                                woocommerce_template_single_rating();                  
                                                the_title( '<h3><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' );
                                                woocommerce_template_single_price(); 
                                                ?>
                                            </div>
                                        </div>
                                <?php } wp_reset_postdata(); ?>
                            </div>
                            <?php if( $button_lbl && $button_link ) { ?>
                                <div class="button-wrap">
                                    <a href="<?php echo esc_url( $button_link ); ?>" class="btn-readmore"><?php echo esc_html( $button_lbl ); ?></a>
                                </div>       
                            <?php } ?>
                        </div>                      
                    <?php } ?>
                </div>
            </div>
            <?php
        }
    }
}
endif;
add_action( 'travelbee_footer_start', 'travelbee_shop_section', 10 );

if( ! function_exists( 'travelbee_cta_section') ):
/**
 * Cta Section
 */
function travelbee_cta_section(){
    if( is_front_page() ){
        $ed_section         = get_theme_mod( 'ed_cta_sec', false );
        $sec_subtitle       = get_theme_mod( 'cta_subtitle' );
        $sec_title          = get_theme_mod( 'cta_title' );
        $sec_content        = get_theme_mod( 'cta_content' );
        $cta_btn_one        = get_theme_mod( 'cta_btn_one' );
        $cta_btn_link       = get_theme_mod( 'cta_btn_one_link' );
        $cta_btn_two        = get_theme_mod( 'cta_btn_two' );
        $cta_btn_two_link   = get_theme_mod( 'cta_btn_two_link' );
        $cta_image          = get_theme_mod( 'cta_image' );
        $alt_image          = attachment_url_to_postid( $cta_image );
        $image_align        = get_theme_mod( 'cta_image_align', 'left-align' );
        if( $ed_section && ( $sec_subtitle || $sec_title || $sec_content || $cta_image || ( $cta_btn_one && $cta_btn_link ) || ( $cta_btn_two && $cta_btn_two_link ) ) ){ ?>
            <section id="cta-section" class="advance-cta section">
                <div class="container">
                    <div class="advance-cta-wrapper">
                        <div class="grid <?php echo esc_attr( $image_align ); ?>">
                            <?php 
                            if( $cta_image ) echo '<div class="grid-item image"><img src="' . esc_url( $cta_image ) . '" alt="' . esc_attr( get_post_meta( $alt_image, '_wp_attachment_image_alt', true ) ) . '"></div>';
                            if( $sec_subtitle || $sec_title || $sec_content || ( $cta_btn_one && $cta_btn_link ) || ( $cta_btn_two && $cta_btn_two_link ) ){ ?>
                                <div class="grid-item">
                                    <?php 
                                        if( $sec_subtitle ) echo '<span class="sub-title">' . esc_html( $sec_subtitle ) . '</span>';  
                                        if( $sec_title ) echo '<h2 class="title">' . esc_html( $sec_title ) . '</h2>';
                                        if( $sec_content ) echo '<div class="section-desc">' . esc_html( $sec_content ) . '</div>'; 
                                        if( ( $cta_btn_one && $cta_btn_link ) || ( $cta_btn_two && $cta_btn_two_link ) ){ ?>
                                        <div class="button-wrapper">
                                            <?php 
                                                if( $cta_btn_one && $cta_btn_link ) echo '<a href="' . esc_url( $cta_btn_link ) . '" class="btn-cta btn-1">' . esc_html( $cta_btn_one ) . '</a>';
                                                if( $cta_btn_two && $cta_btn_two_link ) echo '<a href="' . esc_url( $cta_btn_two_link ) . '" class="btn-cta btn-2">' . esc_html( $cta_btn_two ) . '</a>';
                                            ?>
                                        </div>
                                    <?php } ?>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </section>
        <?php
        }
    }
}
endif;
add_action('travelbee_footer_start', 'travelbee_cta_section', 20 );

if( ! function_exists( 'travelbee_footer_newsletter' ) ) :
    /**
     * Newsletter
    */
    function travelbee_footer_newsletter(){ 
        $ed_newsletter       = get_theme_mod( 'ed_newsletter', false );
        $newsletter          = get_theme_mod( 'newsletter_shortcode' );
        $newsletter_image    = get_theme_mod( 'newsletter_image' );
        $alt_image           = attachment_url_to_postid( $newsletter_image );

        if( !is_single() && !is_404() && $ed_newsletter && $newsletter ){ ?>
            <div class="newsletter-section section">
                <div class="container">
                    <div class="newsletter-section-grid">
                        <?php if ( $newsletter_image ) { ?>
                            <div class="grid-item background-image">                         	                         					
                                <img src="<?php echo esc_url( $newsletter_image ); ?>" alt="<?php echo esc_attr( get_post_meta( $alt_image, '_wp_attachment_image_alt', true ) ); ?>">				                       
                            </div>
                        <?php } ?>
                        <div class="grid-item">
                            <?php echo do_shortcode( $newsletter ); ?>
                        </div>                      
                    </div>
                </div>
            </div>
            <?php
        }
    }
endif;
add_action( 'travelbee_footer_start', 'travelbee_footer_newsletter', 30 );