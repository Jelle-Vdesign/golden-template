<?php
/* ==========================================================
 * CLIENT FRONTEND SETTINGS ONLY
 * ========================================================== */

require_once $_SERVER['HOME'].'/v3leo/leo_config.php';

/* ==========================================================
 * defining client variables
 *  ========================================================== */
// SEO defaults
define('PAGETITLE', 'Template Basic');
define('PAGEDESCR', '');
define('PAGEIMG', 'logo.png' );

define('DEFAULT_LANG', 1);
define('LOGIN_IDENTIFIER_SALT', '&^7ags5as');

//** set owner mail data
define('OWNER_MAIL', '');
define('OWNER_MAIL_REPLY', ''); // set for and if mailing

/* ==========================================================
 * setting global variables
 *  ========================================================== */
$bot_tags = '
	<meta name="robots" content="index,follow"/>
	<meta name="revisit-after" content="1 day"/>
	<meta name="google" content="notranslate"/>
';
$ga_tagID = 'XXUA-150127507-1';
$setMeta  = false;

$setSubBlocks = false;
$setInsta     = true; //** use of insta feed | boolean */

$headImgGrp  = 2; //** which media album ID for header */
$defMedGrp   = 2; //** which default media album ID */
$medGrpIDs   = '9, 10';
$max_pageImg = 3;
$max_hdrImg  = 4;
$dnwlFileGrp = 1;

$pageGrp_A   = array(); //** when use of ID in group of pages IDs */
$pageA       = '';

$svg_version = 'v1'; // version of svg file
$css_version = 'v1'; // version of css file
$js_version  = 'v1'; // version of js file
if( (defined('TESTING') && (defined('TESTING') == false) ) || !defined('TESTING') ) {
    $css_ext = $css_version.'_min';
    $js_ext  = $js_version.'_min';
}else {
    $css_ext = $css_version;
    $js_ext  = $js_version;
}
$css_file  = $static_path.'/stylesheets/css/main.min.css'; // $static_path.'/css/leo-vd_'.$css_ext.'.css?'.uniqid(); //  // 
$js_file   = $static_path.'/js/leo-vd_'.$js_ext.'.js?'.uniqid();

$logo_file = $static_path.'/images/leo-vd_logo.jpg';
$svg_file  = $static_path.'/images/leo-vd_'.$svg_version.'.svg';
