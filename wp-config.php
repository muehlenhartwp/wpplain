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

 * @link https://wordpress.org/support/article/editing-wp-config-php/

 *

 * @package WordPress

 */


// ** Database settings - You can get this info from your web host ** //

/** The name of the database for WordPress */

define( 'DB_NAME', 'bitnami_wordpress' );


/** Database username */

define( 'DB_USER', 'bn_wordpress' );


/** Database password */

define( 'DB_PASSWORD', '02aa0e6b214242135de9333baef6ddb59d6b31bd6ba27ce60ab934e9855c2cbf' );


/** Database hostname */

define( 'DB_HOST', 'localhost:3306' );


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

define( 'AUTH_KEY',         'g_?+4qm3.j@p(CR[: z6SW$t}a+.8;&O!C,)BwDCy`,Ek-a:EAn6 ~`;]=f0tnH~' );

define( 'SECURE_AUTH_KEY',  'w.AK`YhPsFeG1F)5x:$jM%YSulw,+&<fP]6 %_.c<6J$LgY(ufk2OL cF 3F6<*B' );

define( 'LOGGED_IN_KEY',    'Z/j-lv_ZL_sB*%P2>,qte8?w=2K>SR.r$jp|~oxB>,]4/45Ea@sE+{$_sJP9T]1X' );

define( 'NONCE_KEY',        'fw@K.3DzGz<=1yCEw~<oeb?n63gNWxlyu|wG)+-g>WjoyR3_.^MP!PxG;j_w<:t$' );

define( 'AUTH_SALT',        '_!]ph}q.Vem;i-{|E r(Nj<Bm~)+E3Irl1 WIT%C0&?HmR$u@<ZaT/-mM!:M%|53' );

define( 'SECURE_AUTH_SALT', 'dLTB5Ls3C(QdVvxWhpA{!in~u(e`@0t-VLyqu^5{X^)I1j+I9%6-*=ILm4ST?BK2' );

define( 'LOGGED_IN_SALT',   'PId0El>YQueF<Q(gv{ieLSMPZ<U;b~aD%F~hEHU:oYDGW:k#;D%.r4#Mn-gm^R8B' );

define( 'NONCE_SALT',       '?X/pW6]Q)xkO[a3h-Tv{Mtn&eG)_Hyvly~uB{a&_.V*@tqw*-^+Q>liv?wl!U5r0' );


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

define( 'WP_DEBUG', false );


/* Add any custom values between this line and the "stop editing" line. */




define( 'FS_METHOD', 'direct' );
/**
 * The WP_SITEURL and WP_HOME options are configured to access from any hostname or IP address.
 * If you want to access only from an specific domain, you can modify them. For example:
 *  define('WP_HOME','http://example.com');
 *  define('WP_SITEURL','http://example.com');
 *
 */
if ( defined( 'WP_CLI' ) ) {
	$_SERVER['HTTP_HOST'] = '127.0.0.1';
}

define( 'WP_HOME', 'http://' . $_SERVER['HTTP_HOST'] . '/' );
define( 'WP_SITEURL', 'http://' . $_SERVER['HTTP_HOST'] . '/' );
define( 'WP_AUTO_UPDATE_CORE', 'minor' );
/* That's all, stop editing! Happy publishing. */


/** Absolute path to the WordPress directory. */

if ( ! defined( 'ABSPATH' ) ) {

	define( 'ABSPATH', __DIR__ . '/' );

}


/** Sets up WordPress vars and included files. */

require_once ABSPATH . 'wp-settings.php';

/**
 * Disable pingback.ping xmlrpc method to prevent WordPress from participating in DDoS attacks
 * More info at: https://docs.bitnami.com/general/apps/wordpress/troubleshooting/xmlrpc-and-pingback/
 */
if ( !defined( 'WP_CLI' ) ) {
	// remove x-pingback HTTP header
	add_filter("wp_headers", function($headers) {
		unset($headers["X-Pingback"]);
		return $headers;
	});
	// disable pingbacks
	add_filter( "xmlrpc_methods", function( $methods ) {
		unset( $methods["pingback.ping"] );
		return $methods;
	});
}
