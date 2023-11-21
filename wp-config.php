<?php

//Begin Really Simple SSL session cookie settings
@ini_set('session.cookie_httponly', true);
@ini_set('session.cookie_secure', true);
@ini_set('session.use_only_cookies', true);
//END Really Simple SSL cookie settings

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
 * * ABSPATH
 *
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'aplhpzmy_WPF3I');

/** Database username */
define('DB_USER', 'aplhpzmy_WPF3I');

/** Database password */
define('DB_PASSWORD', '(GVzZ$9?AkI#');

/** Database hostname */
define('DB_HOST', 'localhost');

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
define('AUTH_KEY', '43cbbc0bfdfe6dda26ef126610a1e10ff9de7776dee6d2469d2b35017037cc78');
define('SECURE_AUTH_KEY', '9591ecb3834fa216d315dbeb6a2173a45344b571509de9aa8100383766f1c4be');
define('LOGGED_IN_KEY', '0ddad7eff77da8c8a708c7415ba7e1e0c890e0bc51514ea3639bd58ac8af388f');
define('NONCE_KEY', 'ebf55127372e6f1dfd722e880fabfe77727ed6d38595d7afd43c6cb13aea83f2');
define('AUTH_SALT', '6ee9d91f465dfd4010ea61d95ffe57f99372853545fc412e8b5db84d5e051725');
define('SECURE_AUTH_SALT', '77981d39940a1040269e528dd523727c62e0f9c5d99875d03917ca81a9afa4db');
define('LOGGED_IN_SALT', 'e89c14b3add3fe1f6472c2ed99640a975e57cb7d2784db530847455f4dc5817b');
define('NONCE_SALT', '18b97f2138fca56f505ea0cab78dfacb5523c7933ee64a4dde4533210abecd14');

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'oyI_';
define('WP_CRON_LOCK_TIMEOUT', 120);
define('AUTOSAVE_INTERVAL', 300);
define('WP_POST_REVISIONS', 20);
define('EMPTY_TRASH_DAYS', 7);
define('WP_AUTO_UPDATE_CORE', true);

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
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
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
