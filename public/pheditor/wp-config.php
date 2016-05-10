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
define('DB_NAME', 'pheditor');

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
define('AUTH_KEY', '4PQR3XoqLycjy3h3NmsXmP2T6HVVcDyRyNxff67AfIoPQ7HnNbq2ngWs5wwmagp1');
define('SECURE_AUTH_KEY', 'ZDnYOuCR9SBDZhchbJiNcG7vXXyp8kPuSdTSUyOigdgpRHHYQhgqESrSbkCWJO1B');
define('LOGGED_IN_KEY', 'R8fhUWNgwl57vL2ZYPqZ086ZUWWclriolt2kRi1xa3HGDADo5jtiDzUSKb0puvnp');
define('NONCE_KEY', '68KkBzX08ZGax0UZJFJ4N1GSYrd9yTQLYojA3CSNjuRfwtTV3xWWFGKtJb2mdab4');
define('AUTH_SALT', '98BfomFj2hT6nmqE6iyUNZn1S6G9I269cwxXglNbsNaJnG5lvxs1tvEfpp5gihi2');
define('SECURE_AUTH_SALT', '2vSsEtcsE8eZq5x6ZUGdTvxD62bI0qqj2ZUW2sblsx7xYoOeMaIpdNTsfNQgtWRF');
define('LOGGED_IN_SALT', 't9z7qONf0IwgpvBw1FSNY0gc1WIDYoYd1SImi98l8MMfJuOtWYIIgDBHTKn1Ug5i');
define('NONCE_SALT', 'UapUwtubTGmS7VD3qvdukYX4bfQ6rsFl08YLJTsXkWHAJJx62lwI0QXB38fhKCxu');

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

define('WP_HOME','http://www.demostrata.com/pheditor/');
define('WP_SITEURL','http://www.demostrata.com/pheditor/');

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
    define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
 