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
define('DB_NAME', 'apsn');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

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
define('AUTH_KEY',         '`3ERS;uw[7}t#+UjPh~ ,[W5n<6P%wo/a+K}k,`BMH=CwLl_p*g7;J#Fs;`8[t.q');
define('SECURE_AUTH_KEY',  '1F+DLmy(%`s5mK4@5k_f-[HE5`Nr;:^,%)#aTp:?F<g]141<?bZ_(RIax/mL>vDz');
define('LOGGED_IN_KEY',    '^Q5fNKrzMtm)+@@j5m5-S-<r6I`($&16c3$}3jimOUs!q^?MEv$*u^]`LRHvsU3 ');
define('NONCE_KEY',        '* nDYZ)LMHR`8?3V&|S;*s-px4>5dWouDu[c+UVm-Bt:!Vae@-8-Of~P1)D=l#B`');
define('AUTH_SALT',        'EgH_X;9-^Di~M|`H}BzTo#-:K:-b!+ &RCHz+wYNH:snv6P?1d(zFM/5=Qy7;^)+');
define('SECURE_AUTH_SALT', 'v]1L5~^8-f@ltT-|:i^(?mD |])ee=)kg PM@INNj;,2U4t?hQ+EG$Dc@D#_IFrM');
define('LOGGED_IN_SALT',   'aq}1nHaa-HQ9|i~1l7Axv`lBE)^+L+]x:j.&>zLxBo#Uj+ybj_Rd52U;c$-60lB+');
define('NONCE_SALT',       '!pK7?[T=H2!GexU%Oit&1r_bdMJ|1I|zSA`b:B|~Ez=s4V%7P1^uDXes-1kp/>D-');
/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

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
