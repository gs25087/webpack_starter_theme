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

// ** MySQL settings ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'local' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', 'root' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'eTdbB0BaJMJtjUhqoqniLIeI2PGfI5x+dd99tnhvZLJl2+wS8K7bNiqq+HWtvwzNyOFa1BnP1IYRWQWgmK/thQ==');
define('SECURE_AUTH_KEY',  '75HbxZSHlTWcvWD583uzXbI9UbNu+YnzWmYP9PPiUSN8J6cGGT0F3w9hI47g9OocEngbPodvi3gLEHlEZn1QIg==');
define('LOGGED_IN_KEY',    'peUANhkzvgSwce9aN7s3oBINjGj5lcppTV1aQB47f6e70+Ys07724JxcGQmJ02jQhfFZh85X4FTKfaSBee2LEQ==');
define('NONCE_KEY',        '1eFmvpuX4Ld/JpEhYu97YVTGk/kyIKQsX4xl75kZ9wB8r1bNBW9ZvPjMFq2smra98LVEcpXGV0dHkbjZmwZsAQ==');
define('AUTH_SALT',        'IsQ4h+mBzFaaGYaihcRy1I6EsSJepBzebYxr5WHC7+paCsir2QArBn+js/YraEYAxLT5bNGrr4J3hMmb3hp0lw==');
define('SECURE_AUTH_SALT', 'wrjJ1eUCgNMDoDWXdS3LtoqKmXsmBGiXiq+Tl2/5wloP9odcs8OemBAxwR5193TwS3aQToNPvHjuTDBS1wE4+Q==');
define('LOGGED_IN_SALT',   'to3eLheoSdxyldBCDmVdc88Bxm30xY0YlAUsm2wJoGR9+gSpIf6twWKSmnnGuCCjvDRw543YOBOZnaXrRL6RHw==');
define('NONCE_SALT',       'lq7wsEYAMXRf0Y86ooWy+UMa7zXuC35O/rF61HBtokcIiRmhlGK9kcu9+7hZ3nlFI+DEwBBVzhQLADyhGh+pKg==');

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';


define( 'WP_DEBUG', true );

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) )
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
