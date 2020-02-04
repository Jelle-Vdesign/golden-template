<?php
$oBlckMedVw = new \classes\General\ObjectFactory('blockMediaView');

if(isset($checkBlockID) && $checkBlockID) {
    if($pageGrp == 'A') {
        $pageImgs = $oBlckMedVw->selectMultiObject('RAND()', array('blockID' => $block->$whichID, 'mediaGroupID' => $defMedGrp));
    }else {
//        $pageImgs = $oBlckMedVw->selectMultiObject('RAND()', array('mediaGroupID' => array($medGrpIDs), 'blockID' => $checkBlockID), 'or-and');
        $pageImgs = $oBlckMedVw->selectMultiObject('RAND()', array('blockID' => $checkBlockID, 'mediaGroupID'=> $defMedGrp));
    }
}else {
    $pageImgs = $oBlckMedVw->selectMultiObject('mediaGroupID DESC, sortIndex ASC', array('blockID' => $block->blockID, 'mediaGroupID' => $defMedGrp));
}
if(!empty($pageImgs)) {
    foreach($pageImgs as $key => $img) {
        if(!isset($blockImg)) {
            $blockImg   = IMG_PATH . 'medium/' . $img->fileName;
            $blockImg_l = IMG_PATH . $img->fileName;
            list($img_width, $img_height) = getimagesize(REAL_IMG_PATH . 'medium/' . $img->fileName);
        }
        $img->src_t = IMG_PATH . 'thumbs/' . $img->fileName;
        $img->src   = IMG_PATH . 'medium/' . $img->fileName;
        $img->src_l = IMG_PATH . $img->fileName;
        $img->title = $img->metaData;
    }
}
if(isset($pageImgs) && count($pageImgs) > $max_pageImg){
    $pageImgs = array_slice($pageImgs, 0, $max_pageImg);
}
