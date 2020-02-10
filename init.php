<?php
/*
 * BASIC TEMPLATE
 * TO BE USED WITH CMS (> 2.5.10)
 * AND V3LEO
 *
 * FRONTEND STUFF ONLY
 */
/* ==========================================================
 * debugging
 *  ========================================================== */
//ini_set('display_errors', '1');// deze moet eruit, indien geen test op live is

define('TESTING', true);
define('TEST_MAIL', 'lianne@veenstra.design');
if(TESTING == true) {
    ini_set('display_errors', '1');
}else {
    require_once realpath(__DIR__).'/meta/optimize.php';
}

/* ==========================================================
 * client-only constants and variables include
 *  ========================================================== */
require_once $_SERVER['HOME'].'/cms/owner_config.php'; // cms and web
// static path
$static_path = (TESTING == true) ? '//devgm.'.UPLOAD_DOMAIN : STATIC_PATH;
require_once realpath(__DIR__).'/config_vd.php'; // only web

/* ==========================================================
 * autoload classes
 *  ========================================================== */

$frontPath = FRNT_PATH;


spl_autoload_register(function ($class_name)
{
    global $frontPath;
    $v3path     = V3_PATH;
    $class_name = str_replace('\\', '/', $class_name);

    if(file_exists($frontPath.$class_name . '.php')) {
        include_once $frontPath . $class_name . '.php';
    }else {
        include_once $v3path.$class_name . '.php';
    }
});

/* ==========================================================
 * defining frontend-only variables
 *  ========================================================== */
if(isset($_SERVER["HTTP_HOST"])){
    define( 'BASE_PATH', '//'.$_SERVER["HTTP_HOST"] );
    define( 'BASE_IMG_PATH', '//'.$_SERVER["HTTP_HOST"].'/uploads/images/' );
    define( 'BASE_FILE_PATH', '//'.$_SERVER["HTTP_HOST"].'/uploads/files/' );
}

/* ==========================================================
 * declaring global variables
 *  ========================================================== */
$menuBlockItems = new stdClass();
$subBlocks      = new stdClass();
$products       = new stdClass();
$layout         = '';


$checkGoogleBot = true;
$preload        = array();
$meta_title     = PAGETITLE;
$meta_descr     = '';
$mask_icon_clr  = '#5bbad5';
$theme_clr      = '#ffffff';
$meta_imgs      = '';
$meta_extra     = '';
$mainmenu       = array();
$maincats       = array();
$footermenu     = array();
$mi             = 0;
$icon           = '';
$curMainMenuID  = 0;
$old_menu_url   = '';
$blockImg       = '';
$blockImgsCount = 0;
$atf_css        = '';
$block          = new stdClass();
$subBlock       = new stdClass();
$pageGrp        = '';
$img_width      = 0;
$img_height     = 0;
$t              = 0;
$subm_id        = 0;
$submf_id       = 0;
$curCatID       = '';
$curProductID   = '';
$curMenuGet     = '';
$getInstaAccounts = new stdClass();
$getInstaItems  = array();
$date           = '';
$js_ext         = '';
$css_ext        = '';
$pageImgs       = array();
$pageVids       = array();
$logo_file      = '';


/* ==========================================================
 * setting global variables
 *  ========================================================== */
// Language
$link_lang = \functions\Misc_front::setLanguage();
$langID    = $_SESSION['lnggID'];
// Language labels
$cTag = new \controllers\Tag();
$tags = $_SESSION['tags'] = $cTag->getTags(); //use as: $tags[title][$langID]


/* ==========================================================
 * set local settings
 *  ========================================================== */
$lang = $_SESSION['lang'];
setlocale(LC_ALL, $lang.'_'.strtoupper($lang));
date_default_timezone_set('Europe/Amsterdam');
