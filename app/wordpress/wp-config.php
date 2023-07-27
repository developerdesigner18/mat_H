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
define( 'DB_NAME', 'mat_h_bizplan' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

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
define( 'AUTH_KEY',         'KEd+vE`GQ<E&:b]EfQ5~M[4li&U)pEPR~ON; +*b*n!Q:6+IpNj8qR?3Bc2z#7Dv' );
define( 'SECURE_AUTH_KEY',  'hWI,cw^-./<Zud#y^lCsCX]|})GGn3-t?WsuFqt3Lij[T/m2!J+~CK`O8u[Mg``z' );
define( 'LOGGED_IN_KEY',    'V)qozc5M{&mk`GQM)P (K;(mf 8n`Z6rM]7xvs@54^uTOg04y.1G4lvp<>F@W2GP' );
define( 'NONCE_KEY',        'g/<Hf|)`r;C7`Y2;)e7e}OxV3I@k`B^=>4DbIH``>Nd~{ifRpD?SBv6*-z3.]&KI' );
define( 'AUTH_SALT',        'FVM^Syl22[XV+=1FG3n:^53M8xk/CNpFJ.)S_*T2UF^w-y- Ea;RV*-BJGWP>p+N' );
define( 'SECURE_AUTH_SALT', 'S>3eIs#Ulx7LR_xCH&$H~@amxCJGL*daQyMu=+5@Jrq~BR8yi4cb0SK`XROubaz7' );
define( 'LOGGED_IN_SALT',   '7} lwD/p6`V2KpXeCpI--[,_GzRx7TIsm=Q|D,Izp3m/q;,GRE5<2FBFz)rnLc<P' );
define( 'NONCE_SALT',       '4pQ3p;X6-$HukX-c{4+a<K3(,R]>0)QJhA1m#GGSYv1jVF5NksrL$G%fHfM r1Xh' );

/**#@-*/

/**
 * WordPress database table prefix.
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
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
