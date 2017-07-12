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
define('DB_NAME', 'lifeinsteps');

/** MySQL database username */
define('DB_USER', 'lifeinsteps');

/** MySQL database password */
define('DB_PASSWORD', 'SPQaKJdmqSH0p1bP');

/** MySQL hostname */
define('DB_HOST', 'localhost');

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
define('AUTH_KEY',         'q4;D!S^Cv)#1doJ.rNw=H_DmfKQp68i@+1LyIfHE9O9}-aUBEOUh@<P>IBi$;CC ');
define('SECURE_AUTH_KEY',  'M*8y4&mu,%p#k)C12N8=&a7;S727~%7$,gx%Pi&LPIha:{4$w=@i!,?OQPkP2z39');
define('LOGGED_IN_KEY',    'OsiXl3c(Zp<q<%cS@Kebg=?O(itOyEmmr,df)&{&8s6|<1jY3Hd?l%U:_!2|3D:C');
define('NONCE_KEY',        '5w_:,3THt-Utegk8+Y#.io#|wg>61cjv,%!iAyKnk`UzVhSp6B.JHb6w&d;3GdK4');
define('AUTH_SALT',        '>;aD*n (%-S%{YkVrD;mPP[)fEJE7I(2Sw]E|asao!BSl2?z[_J*5!?6P<h/QxZ&');
define('SECURE_AUTH_SALT', 'J56Z/E)*][uw(:SOHd<9o>`=#k7{5R13J<.y-|C@7IOAt4Et>T,b.wr0cf8{R)dz');
define('LOGGED_IN_SALT',   'bO4,Ui-h%)?.u4`@,ek9(7T0H.Vm0/DVYtYvMD:AJu8TG`Rrw;2*<M`a.bwgT/E2');
define('NONCE_SALT',       ';p/ qP<<3DK`{$?|<lnp:G9.eaNEcQ m}vM)p}`TU;Q$n<pZbwkq)&fed3M]T,7X');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'lis_';

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
