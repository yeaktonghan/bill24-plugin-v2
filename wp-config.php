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
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */
ob_start();
// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'test_woocommerce' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

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
define( 'AUTH_KEY',         'D5^=pcML*h%:^<N5ksOpIT:C!WfO,bEKXN=y(;g yyP#tPhx.4(a``yZBH>6~]b8' );
define( 'SECURE_AUTH_KEY',  's+C6$f*tqv7h|+<-J^j=|KgcY;fS2J3@8oP;|]ods9)&>5dW-ST,ATNH/$u&JK9v' );
define( 'LOGGED_IN_KEY',    ':^Zs:{U$hdA%f{5u_ZQJL}d`QU2%F{6J62~YC46@i/Z([l@smL1lVEv3|< v5zkD' );
define( 'NONCE_KEY',        '[N cg[&-4] !;gK0Ea}oL94Cjf4|0l1DqRwt>?@qTBTr4hzI)m@>}[jfzCt^}QNI' );
define( 'AUTH_SALT',        '.mVf%=UO&*h]52DQMpz_)r0.P(lU?T~f3%K45p7V~mkt=S6m9g &+pF[D~<[R^GT' );
define( 'SECURE_AUTH_SALT', 'AN5k3X<}*umsRvvoG-8vtz9>tRH)Vtp]l-y$XFPhg7ynR)=nW?4yZPntb;iUfHBi' );
define( 'LOGGED_IN_SALT',   'E:L{N@:yyvrPo~:kcB_NNX?nJDvq*;UJkP==^j[c({KHOJYRp`%(-Va0/#4J|E3~' );
define( 'NONCE_SALT',       'TkI,tQ;Zai5x7(?Uz*5psXh5?qv3kva+LmjYqyx_Geqoq3Ohh<) Ct+|i2] c-P?' );
/**#@-*/

/**
 * WordPress database table prefix.
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
define( 'WP_DEBUG', true );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
