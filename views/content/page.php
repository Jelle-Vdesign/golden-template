<?php
$url   = (isset($_REQUEST['data']) && $_REQUEST['data']) ? $_REQUEST['data'] : '';
$block = $oBlock->selectSingleObject( array('url' => array($url), 'urlOud' => array($url), 'languageGroupID' => $_SESSION['lnggID'], 'state' => 1),  '', 'or-and' );

$layout = 'page';

if($block) {




}else{
    header("HTTP/1.0 404 Not Found");
    $page = 'error';
    $type = 'pagina';
    $meta_title = ucfirst($type).' niet gevonden';
}

