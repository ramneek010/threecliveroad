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
define('FS_METHOD', 'direct');
define('DB_NAME', 'clive-live');

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
define('AUTH_KEY',         '19b04p[&@jA7,ZM}!*O*Kdd[V:yR3]||a>nJw)m-0Xvf07U>UVJo~$V>V%}6:AaQ');
define('SECURE_AUTH_KEY',  '8,;qCkH.2rBxvg|pk*QN4Wb6lvN[G4+.s+;*JVu!2sY](=go{a^Xzh@R{%=IE=l^');
define('LOGGED_IN_KEY',    'Ee},/!|M+EW_y9V@F,zEzGgb/i6@L$z`[S@SCqr|h2sMe47>3~;.Y%!qeda_UI,6');
define('NONCE_KEY',        '9.VR^~EM{0K!g9XL{2(1q#DXk]q~`sl-A:npdKKLU76a4J$,3uZ{z:r]z_T4T9<3');
define('AUTH_SALT',        'iFYDhMyF{Ug*6IRmkw)xVoEGk`bW}lu}kGyNWg+,b8HA)h3+O,MEf;_/h,m6`~DQ');
define('SECURE_AUTH_SALT', 'F]MS}]/9~@;EuvXzI1w>Lw<h 7z+@PW794=*KIQ/bBM8i#^Q7m^IwB-R35+u@{4Y');
define('LOGGED_IN_SALT',   'xSun[]>o{wQvoK;?A$W`@;4O#T?=t+s!`xZSiQ?G.$!^!*bSi6c 8|Aec=A7T4g}');
define('NONCE_SALT',       '-Uvx/p]|LaYuvm P8ey9PxZ~e-=mlmyZT9zy3)U[m)Rk2=<3UJFr{h]guIh>I>_G');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'cliver_';

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
