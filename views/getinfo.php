<?php
$oMenBlockVw = new \classes\General\ObjectFactory('menuBlockView');
$oBlock      = new \classes\General\ObjectFactory('block');
$oSubBlock   = new \classes\General\ObjectFactory('blockBlockView');

/* url request */
$load = ( isset($_REQUEST['load']) && $_REQUEST['load']) ? $_REQUEST['load'] : '';
$url   = (isset($_REQUEST['data']) && $_REQUEST['data']) ? $_REQUEST['data'] : '';

/* MENU */
$menuBlockItems = $oMenBlockVw->selectMultiObject('parentMenuID ASC, menuSortIndex ASC', array('menuTypeID' =>3, 'showitem' => 1, 'languageGroupID' => $_SESSION['lnggID']));

/* PAGES */
$block = $oBlock->selectSingleObject( array('url' => array($url), 'urlOud' => array($url), 'languageGroupID' => $_SESSION['lnggID'], 'state' => 1),  '', 'or-and' );

/* default value */
$layout = 'page';

/* which content to load */
if( ($load != '')  && ($url != 'home') ) {

    if($load == 'page') {
        if($block->blockID == 4) {
            $layout = 'services';
        }
    }

}else {
    $layout = 'home';
    include_once $_SERVER['DOCUMENT_ROOT'] . '/views/content/home.php';

}

//include_once $_SERVER['DOCUMENT_ROOT'].'/views/content/header_images.php';
//include_once $_SERVER['DOCUMENT_ROOT'].'/views/content/page_images.php';
//include_once $_SERVER['DOCUMENT_ROOT'].'/views/content/block_images.php';
//include_once $_SERVER['DOCUMENT_ROOT'].'/views/content/block_videos.php';
//include_once $_SERVER['DOCUMENT_ROOT'].'/views/content/downloads.php';
//
//if($blockImg){
//    $meta_imgs = '
//        <meta itemprop=image content="'.$blockImg.'">
//        <meta property=og:image content="'.$blockImg.'">
//        <meta name=twitter:image:src content="'.$blockImg.'">
//        <meta property=og:image:width content="'.$img_width.'">
//        <meta property=og:image:height content="'.$img_height.'">
//    ';
//}

//** allowed to move where need */
if($setInsta == true) {
    include_once $_SERVER['DOCUMENT_ROOT'] . '/views/content/insta.php';
}

if($block) {
    $meta_title = $block->seoTitle;
    $meta_descr = $block->seoDescription;
}
else{
    header("HTTP/1.0 404 Not Found");
    $page = 'error';
    $type = 'pagina';
    $meta_title = ucfirst($type).' niet gevonden';
}




?>