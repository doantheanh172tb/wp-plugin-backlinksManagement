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
define('DB_NAME', 'sql3204648');

/** MySQL database username */
define('DB_USER', 'sql3204648');

/** MySQL database password */
define('DB_PASSWORD', 'A12345a@#');

/** MySQL hostname */
define('DB_HOST', 'sql3.freemysqlhosting.net');

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
define('AUTH_KEY',         'B[uMmYC#?_tivDn<15V-. &Ob+4|+Lm8l]=94+J]Ri1u8V{+n6^Mi1za~m|g!`5E');
define('SECURE_AUTH_KEY',  'B{WF:ngybcZo-WPTCNNaMg;H?Jt56;)3VByz.$E_~2.k12>&)-yX0:3Dmrge:>`*');
define('LOGGED_IN_KEY',    '>5|)]tw(0LQ>+^he(^${$$xg`GtO(DiDHnxNdT,[B:zdyU2eiYC@+<OukLH9R0^;');
define('NONCE_KEY',        'V+Q5Y;N?D(!>Q>q2r7;ssP)T!Zx-JF#zvnK,+D<eGap+eD[5r-nI#%?=;n+~hD}1');
define('AUTH_SALT',        '$4|FZ^P>FRE-[Zj+%57u05p8hxZu{(53}M.!&iuCK/x5Z8l-P2K)q-%E>wtzy!+h');
define('SECURE_AUTH_SALT', '3QXxrG5d%E=S[E/Dmu6gcY14[i(:-XI/xNm[ZM~g*>AoP-H~(cSwJ,:9=~n8#U?H');
define('LOGGED_IN_SALT',   '[X,<4tBtV[FLm%1u1LhXpZt$0E?9lg,L{6Nr__UxN&`OO/4g/|/X$=B(#gTJvBu}');
define('NONCE_SALT',       '}gXX+QBf6~8IX}+))Ak>/Y<hymDj(0S(O[yqxhn^[q6=`JKf=m_N*J`iKyJQS,&e');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

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
