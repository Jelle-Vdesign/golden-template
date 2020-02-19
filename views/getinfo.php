<?php
$oMenBlockVw = new \classes\General\ObjectFactory('menuBlockView');
$oBlock      = new \classes\General\ObjectFactory('block');
$oSubBlock   = new \classes\General\ObjectFactory('blockBlockView');
$oProduct    = new \classes\General\ObjectFactory('product');
$cBlock      = new \controllers\Block();

/* url request */
$load = ( isset($_REQUEST['load']) && $_REQUEST['load']) ? $_REQUEST['load'] : '';
$url  = (isset($_REQUEST['data']) && $_REQUEST['data']) ? $_REQUEST['data'] : '';

/* which content to load */
if( ($load != '')  && ($url != 'home') ) {

    $custom_query = 'AND (url = '.$url.' OR urlOud = '.$url.')';
    $block = $oBlock->selectSingleObject(array('languageGroupID' => $_SESSION['lnggID'], 'state' => 1), '', 'and', $custom_query);

    if($load == 'page') {

        if($block->blockID == 4) {
            $layout = 'services';
        } else {
            $layout = 'page';
        }
    }elseif($load == 'product') {

        $layout = 'single_product';
    }else {
        $layout = 'error';
    }

}else {

    $block = $oBlock->selectSingleObject(array('onHomepage' => 1));

    $layout = 'home';
}


//** put where needed */
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