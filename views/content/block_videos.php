<?php
$oBlckVidVw = new \classes\General\ObjectFactory('blockVideoView');

$blockVids = $oBlckVidVw->selectMultiObject('RAND()', 'blockID', $block->blockID);

if(count($blockVids)>0){
    $blockVid = array();
    $blockVid['src'] = FILE_PATH.'3/'.$blockVids[0]->fileName;
    $blockVid['state'] = $blockVids[0]->state;
    if($blockVids[0]->state==300){
        $blockVid['src_webm'] = str_replace(".mp4",".webm",$blockVid['src']);
    }
    if($blockVids[0]->thumb==1){
        $blockVid['poster'] = IMG_PATH.'filethumbs/'.$blockVids[0]->fileID.'.jpg';
    }
}