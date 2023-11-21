<?php
/**
 * Travelbee functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Travelbee
 */

$travelbee_theme_data = wp_get_theme();
if( ! defined( 'TRAVELBEE_THEME_VERSION' ) ) define( 'TRAVELBEE_THEME_VERSION', $travelbee_theme_data->get( 'Version' ) );
if( ! defined( 'TRAVELBEE_THEME_NAME' ) ) define( 'TRAVELBEE_THEME_NAME', $travelbee_theme_data->get( 'Name' ) );
if( ! defined( 'TRAVELBEE_THEME_TEXTDOMAIN' ) ) define( 'TRAVELBEE_THEME_TEXTDOMAIN', $travelbee_theme_data->get( 'TextDomain' ) );  

/**
 * Custom Functions.
 */
require get_template_directory() . '/inc/custom-functions.php';

/**
 * Standalone Functions.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Template Functions.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Custom functions for selective refresh.
 */
require get_template_directory() . '/inc/partials.php';

/**
 * Fontawesome
 */
require get_template_directory() . '/inc/fontawesome.php';

/**
 * Custom Controls
 */
require get_template_directory() . '/inc/custom-controls/custom-control.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer/customizer.php';

/**
 * Widgets
 */
require get_template_directory() . '/inc/widgets.php';

/**
 * Metabox
 */
require get_template_directory() . '/inc/metabox.php';

/**
 * Typography Functions
 */
require get_template_directory() . '/inc/typography.php';

/**
 * Dynamic Styles
 */
require get_template_directory() . '/css/style.php';

/**
 * Plugin Recommendation
*/
require get_template_directory() . '/inc/tgmpa/recommended-plugins.php';

/**
 * Getting Started
*/
require get_template_directory() . '/inc/getting-started/getting-started.php';

/**
 * Add theme compatibility function for woocommerce if active
*/
if( travelbee_is_woocommerce_activated() ){
    require get_template_directory() . '/inc/woocommerce-functions.php';    
}

/**
 * Add theme compatibility function for Magazine themes newsletter if active
*/
if( travelbee_is_btnw_activated() ){
    require get_template_directory() . '/inc/newsletter-functions.php';    
}

/**
 * raratheme companion filters
 */
if( travelbee_is_rtc_activated() ){
	require get_template_directory() . '/inc/rtc-filters.php';
}

/**
 * Implement Local Font Method functions.
 */
require get_template_directory() . '/inc/class-webfont-loader.php';      