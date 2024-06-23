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

define( 'DB_NAME', "dollar" );


/** MySQL database username */

define( 'DB_USER', "root" );


/** MySQL database password */

define( 'DB_PASSWORD', "" );


/** MySQL hostname */

define( 'DB_HOST', "localhost" );


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

define( 'AUTH_KEY',         '?y.%<)7tqsc&:xGA7@nZ)d)UK:{xD2I,Q}6MB-t]Q)k6TLACn<`p!$yyHd1/!s&!' );

define( 'SECURE_AUTH_KEY',  'Gd#XGqyG aJ,aYdZW-M)mtINJWx`6VK|5oW3HB?lOQrM0xP3~}33s()E6(>H57Py' );

define( 'LOGGED_IN_KEY',    '0E3,:!g7>18Ycy?M+I6*a17<vhoJli!tqb6G/B~u8M8*nG9DbYQI]JS%Pri}I2*s' );

define( 'NONCE_KEY',        '=PLQcaPLp&;b@6=P^OC(5BF+(%J3[F1Q-Kou@xL<ZG{V0?jL=dXIf8sW|qw1i|SG' );

define( 'AUTH_SALT',        'u%+JM|ECw.gYpCa=eVCyQ[Ge)a%6m!A.FM^.vXK%n{u77R1E0E2s&dJ%aNFvaXp/' );

define( 'SECURE_AUTH_SALT', '/T+J&h(ao>gb4$bO8tWJ AP1ngp}A>h*e(h,oK&mK-AEgsYY-$.XOS|Y{%$_-<G|' );

define( 'LOGGED_IN_SALT',   'S*h`Ha%euH*&ldVd!LZZldxpJL0$1WYw6MrKM/)N@>UW2=Sb( `7}PTX3`GgrT?t' );

define( 'NONCE_SALT',       'Yk)wSYTl60,Di9lxrsYJmH:{+8^W,Ch3Ay{I(Zy[PPkk#jjv(Zy1r9qml0D^?,}x' );


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


define( 'WP_SITEURL', 'http://127.0.0.1/dollarism.github.io/' );
/* That's all, stop editing! Happy publishing. */


/** Absolute path to the WordPress directory. */

if ( ! defined( 'ABSPATH' ) ) {

	define( 'ABSPATH', dirname(__FILE__) . '/' );

}


/** Sets up WordPress vars and included files. */

require_once ABSPATH . 'wp-settings.php';

