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
define('DB_NAME', 'test');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'apmsetup');

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
define('AUTH_KEY',         'P8KPn iRmqwjA$nB9U<{Egl=3;Fe%MRGw[(,UAmm5qWgH:4ly<|I~0Bs#!m{CmPx');
define('SECURE_AUTH_KEY',  'Wql $.v_GEa}F+dPqbfFU<Y]JCU?d>w/T22nwM1)]x*WQ`(u+r4^d!!_ofdsn.Yk');
define('LOGGED_IN_KEY',    'oJCqr=(uM&!C^$Jk630b9aHG_HJ[d9ANM9#/Ly|Bj_V!!HT+J8kqH=?IM-6WP&XD');
define('NONCE_KEY',        '-2B209?Fu5-)AH9w17M($Ju:Q_`>mg+eS*Lgw=sk99x|9d1/3Iub_q)AD,sCsImY');
define('AUTH_SALT',        '2C/15|YSxCTM65T*hU%ZET?@A`Po3s+XfL5<7|+~rz| (K_PV +=Q!4cQ[2o|!G+');
define('SECURE_AUTH_SALT', 'E8p!e|].!=FL?x%8FZ~z]g[d.CabvYfp[q+Wf@fKsh^3pcW[[~Qo8@:>|a<]ZPHV');
define('LOGGED_IN_SALT',   '@Q)y@+>S+7;wWW-$U11{^UU6CU-zf<j?8Q||z7`b~P<.YF0lCx5*Fkx4d+#`C?uD');
define('NONCE_SALT',       '38NN5RbX?A+{+b9QtF5YBj%5E[|tM.DY9|qt6Dnx`%6bi`G$.-KC#(fbbLdtg||z');

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
