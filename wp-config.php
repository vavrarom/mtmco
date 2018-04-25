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
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('WP_CACHE', true); //Added by WP-Cache Manager
define( 'WPCACHEHOME', '/home/users/leadmusiccz/mtmco-test.8u.cz/web/wp-content/plugins/wp-super-cache/' ); //Added by WP-Cache Manager
define('DB_NAME', 'wp1506885603');

/** MySQL database username */
define('DB_USER', 'wp1506885603');

/** MySQL database password */
define('DB_PASSWORD', 'lgViZRX8');

/** MySQL hostname */
define('DB_HOST', 'localhost:3310');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '%i7e8P]iNxd0rN]+1>ts~BJ0kj5YSo^H2Z1Y?RUkzIllVUcsnGfa=%v;7]RB6jLe');
define('SECURE_AUTH_KEY',  'TJpOtcGK}PHeekb!Jpb<yKhsd#<XK;p-j#Y6LWBNnN@I>=CP[gD,Fn{pS&W.%q|;');
define('LOGGED_IN_KEY',    ',b:UN/WDl^G~X6if5PRxfiP>YO45Gpsn?Db$9e)jewm#u`~{:kQ]bKI*y,NY=]|j');
define('NONCE_KEY',        ' O.r:ZVoaxN!fu).UG>|+][E(^=xyiKNB9x5;$)3kZqQav*HeU8#gdNrrc>}0Y$-');
define('AUTH_SALT',        'N.0VWWtF:m9.(cg|OT.bz9DIRsyjc_q*:wTEE!6(E&=*SMMZ_WSklR$]x&b6vJ.r');
define('SECURE_AUTH_SALT', 'EO~{p,meqjs2Pw$9N$<K`GG)2}MZ lZ6vfWbw`@z)c+]3c7wbe4%RbwIJkHu!haP');
define('LOGGED_IN_SALT',   '&F4mJOCkt[(4%<EZ/YX,SHSeL~S/;ptNS,DA{9AY~8N;*oIr.Le^[f26< ^XXb^q');
define('NONCE_SALT',       'g5}yv|)^|Fpon.~C#[Ny`lLW50Dr4{+ujH3A5YGY/cu!U>v{TO<!9A8]-y}iuILK');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
