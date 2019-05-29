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

define('FS_METHOD', 'direct');
/** The name of the database for WordPress */
define('DB_NAME', 'clive-live');
define('AUTOSAVE_INTERVAL', 300 ); // seconds
define('WP_POST_REVISIONS', false );

/** MySQL database username */
define('DB_USER', 'diaurora');

/** MySQL database password */
define('DB_PASSWORD', 'dig121009_DI');

/** MySQL hostname */
define('DB_HOST', 'mumbai.cluster-cwkgkzsh3tzj.ap-south-1.rds.amazonaws.com');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'P,Zkb^N)BC 2nA,K[3$$2,q<>n/-2G%LA6=x`<<Dx$D6u^ nk.~B3pHXw^E+HhEq');
define('SECURE_AUTH_KEY',  'u~BUR_p<nso:X2J[@@xRC) $]el,Q)L|#^>4B7]icSuOu/us0GzoP=DudQCgq~bf');
define('LOGGED_IN_KEY',    'cX7>M]UiK_MFiIyF~>/Si5D|P{pcwm?4V~qe&TDnc/qHzAKUaT|to)*}|~0ktP<E');
define('NONCE_KEY',        'F]=Ub[M/9F5Gl:f5BvSIdM1;.U];TIyL0bJXFjmB6=?p6Vn*_)svi*9IlwVZ/~>g');
define('AUTH_SALT',        'j1FZJYt&4K xy~^!ZJzF..,g~s6p}YyDzdckN[?M{c`??09PNFt*<(0M,{ZTSG)R');
define('SECURE_AUTH_SALT', '`Zy>sWit4*$~|{Np7T#]i53.%dQ/!FOo|P!i{/6(?@l1rnjbr0o6H*;xvgL>/dEB');
define('LOGGED_IN_SALT',   '2@SFSi0:l0g`W0}?&3i|CWG?KhOH8TzP3*6Q3ap3OgYSl_#P[.y/6M[wq0yn$[V;');
define('NONCE_SALT',       'PUL=}dvtnq||pz?T+Dk9]5;]<I.&xS@X;wwyyj4Xdzv%`cm,&Q?cxf:Q{D?2~-U+');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'tea_';

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
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');


