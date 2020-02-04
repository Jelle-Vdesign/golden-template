<?php
$oBlckFileVw = new \classes\General\ObjectFactory('blockFileView');

if( isset($subBlock->blockID) && $subBlock->blockID ) {
    $downloads = $oBlckFileVw->selectMultiObject('sortIndex ASC', array('blockID' => $subBlock->blockID, 'fileGroupID' => 1));
    if($downloads) {
        foreach($downloads as $download) {
            $subBlocks['block' . $subBlock->blockID]['downloads'][] = array(
                'title' => $download->title,
                'file' => '/download/1/' . $download->fileID . '/' . $download->name
            );
        }
    }
}else {
    $downloads = $oBlckFileVw->selectMultiObject('sortIndex ASC', array('blockID' => $block->$whichID, 'fileGroupID' => $dnwlFileGrp));
    if($downloads){
        foreach($downloads as $download){
            $download->link='/download/1/'.$download->fileID.'/'.$download->name;
        }
    }
}