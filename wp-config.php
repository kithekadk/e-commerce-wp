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
 * * ABSPATH
 *
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'project1' );

/** Database username */
define( 'DB_USER', 'admin7' );

/** Database password */
define( 'DB_PASSWORD', 'admin' );

/** Database hostname */
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
define( 'AUTH_KEY',         'ZJnb{/eeJW#_w<T9P#{omy4T`mjZ}K;9]G;8A8uj<5hi;.-Rmo[*{U(Mdr*|6AM7' );
define( 'SECURE_AUTH_KEY',  'eJ<5~4*m{iEyW5Z{@xd%}k8x=Nfhg77-9<)>v/IFms|c+?dPgvg{17!;p?gXzlzm' );
define( 'LOGGED_IN_KEY',    '+H.+>E,v2f?=4$p}X56~phv~ABwUDYkOb*G5c ]t/KXrJ^NO-7|nX8daCbprVZzV' );
define( 'NONCE_KEY',        's4PVAq*35%Chr^1a6_V.0RAu:i>o&C9GA1}BR#y@5h]8{%C:nx95Ve| .uFH,%d@' );
define( 'AUTH_SALT',        'm.Ljfh !}GNT`I@/yt>E5ba2 UyH}AHnXan;h:~D4Np81qUt99zXMYJPYeC,00vU' );
define( 'SECURE_AUTH_SALT', 'n3Pxe`>KobP^A8Xt,r5c j JF)3$E]#f=3a,3o;aatg^kPB8YgOJ>x1H:tsE`UXL' );
define( 'LOGGED_IN_SALT',   'eOdj:%8Fl&<F(X$0$qo`0Yl>K{,tC|X`/~5ZrB8^l[1@sO$/c0 $*lbyA.q+3Y.=' );
define( 'NONCE_SALT',       'K84EAwXHW/5<T[O]6gf]zgA@#%@dcrBD;m{b]8 cR1oIEJ0=1QZ9Rm-I0:Fd6m&%' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'p1_';

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
