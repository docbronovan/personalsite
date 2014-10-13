<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'brockdon_wor2');

/** MySQL database username */
define('DB_USER', 'brockdon_wor2');

/** MySQL database password */
define('DB_PASSWORD', '4tUKcW5P');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

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
define('AUTH_KEY',         'k%y 3s.y]-t:e,-R0Tf.~*MdKY|OHUKMPni)ceg-kAgM*,x3%W/t Ub^.GNN|H3X');
define('SECURE_AUTH_KEY',  ':P1%|]J|!vDNc~hEzMHd,y78Ryeg>DH3ll-DvLF%8od:w[>mHJ)jkgBQ9idjh}uT');
define('LOGGED_IN_KEY',    'D$hl9g;Dq-]9<6i3*^%&>K+00J0RYa%*|t/YWO3IzMab1qzvUWmB%0S#^p#Ac_D|');
define('NONCE_KEY',        'B1K =z[W)!B#;y@^/GXID@uc/zIsoBr^&U+2oUIC@ ,X(4xCE(K|=sE_C&H>I5<J');
define('AUTH_SALT',        'w?C z+%4^cA6s,aQYh,iQ9r{v~nr@&z.0r?XMo:^m][A>xH -GUjmVsM8;K|#BF}');
define('SECURE_AUTH_SALT', 'mlM>+>1.bS/I+`Vr! 6D}g4R-Ah-$P-v_BTO}7xP3}:./4o/xyI-8K+<fO_~}kqK');
define('LOGGED_IN_SALT',   'e|YI+54pTZ0(E(NW7 .,e)B|Im+.RZL~#_.L0Oq1p7)GyRq6_=PrqEUl=X-l6FN;');
define('NONCE_SALT',       'A#KB5l&ahO-ou8SBA}>9w0yE-1Jx~peD$)<?0BuV7&|:i2utSu+bk0U57 %fud[O');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'vzy_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
