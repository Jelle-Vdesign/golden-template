<?php
$block  = $oBlock->selectSingleObject( array('languageGroupID' => $_SESSION['lnggID'], 'onHomepage' => 1) );
$layout = 'home';

if($block){
    $meta_title   = $block->seoTitle;
    $meta_descr   = $block->seoDescription;

}else{
    header("HTTP/1.0 404 Not Found");
    $page = 'error';
    $type = 'pagina';
    $meta_title = ucfirst($type).' niet gevonden';
}

