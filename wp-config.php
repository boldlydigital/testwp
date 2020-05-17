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
define( 'DB_NAME', 'boldlydigitalja' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

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
define( 'AUTH_KEY',         '%VoaEd0h&U5+yoI$8xK%_WUZ{NmPR8*fd3q_OKts{Cc94 UrbIu9h}|bGuEN_ime' );
define( 'SECURE_AUTH_KEY',  'Y4hGKq5nh,>gOntSm8A -E{iOTT%f1gK/eBjD<c$sK}_I(3s1#nour2;C[x54u`%' );
define( 'LOGGED_IN_KEY',    'h_~WO~a_o-Da#7x(dj$nwdd.Egg+woR>iW$F)E?a!/%vfuG|+Q~X6_)a7x3`.o8T' );
define( 'NONCE_KEY',        'p^4WS4MA?)L3egg?.NUvQe[*oa:rpu$<+ :IO1sj:,Xyofd7]|:{=o!S[o&6Fasa' );
define( 'AUTH_SALT',        'JHJdI>pj[/n;[>%im9&$8?Y_&v 5OXLnNln^srgIyK_Pl6{M&_E&jS0ohlqm.+.f' );
define( 'SECURE_AUTH_SALT', 'mO+U0@~9N;LxobRrpwF&j2{3r[k./g/di4GLXg_1,s:~_rpE.>8PeK;zN;b84nl7' );
define( 'LOGGED_IN_SALT',   '*32LSQ[X>@sS49SSAlB7|T+p^>%/J>b2?eK&8zuxF~tMp[1z|8?6,aF|ucUx{d<>' );
define( 'NONCE_SALT',       '8xA$9knXv>SXpj6HC]+>F7`2{,bhb-8n&F`2}qbj9<^+kYBh{e+#>:bz97Ld$!kE' );

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

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
