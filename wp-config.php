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
define( 'DB_NAME', 'd1' );

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
define( 'AUTH_KEY',         '|=1)_&3lXJCIT$UnS.%,@Vkn3hEk!B<0h%K1X~^XX<U#Vw4=0(BTrDJn6D[*?whQ' );
define( 'SECURE_AUTH_KEY',  '42FlsK_VBhUY!m-bP:O$[1U21 VO[KIR.w:wWkihUxKvbYN13{FQWSYQYwKehwBh' );
define( 'LOGGED_IN_KEY',    'n.Lgf=f-c^e/8`*(?4LG/~sCZ4e n!H~2wJ#V?@qXkJrlAon!@t.2apz^<Jx_ /;' );
define( 'NONCE_KEY',        '=>F&9q/)k5)o?nga]#jjHazg:oWKW^`>6 ErCM0n+]U ,jKTC@-0 Um}*k:z%sKs' );
define( 'AUTH_SALT',        'b!cNGXqG%b^pB_ S-mH_*x>T[ }9&#zbWZ,tkczS?poZa)i(?AJu,_T5@|pEoI2J' );
define( 'SECURE_AUTH_SALT', '/<]R<loKgv#R^!3uxY:|ZzM{&.T-/a*Jk.nG:T&d7?,[lQB;&1IxC[7aIvElr`M8' );
define( 'LOGGED_IN_SALT',   '{C#sQLL!i!.^>,,bF/Mr2Pt12SMa=i<Cl@fRg{/C_F$[{G0v]}bKDO~Io)<rvFw}' );
define( 'NONCE_SALT',       'eDBD!IZ/3_}fJtlzonv^4*MytL8f9M)i%ErHn }4bmh#C}}QS1%_UIl?/#;<M C=' );

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
