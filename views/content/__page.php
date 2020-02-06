<?php
global $blockInfo;

$oMbView   = new \classes\General\ObjectFactory('menuBlockView');
$oBlock    = new \classes\General\ObjectFactory('block');
$oBlockMap = new \classes\General\ObjectFactory('blockBlockMap');

$cBlock    = new \controllers\Block();

$page     = 'page';
$type     = 'block';
$whichID  = 'blockID';
$pageImgs = array();
$headImgs = array();
$whichParentID = 'parent'.ucfirst($type).'LangID';

$which = explode('/',$_REQUEST['data']);

$m=0;
for($b=0; $b<count($which); $b++) {
    $eQ = '';
    if($m > 0){
        $eQ = $blockInfo->menuID;
    }else{
        $eQ = 0;
    }
    $blockInfo = $oMbView->selectSingleObject(array('blockUrl' => $which[$b], 'languageGroupID' => $langID, 'parentMenuID' =>$eQ));
    if($m==0){
        $curMainMenuID = $blockInfo->menuID;
    }

    if( ($blockInfo->parentMenuID != 0) && ($m > 0) ){
        $curParMenuID = $blockInfo->parentMenuID;
    }

    $curMenuID = $blockInfo->menuID;

    if(!isset($catIconID)){
        $catIconID = $blockInfo->blockID;
    }
    $m++;
}

if(!$blockInfo){
    $blockInfo = $oBlock->selectSingleObject(array('url' => end($which), 'languageGroupID' => $langID));
}
$block = $oBlock->selectSingleObject(array('blockID' => $blockInfo->blockID, 'languageGroupID' => $langID));

if(!$block){
    $block = $oBlock->selectSingleObject( array('urlOud' => array(end($which), '<>'), 'languageGroupID' => $langID), false, 'or-and' );
    $path  = explode('/',$_REQUEST['data']);
    $pagePath = '';
    for($p=0; $p<(count($path)-1); $p++){
        $pagePath .= $path[$p].'/';
    }
    header("HTTP/1.1 301 Moved Permanently");
    header("Location:".BASE_PATH.'/'.$pagePath.$block->url);
}

if($block){
    $checkBlockID = $block->blockID;

    if(in_array($checkBlockID, $pageGrp_A)) {

        $page = $pageA;
        $pageGrp = 'A';

    }elseif($checkBlockID == 2) {
        $page = 'about';

    }elseif($setSubBlocks == true) {
        $getSubBlocks = $oBlockMap->selectMultiObject('RAND()', array('blockID' => $checkBlockID));
        if($getSubBlocks){
            $subBlocks = array();
            foreach($getSubBlocks as $subBlock){
                $subBlock = $oBlock->selectSingleObject(array('blockID' => $subBlock->linkedBlockID, 'languageGroupID' => $langID));
                $subBlocks['block'.$subBlock->blockID] = array(
                    'title'=>$subBlock->title,
                    'text'=>\functions\Textual::leesverderwords($subBlock->content,125),
                    'url'=>'/'.$cBlock->getPath($subBlock->blockID),
                    'type'=>'block',
                    'show_button'=>$subBlock->menuTypeID ? true : false
                );
            }
        }
    }else {
        /* default */

    }

    $breadcrumbs = $cBlock->getBreadCrumbs($block->blockID);

}else{
    header("HTTP/1.0 404 Not Found");
    $page = 'error';
    $type = 'pagina';
    $meta_title = ucfirst($type).' niet gevonden';
}