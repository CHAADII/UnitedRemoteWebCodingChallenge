<?php
/**
 * Created by PhpStorm.
 * User: chadi
 */

define('_DEBUG', true);
define('_VERBOSE', true);
define('_SECURE', false);
define('_ART_USER', "Shops_USER");
define('_SESSION_COOKIE', 'USERS');

date_default_timezone_set('UTC');

$_paths = array();
$_paths['assets'] = '/ShopsNearBy/assets/';

$_datasrc=array();
$_datasrc['host'] = 'localhost';
$_datasrc['db_name'] = 'Shops';
$_datasrc['username'] = 'chadi';
$_datasrc['password'] = 'ps3_chadi';
$_datasrc["charset"] = "utf8mb4";

$_website=array();
$_website['keywords'] = 'Shops Nearby';
$_website['description'] = 'Shops Nearby';
$_website['owner'] = 'BENTALEB CHADI';
$_website['author'] = 'CHADI BENTALEB';
$_website['designer'] = 'CHADI BENTALEB';
$_website['copyright'] = 'Copyright © ' . date('Y') . ' ' . $_website['owner'] . ', all rights reserved.';

?>
