<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'prod_skipta' );

/** MySQL database username */
define( 'DB_USER', 'prod_skipta' );

/** MySQL database password */
define( 'DB_PASSWORD', 'c78cI62Og3N5' );

/** MySQL hostname */
define( 'DB_HOST', '172.31.31.93' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '$e$WS>J^lgzM6VQmv3;b C_B16kb*A3h&5y;$?bMT?5iv m<6Pk}2$VBjs=,.&>q' );
define( 'SECURE_AUTH_KEY',  'mT5zY.aUi2:AD8ilUlUuqJO{fy?aIj%8G^C+5m:+D`.9xyQ1sn{,9e5%9_+SNEG0' );
define( 'LOGGED_IN_KEY',    '[-h6+3e.i$5lML%we*h^M*X9CchYcuKjMc8}%96rS9mmEs7,.)ffnu<0rJJ!hGi1' );
define( 'NONCE_KEY',        'yNHdpw+_gdoJUuafGMaKCmA<Qm%^2;8Z-Vip4@;%>I;v-;m=vN84B>[Jy.N9:]~ ' );
define( 'AUTH_SALT',        '=rKm,V%J/?8Lb!M_2Edm/+3nF5]Ve!v*p9>5Xn{d_C>T1!d%=X-N.cC2B,v0T2U`' );
define( 'SECURE_AUTH_SALT', '8BSFjugNxAD*n0LYX%h>l &V#j.1x!TnEA(xDZI/.i0-2NQLr4YI^ tB+H0wqX]i' );
define( 'LOGGED_IN_SALT',   'WsoCJ`5..(P9^MD9s<u`8%.*}}yGz*o-<R8ZM!~``%fgH3V}/e=}<$N;PmW6_DV;' );
define( 'NONCE_SALT',       '!)H]of|#NJThk#X;?3*3(3B1LaKcVC[Km<7G8C.yyfOMphcxnva1RBaYYosR=SGw' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

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

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
