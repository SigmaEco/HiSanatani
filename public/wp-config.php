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
define( 'AUTH_KEY',          'c,9sMUuzT}p $X6ls!<b*2B>we|2HYuZrNx.YifM+VRmh8i9m;8>mhqw&WeL)[~&' );
define( 'SECURE_AUTH_KEY',   'TAqvsj!_}d![#q@.k@tj2<)DfMO:C,/R1f(+Ue!sS%1+5r^ET@{;]^VgK@=2~?w ' );
define( 'LOGGED_IN_KEY',     'Gqs<b6N`F0~Xv% K?=x~7&cq;`N^CeCKLS]K2^3tN<2I_j3zKT#]pYDWQjH^+&^+' );
define( 'NONCE_KEY',         '{#`Jb^@)ilS~MoJ o.9w?2M }1YYOmqZW_e4$.^/O%@^Yp,^]d0ThA*y1=v%INkD' );
define( 'AUTH_SALT',         'V~<Vqxwh)hned;2+d0+eNL}xuUMNJ4s=%K|@t|_-u[tWx<.:x-4+FO8y`gz6kE^6' );
define( 'SECURE_AUTH_SALT',  'Vc!Z^!Lrzn(,^%8PI&sSz{vN*+5(bh.&j2>A<W;$MwAI, upXlNObH?ebok5o,^*' );
define( 'LOGGED_IN_SALT',    'S^fu0oY{a$*t,Ta|knq+9Z`M#;@#%yWG.XAutO2u&0R<<LPF*EN>f$BmWd#5B*Dr' );
define( 'NONCE_SALT',        'TX!m{(rP)t!}t)E^]mz.NoZE$y$xF.y7&?q6L$xjad`8Ct 6@aLSsd=?K<Cn.jyR' );
define( 'WP_CACHE_KEY_SALT', ',Fp#{Z%h,A$skh==NQ/82IdFO%IhTd ;52d8l@`Z0;l!hLZF@b/,^=QcxO<o[v>W' );


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';


/* Add any custom values between this line and the "stop editing" line. */



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
