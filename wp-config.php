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
define( 'DB_NAME', 'sam_bobtheroofer' );

/** MySQL database username */
define( 'DB_USER', 'sam_dev' );

/** MySQL database password */
define( 'DB_PASSWORD', 'S/852*963.' );

/** MySQL hostname */
//define( 'DB_HOST', '27.111.84.217' );
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

//SET DEFAULT SITE URL
if (in_array($_SERVER['REMOTE_ADDR'], array('127.0.0.1', '::1'))) {
    define('WP_HOME','http://bobtheroofer.local'); 
	define('WP_SITEURL','http://bobtheroofer.local');
	define( 'WP_DEBUG', true );
	define( 'WP_DEBUG_LOG', true );
}else{
    define('WP_HOME','http://bobtheroofer.createmywordpress.com'); 
    define('WP_SITEURL','http://bobtheroofer.createmywordpress.com');
	define( 'WP_DEBUG', false );
	define( 'WP_DEBUG_LOG', false );
}

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'JZMkF!e>:aeRko95(+%Rx=U/`zl7H+M[edsNyY;&3+M|+wr~,c1|?Kl;/X(+K-FT');
define('SECURE_AUTH_KEY',  '|kear::5vgr%Nw}x b|.^v3xit~%($_FN1C?}I-G)qXO@ z6gOfJy+,hG`mpX@Ct');
define('LOGGED_IN_KEY',    'sD6bXT=6!ycg([do8Du:`ZHIv{/+$d_dP($6 ~K5U r+c?6?/>YQ=d:e&M-hpogN');
define('NONCE_KEY',        '{Z`4ls!~TKwa+]]EzV<j^g24>AJ6>_g.WKEOTF<pu@EW9||y>5Cyex:7x=X^;t8g');
define('AUTH_SALT',        '!:=%sDco^*hq8LBkpmaT[p+d6J#7GJ[HoOBQYg9l2KMIRww~N(BWr2}aQWz|H>RF');
define('SECURE_AUTH_SALT', '{T={|PGhl/pmaWSXd<2fMFiSJB|23^ty3YKSFW|>nH9>Nf,yEoZOr6<JP<|pvtA~');
define('LOGGED_IN_SALT',   '=+z`VEb>,<:x[(L=>+I#e6V|:uU~ZA_zDTIjtDK8H+^6(rk>UhGC+y|h7ou{ynz5');
define('NONCE_SALT',       '|wv7}UYeBU IMS}]L8.ul{eX#N&&Vi/zV+/V`IzaZsUw?XIzIO@*CU(0m_h6l?o7');

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
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
