<?php
/**
 * Travelbee Dynamic Styles
 * 
 * @package Travelbee
*/
if ( ! function_exists( 'travelbee_dynamic_css' ) ) :
    
function travelbee_dynamic_css(){
    
    $primary_font    = get_theme_mod( 'primary_font', 'Work Sans' );
    $primary_fonts   = travelbee_get_fonts( $primary_font, 'regular' );
    $secondary_font  = get_theme_mod( 'secondary_font', 'Ovo' );
    $secondary_fonts = travelbee_get_fonts( $secondary_font, 'regular' );
    $font_size       = get_theme_mod( 'font_size', 18 );
    $font_color      = "#575757";
    
    $site_title_font      = get_theme_mod( 'site_title_font', array( 'font-family'=>'Ovo', 'variant'=>'regular' ) );
    $site_title_fonts     = travelbee_get_fonts( $site_title_font['font-family'], $site_title_font['variant'] );
    $site_title_font_size = get_theme_mod( 'site_title_font_size', 30 );
    
    $primary_color    = get_theme_mod( 'primary_color', '#e79372' );
    $site_title_color = get_theme_mod( 'site_title_color', '#141414' );
    $logo_width       = get_theme_mod( 'logo_width', 150 );
    
    $rgb = travelbee_hex2rgb( travelbee_sanitize_hex_color( $primary_color ) );
    
    $about_sec_color = get_theme_mod( 'about_bg_color', '#f5ede8' );
    $about_type      = get_theme_mod( 'about_bg', 'color' );

    $shop_sec_image   = get_theme_mod( 'shop_bg_image' );
	$shop_sec_color   = get_theme_mod( 'shop_bg_color', '#fafafa' );
	$shop_type 		  = get_theme_mod( 'shop_bg', 'color' );

    $newsletter_bg_image = get_theme_mod( 'newsletter_bg_image');
    $newsletter_bg_color = get_theme_mod( 'newsletter_bg_color', '#faf6f4' );

    $cta_bg_color   = get_theme_mod( 'cta_bg_color', '#faf6f4' );
    
         
    echo "<style type='text/css' media='all'>"; ?>

    :root {
		--primary-color: <?php echo travelbee_sanitize_hex_color( $primary_color ); ?>;
		--primary-color-rgb: <?php printf('%1$s, %2$s, %3$s', $rgb[0], $rgb[1], $rgb[2] ); ?>;
        --primary-font: <?php echo esc_html( $primary_fonts['font'] ); ?>;
        --secondary-font: <?php echo esc_html( $secondary_fonts['font'] ); ?>;
	}

    .site-title{
        font-size   : <?php echo absint( $site_title_font_size ); ?>px;
        font-family : <?php echo esc_html( $site_title_fonts['font'] ); ?>;
        font-weight : <?php echo esc_html( $site_title_fonts['weight'] ); ?>;
        font-style  : <?php echo esc_html( $site_title_fonts['style'] ); ?>;
    }
    
    .site-title a{
		color: <?php echo travelbee_sanitize_hex_color( $site_title_color ); ?>;
	}
     

    .custom-logo-link img{
        width: <?php echo absint( $logo_width ); ?>px;
        max-width: 100%;
	}

    .advance-cta .advance-cta-wrapper{
        background-color: <?php echo travelbee_sanitize_hex_color( $cta_bg_color ); ?>; 
    }

    <?php if( $about_type == 'color' && $about_sec_color ){ ?>   
        .about-section {
            background-color: <?php echo travelbee_sanitize_hex_color( $about_sec_color ); ?>;
        }
    <?php } 

    if( ( $shop_type == 'image' && $shop_sec_image ) || ( $shop_type == 'color' && $shop_sec_color ) ){ ?>
        .product-section {
            <?php if( $shop_type == 'image' ){ ?>
                background-image: url( <?php echo esc_url( $shop_sec_image ); ?> );
            <?php }elseif( $shop_type == 'color' ){ ?>
                background-color: <?php echo travelbee_sanitize_hex_color( $shop_sec_color ); ?>;
            <?php } ?>
        }
    <?php } 
    
    if( $newsletter_bg_image ){ ?>   
        .newsletter-section .grid-item.background-image::before {
            content : "";
            background-image: url( <?php echo esc_url( $newsletter_bg_image ); ?> );
        }
    <?php }

    if( $newsletter_bg_color ){ ?>   
        .newsletter-section {
            background-color: <?php echo travelbee_sanitize_hex_color( $newsletter_bg_color ); ?>;
        }
    <?php } 

    if( $newsletter_bg_color ){ ?>
        .newsletter {
                background-color: <?php echo travelbee_sanitize_hex_color( $newsletter_bg_color ); ?>;
            }
        <?php } 
    ?>

    /* Typography */

    body {
        font-family : <?php echo esc_html( $primary_fonts['font'] ); ?>;
        font-size   : <?php echo absint( $font_size ); ?>px;        
    }

    blockquote::before{
      background-image: url("data:image/svg+xml,%3Csvg width='72' height='54' viewBox='0 0 72 54' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M16.32 54C11.2 54 7.168 52.1684 4.224 48.5053C1.408 44.7158 0 39.7895 0 33.7263C0 26.5263 1.856 19.9579 5.568 14.0211C9.408 8.08422 15.104 3.41053 22.656 0L32.64 8.14737C27.392 9.91579 22.976 12.5684 19.392 16.1053C15.808 19.5158 13.44 23.3684 12.288 27.6632L13.248 28.0421C14.272 27.0316 16.064 26.5263 18.624 26.5263C21.824 26.5263 24.64 27.7263 27.072 30.1263C29.632 32.4 30.912 35.6211 30.912 39.7895C30.912 43.8316 29.504 47.2421 26.688 50.0211C23.872 52.6737 20.416 54 16.32 54ZM55.68 54C50.56 54 46.528 52.1684 43.584 48.5053C40.768 44.7158 39.36 39.7895 39.36 33.7263C39.36 26.5263 41.216 19.9579 44.928 14.0211C48.768 8.08422 54.464 3.41053 62.016 0L72 8.14737C66.752 9.91579 62.336 12.5684 58.752 16.1053C55.168 19.5158 52.8 23.3684 51.648 27.6632L52.608 28.0421C53.632 27.0316 55.424 26.5263 57.984 26.5263C61.184 26.5263 64 27.7263 66.432 30.1263C68.992 32.4 70.272 35.6211 70.272 39.7895C70.272 43.8316 68.864 47.2421 66.048 50.0211C63.232 52.6737 59.776 54 55.68 54Z' fill='<?php echo travelbee_hash_to_percent23( travelbee_sanitize_hex_color( $font_color ) ); ?>'/%3E%3C/svg%3E%0A");
    }
      
    nav.post-navigation .nav-links .nav-next:hover .meta-nav::before, nav.post-navigation .nav-links .nav-previous:hover .meta-nav::before {
        background-image: url("data:image/svg+xml,%3Csvg width='41' height='15' viewBox='0 0 41 15' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cline y1='-0.5' x2='39' y2='-0.5' transform='matrix(-1 0 0 1 40.5 8)' stroke='<?php echo travelbee_hash_to_percent23( travelbee_sanitize_hex_color( $primary_color ) ); ?>'/%3E%3Cpath d='M9 0C9 5 1 7.5 1 7.5C1 7.5 9 10 9 15' stroke='<?php echo travelbee_hash_to_percent23( travelbee_sanitize_hex_color( $primary_color ) ); ?>' stroke-linejoin='round'/%3E%3C/svg%3E ");
    }
    
    
    .newsletter-section .newsletter-section-grid .grid-item.background-image:after {
       background-image: url("data:image/svg+xml,%3Csvg width='148' height='41' viewBox='0 0 148 41' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1 24.4579C31.8897 43.7472 98.653 52.3941 141.5 6' stroke='<?php echo travelbee_hash_to_percent23( travelbee_sanitize_hex_color( $primary_color ) ); ?>'/%3E%3Cpath d='M131 5.93066C134.653 9.39553 141.942 5.19738 141.942 5.19738C141.942 5.19738 138.305 12.8604 141.958 16.3253' stroke='<?php echo travelbee_hash_to_percent23( travelbee_sanitize_hex_color( $primary_color ) ); ?>' stroke-linejoin='round'/%3E%3C/svg%3E ");
    }
    
    <?php 
    echo "</style>";
}
endif;
add_action( 'wp_head', 'travelbee_dynamic_css', 99 );

/**
 * Function for sanitizing Hex color 
 */
function travelbee_sanitize_hex_color( $color ){
	if ( '' === $color )
		return '';

    // 3 or 6 hex digits, or the empty string.
	if ( preg_match('|^#([A-Fa-f0-9]{3}){1,2}$|', $color ) )
		return $color;
}

/**
 * convert hex to rgb
 * @link http://bavotasan.com/2011/convert-hex-color-to-rgb-using-php/
*/
function travelbee_hex2rgb($hex) {
   $hex = str_replace("#", "", $hex);

   if(strlen($hex) == 3) {
      $r = hexdec(substr($hex,0,1).substr($hex,0,1));
      $g = hexdec(substr($hex,1,1).substr($hex,1,1));
      $b = hexdec(substr($hex,2,1).substr($hex,2,1));
   } else {
      $r = hexdec(substr($hex,0,2));
      $g = hexdec(substr($hex,2,2));
      $b = hexdec(substr($hex,4,2));
   }
   $rgb = array($r, $g, $b);
   //return implode(",", $rgb); // returns the rgb values separated by commas
   return $rgb; // returns an array with the rgb values
}

/**
 * Convert '#' to '%23'
*/
function travelbee_hash_to_percent23( $color_code ){
    $color_code = str_replace( "#", "%23", $color_code );
    return $color_code;
}

if ( ! function_exists( 'travelbee_gutenberg_inline_style' ) ) : 
/**
 * Gutenberg Dynamic Style
 */
function travelbee_gutenberg_inline_style(){

    $primary_font    = get_theme_mod( 'primary_font', 'Work Sans' );
    $primary_fonts   = travelbee_get_fonts( $primary_font, 'regular' );
    $secondary_font  = get_theme_mod( 'secondary_font', 'Ovo' );
    $secondary_fonts = travelbee_get_fonts( $secondary_font, 'regular' );
    $primary_color    = get_theme_mod( 'primary_color', '#e79372' );
    $font_color      = "#575757";

    $rgb  = travelbee_hex2rgb( travelbee_sanitize_hex_color( $primary_color ) );
    
    $custom_css = ':root .block-editor-page {
        --primary-font: ' . esc_html($primary_fonts['font']) . ';
        --secondary-font: ' . esc_html($secondary_fonts['font']) . ';
        --primary-color: ' . travelbee_sanitize_hex_color($primary_color) . ';
        --primary-color-rgb: ' . sprintf('%1$s, %2$s, %3$s', $rgb[0], $rgb[1], $rgb[2]) . ';
    }

    blockquote.wp-block-quote::before ,.wp-block-pullquote::before {
        background-image: url("data:image/svg+xml,%3Csvg width="72" height="54" viewBox="0 0 72 54" fill="none" xmlns="http://www.w3.org/2000/svg" %3E%3Cpath d="M16.32 54C11.2 54 7.168 52.1684 4.224 48.5053C1.408 44.7158 0 39.7895 0 33.7263C0 26.5263 1.856 19.9579 5.568 14.0211C9.408 8.08422 15.104 3.41053 22.656 0L32.64 8.14737C27.392 9.91579 22.976 12.5684 19.392 16.1053C15.808 19.5158 13.44 23.3684 12.288 27.6632L13.248 28.0421C14.272 27.0316 16.064 26.5263 18.624 26.5263C21.824 26.5263 24.64 27.7263 27.072 30.1263C29.632 32.4 30.912 35.6211 30.912 39.7895C30.912 43.8316 29.504 47.2421 26.688 50.0211C23.872 52.6737 20.416 54 16.32 54ZM55.68 54C50.56 54 46.528 52.1684 43.584 48.5053C40.768 44.7158 39.36 39.7895 39.36 33.7263C39.36 26.5263 41.216 19.9579 44.928 14.0211C48.768 8.08422 54.464 3.41053 62.016 0L72 8.14737C66.752 9.91579 62.336 12.5684 58.752 16.1053C55.168 19.5158 52.8 23.3684 51.648 27.6632L52.608 28.0421C53.632 27.0316 55.424 26.5263 57.984 26.5263C61.184 26.5263 64 27.7263 66.432 30.1263C68.992 32.4 70.272 35.6211 70.272 39.7895C70.272 43.8316 68.864 47.2421 66.048 50.0211C63.232 52.6737 59.776 54 55.68 54Z" fill="' . travelbee_hash_to_percent23( travelbee_sanitize_hex_color(  $font_color  ) ) . '"/%3E%3C/svg%3E%0A");
    }';

    return $custom_css;
}
endif;
    