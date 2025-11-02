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
define( 'DB_NAME', 'local' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'root' );

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
define( 'AUTH_KEY',          '58,uc 4;<3tqmHEL/C;.H8a.lk<)I!3PwA%0:R)X.2%?]3Zb<%SU:ZghB1sfLRGa' );
define( 'SECURE_AUTH_KEY',   '!Y)^&vi]eq<lg.-LNHAm3Agq2TgiEd)#`V(}.aPi`]AzLU@ZEzo5!,)NDyMuU$-;' );
define( 'LOGGED_IN_KEY',     '&8+Bv%fDd)hb?sg;i b9M!P5cppda]TQQlh*E+rzFf>,KRroX@E(=MTRIaI#N&`H' );
define( 'NONCE_KEY',         ';[_c;U{[6eC9x*-Da/ca6G Yj-S;loXow^K~dO|^mdEAXif2QFiH[>xD$k@_z&=,' );
define( 'AUTH_SALT',         '*$IZv[9FhWcx]ABZGQctMoiG5fCW6~t9%l79us%v. 0n~2e*FXV#S,XDUr]>g4H<' );
define( 'SECURE_AUTH_SALT',  '4*V[(94$5$3@{r3aD.=2CtC@j}7fkI_F2IkAs#k^H )%C6&o=#cw/3YgboH>* t!' );
define( 'LOGGED_IN_SALT',    'atg_yd&F}z}AgM4~aRe761atM4m_tCL(oZgOG&i:`?YEBGGjWM6K&M3;PGcK_a5~' );
define( 'NONCE_SALT',        '>dIC8#i>T%XuEAZA])gHHaUGJ6MQg,HfDbeTo<$lp}t`Z;sEajWI%NfkY!LCd&m0' );
define( 'WP_CACHE_KEY_SALT', 'acy]<WJJ.?qc&cW;1K.(+)_|nIoy-q^8Tjz hxe:)hlv0?g9GWyG?zW:9O, hxW:' );


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';


/* Add any custom values between this line and the "stop editing" line. */

define( 'WP_FS__DEV_MODE', true );
define( 'WP_FS__SKIP_EMAIL_ACTIVATION', true );
define( 'WP_FS__collapsible-sections-for-learndash_SECRET_KEY', 'sk_Ra7q0IFUg~V4NrJ4bgYqLosF0vhYe' );

/* That's all, stop editing! Happy blogging. */


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
if ( ! defined( 'WP_DEBUG' ) ) {
	define( 'WP_DEBUG', false );
}

define( 'WP_ENVIRONMENT_TYPE', 'local' );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
