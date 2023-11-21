<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * Localized language
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'aplhpzmy_WPF3I' );

/** Database username */
define( 'DB_USER', 'aplhpzmy_WPF3I' );

/** Database password */
define( 'DB_PASSWORD', '(GVzZ$9?AkI#' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',          's)[O)4}GKqqeY&%@h,=XqyJn?&U/S~zn>CeIN7MeC5pObDNYy%?G/@cKBy}{1[(2' );
define( 'SECURE_AUTH_KEY',   '>?za_4<f[Bu]PFV)eAr/g<bRqgwtVw5C6z;OD<V=0xESj<6!fpfbDy[LkOH3qSCa' );
define( 'LOGGED_IN_KEY',     'S nIC5MfI2.oNu;,.f&hN?zEXTyz|Q5O|Z9X*?YW{aCW[tKpa[]ozh)5~c.sM@;:' );
define( 'NONCE_KEY',         '8<E3k3$qMbxH]45AiOmMhj1B^0ZF&Iy-mrBi.ErbOYA16*eY~!w~+FYJ%1{Exc]h' );
define( 'AUTH_SALT',         '`%X#8R2:Cx]^2maqlhPea1`uhAd4P&y7>39}AWCp02E1.BNBVR6g)$,W;,rB6HR3' );
define( 'SECURE_AUTH_SALT',  '!W]s*;trHPkxC>-{XyH:uqb^:xOSPner2cgf E1b7xP1`vfAnzapFG:D,wh=E*kW' );
define( 'LOGGED_IN_SALT',    ';m=eW7W?R=tX)a85^`sj8V]6E/BHdM4_@_i=hAIeqN? J5%dvR?nNZ4bL=z)Joz1' );
define( 'NONCE_SALT',        'U:^TTs=)*/G$Jtwre7DYZ>b)~}Kl|&D3~la)F1%4vt+#}x_4pZI4lARup`0- 79]' );
define( 'WP_CACHE_KEY_SALT', '*)M>xw0B70{-!oOhR1|l?$$L8b ;1/R-c~%IW{-my/x?=]Xp%rpHp@PhTWRUm{$e' );


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'staging_oyI_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );


/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
