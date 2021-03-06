<?php
define( 'DEBUG', true );

define( 'SUBPATH', '/dv' );
define( 'SERVER', 'http://'.$_SERVER['SERVER_NAME'] );
define( 'ABSDOMAIN', SERVER.SUBPATH.'/' );
define( 'ABSPATH', dirname(__FILE__) . '/' );
define( 'LOG_DIR', ABSPATH.'/logs');
define( 'UPLOAD_FOLDER', 'contents');
define( 'UPLOAD_DIR', ABSPATH.'/contents');
define( 'INC', ABSPATH.'/includes');

define( 'FILEFIELD', 'fileContents' );
define( 'CONS_EMPTY', -1 );

define( 'IMG_NULL', 'null.jpg' );
define( 'THUMB_W', 80 );
define( 'THUMB_H', 80 );
define( 'THUMB_SUFFIX', 'thumb' );

define( 'JSON', 'JSON', true );

// local settings
// application website: http://vampireweekend.local/deepvue/
// callback url: http://vampireweekend.local/deepvue/oauth_twitter.php

// live dev
// application website: http://dev.londondroids.com/dv/
// callback url: http://dev.londondroids.com/dv/oauth_twitter.php

/**
 * PRODUCTION
 * 
*/
define( 'CONS_KEY', 'AobKzamSYsaVA3rKAHLgQ');
define( 'CONS_SECR', 'YQmSZJaMfuH1hybhKMjPX7fBEa7LKIc7ZuhUjry834');

/**
 * DEVELOPMENT
 */
//define( 'CONS_KEY', 'ON89tMujCKM36xTd0rW8OQ');
//define( 'CONS_SECR', 'ZMITKClcEl7jgryi5mowbGa3D2t14hQAFu6PGRc');

if( preg_match('/londondroids/', $_SERVER['SERVER_NAME']) ) {
	// ** MySQL settings - You can get this info from your web host ** //
	/** The name of the database for DV */
	define('DB_NAME', 'devdroiddv');
	/** MySQL database username */
	define('DB_USER', 'devdroiddv');
	/** MySQL database password */
	define('DB_PASSWORD', 'd3vDr01dDV');
	/** MySQL hostname */
	define('DB_HOST', 'devdroiddv.db.6122217.hostedresource.com');
} else if( preg_match('/deepvue.com/', $_SERVER['SERVER_NAME']) ) {
	// ** MySQL settings - You can get this info from your web host ** //
	/** The name of the database for DV */
	define('DB_NAME', 'deepvue_com_dva');
	/** MySQL database username */
	define('DB_USER', 'pesaur10_');
	/** MySQL database password */
	define('DB_PASSWORD', 'devdroiddv');
	/** MySQL hostname */
	define('DB_HOST', '89.31.72.132');
} else {
	// ** MySQL settings - You can get this info from your web host ** //
	/** The name of the database for DV */
	define('DB_NAME', 'devdroiddv');
	/** MySQL database username */
	define('DB_USER', 'root');
	/** MySQL database password */
	define('DB_PASSWORD', 'root');
	/** MySQL hostname */
	define('DB_HOST', 'localhost');
}

require_once( INC.'/functions.php');
require_once( INC.'/dvdb.php');
require_once( INC.'/dvfe.php');

/**
 * EPITWITTER STUFF ADDED FOR CRAPPY HOSTINGSOLUTION
 * 
 */
require_once( INC.'/epitwitter/EpiCurl.php');
require_once( INC.'/epitwitter/EpiOAuth.php');
require_once( INC.'/epitwitter/EpiTwitter.php');

$table_prefix  = 'dv_';
$dvdb = new DVDB( DB_USER, DB_PASSWORD, DB_NAME, DB_HOST );

// name of the folder containing the view template
$dv_globals['dv_theme'] = 'view'; 

$dvfe = new DVFE( $dvdb );
$dvfe->set_absdomain( ABSDOMAIN );
$dvfe->set_theme( $dv_globals['dv_theme'] );

$dv_globals['dvdb'] = &$dvdb;
$dv_globals['dvfe'] = &$dvfe;

session_start();
set_dv_globals();
?>