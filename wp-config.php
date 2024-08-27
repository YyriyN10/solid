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
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'solid' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'password' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

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
define( 'AUTH_KEY',         ';(Ip{ziKxp8YosVrSrbE5Fs5:U*_/K+6>33N>,4{A{EEW!Xn[2ufFj%c4tIit4no' );
define( 'SECURE_AUTH_KEY',  '-Dy~>p3LuFDs$,$5Q4U/&{2~]Jy`Kq%dz~~ik5e#~=;JQD/w1iIEjjp?*PRb*8<.' );
define( 'LOGGED_IN_KEY',    'g{]y ?&6((18NPq5>b&xk#N(gg:H5H:o^Q%q;a3MFcL+7d-_WkxRE3(.n {xgzpg' );
define( 'NONCE_KEY',        '+Ep<,rCjP:U,Zd/<6e%!Yxu7,advb}Q64g9{}sWZ{-FwwdXO3EZ)=lZ d4^i5^Cq' );
define( 'AUTH_SALT',        'OD}~iHckkB3sOW`LB&Hncpp%S&8:b8)c{HB5n}7BF~F9XPO*?UA[v0WV:}{ns~jZ' );
define( 'SECURE_AUTH_SALT', ';Z0HK]sSnHPyMi;B{`Ez5tJY; 7qkK_6cFiNbRQQ^om`A |B$mBg(1h/#MoO6+gc' );
define( 'LOGGED_IN_SALT',   'ONAI*[vWGB),9]fjP>l^GR^YuKUY,VHM/Cn}-3{|t0Fa,Ky-p,Z~0^/8hG_Gz.DL' );
define( 'NONCE_SALT',       'h7KX%s&waK0dtJKLfX:b~_tZw>$O|m1BEn#wyE5-4T]4~q;i/z U4&f)-I $H/kL' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'yusmso_';

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
define( 'WP_DEBUG', true );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';

/** Завантаження плагинів та обновлень без FTP. */
define('FS_METHOD', 'direct');

/* Вимкнення редагування файлів в адмінпанелі WP */
define('DISALLOW_FILE_EDIT', true);