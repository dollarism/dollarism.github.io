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
define( 'DB_NAME', 'd3' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

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
define( 'AUTH_KEY',         'SPrOg[{1~7O/ 4w3JYacBXx;q!_$5&V,T*y ;%~ad3`z&;!v6d;SpIqSDd&;I6dc' );
define( 'SECURE_AUTH_KEY',  'v.5}cVQ~FyxX-]&Ex3kR3USXa~i`hSvsO)#vB`Nn}B;: K_aKj09]{k>)a/qg4vk' );
define( 'LOGGED_IN_KEY',    '#Hva/^@Bm`O}y T4+Wwy{al8{T?ov&&BP@w;n(rhah_zrYk q]~TbM`-Fl@{6F1,' );
define( 'NONCE_KEY',        'S^y31eS>PpADK(!s.fYy]x`ZoQhkb,|cjIHvwDHHH_k}kik}s>F/<8|2~QmI9Ch^' );
define( 'AUTH_SALT',        'DruRha;v#g0?ekT,MLb9{$$q5rT_m0 pI:|44;){a%K?,bT_be@NU*{(a. 1CzOB' );
define( 'SECURE_AUTH_SALT', 'Q%Pdf8uA*1hgP+!VZuU5/bmq6.+;/H=U+W{1Q;`o~cjmOJDnj*/GN:? aBM`BVvo' );
define( 'LOGGED_IN_SALT',   'S3Uq*~8+Sa0.HMOlYe5R9QN-2]eei=3dr;+^~K=sz7f7S&Ku;Z0xrmW~%J>%Jw)B' );
define( 'NONCE_SALT',       'AwSH>4!}J*1arUII).Xgr;P>S8t2K5oG8xR!tuj.H)lr?r;g,X3OAIc9!<_Od<>H' );

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
