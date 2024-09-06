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
define( 'DB_NAME', 'dbigt48wfyhzlb' );

/** Database username */
define( 'DB_USER', 'ustaw47aemt87' );

/** Database password */
define( 'DB_PASSWORD', 'giyehv6p9mhb' );

/** Database hostname */
define( 'DB_HOST', '127.0.0.1' );

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
define( 'AUTH_KEY',          'PjOzhl&c6V$YOKvqw|4vE@|@A[[#R_lF2n[Wsu95~Z.}9wfzR)14Djc.tN*s+E4|' );
define( 'SECURE_AUTH_KEY',   'AGrv5@5T{qzosp]60hce~%,5-7;DfW@3K`CY&<Spkt3Eyq=GmEy{rs;39t?)_:WX' );
define( 'LOGGED_IN_KEY',     'T^B0b{]`{tj_/oDlxRn7L;_m+09w_WEW99i~m5hbg3Nb%n(TaPM:POrO]}h.g7Op' );
define( 'NONCE_KEY',         '7l9vZ/cHEYjasZ%c2ZU9-U5_~kl5Yg0`_72Y|A,$/}Yj|;})sc0:susf$^n=d %6' );
define( 'AUTH_SALT',         '.YX07JbK;%8BcjghDc, znwj#cT%MisY^WQ.OR]d,Ns-!>QuKYi:~%qR3^#R_A#C' );
define( 'SECURE_AUTH_SALT',  'zNIxHK-}KRn%mPV];1k~Yl[4I1:D(mBt%CV.YC9P5R4E0S[u3)&Z,$K``9K>Zg;c' );
define( 'LOGGED_IN_SALT',    'FUymsIl{{fi`+x]*B?};4fu ZE7aE%]mS.0(* &1+6ZyqQE4OGA3Ky+[yR.~S#aZ' );
define( 'NONCE_SALT',        ']vmWpT3C[v!5%}&6Spub/YFMyi7Y;wcAkL7tIuKYv,PjSPf,apn<s2sc/M&8IP@V' );
define( 'WP_CACHE_KEY_SALT', 'r;,XaipxKkPEgo!2H~iV$kDg=f~i^$8>$C8WWMAhx$0@1NYZEc[)9Cga&85GKB7{' );


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'mfs_';


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

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
@include_once('/var/lib/sec/wp-settings-pre.php'); // Added by SiteGround WordPress management system
require_once ABSPATH . 'wp-settings.php';
@include_once('/var/lib/sec/wp-settings.php'); // Added by SiteGround WordPress management system
