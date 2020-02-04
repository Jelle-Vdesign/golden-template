<?php
$oBlckMedVw = new \classes\General\ObjectFactory('blockMediaView');

if(isset($subBlock->blockID)) {

    $blockImgs = $oBlckMedVw->selectMultiObject('mediaGroupID DESC, sortIndex ASC', array('blockID' => $subBlock->blockID));
    if(count($blockImgs)==0){
        $blockImgs = $oBlckMedVw->selectMultiObject('mediaGroupID DESC, sortIndex ASC', array('blockID', $subBlock->parentBlockLangID));
    }
    if($blockImgs){
        $subBlocks['block'.$subBlock->blockID]['img']   = IMG_PATH.'medium/'.$blockImgs[0]->fileName;
        $subBlocks['block'.$subBlock->blockID]['img_s'] = IMG_PATH.'thumbs/'.$blockImgs[0]->fileName;
    }

}else {
    $blockImgs = $oBlckMedVw->selectMultiObject('RAND(), sortIndex ASC', array('blockID' => $block->blockID) );
}

if(count($blockImgs) == 0) {
    $blockImgs = $oBlckMedVw->selectMultiObject('RAND()', array('blockID' => $block->parentBlockLangID) );
}