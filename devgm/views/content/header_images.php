<?php
$oBlckMedVw = new \classes\General\ObjectFactory('blockMediaView');

if(isset($checkBlockID) && $checkBlockID) {

    if($pageGrp == 'A') {
        $headImgs = $oBlckMedVw->selectMultiObject('RAND()', array('blockID' => $block->$whichID, 'mediaGroupID' => $headImgGrp));
    }else {
        $headImgs = $oBlckMedVw->selectMultiObject('RAND()', array('blockID' => $checkBlockID, 'mediaGroupID' => $headImgGrp));
    }

}else {
    $headImgs = $oBlckMedVw->selectMultiObject('RAND()', array('blockID' => $block->blockID, 'mediaGroupID' => $headImgGrp));
}

if($headImgs) {
    foreach($headImgs as $key => $img) {
        if(!isset($headImg)) {
            $headImg   = IMG_PATH . 'medium/' . $img->fileName;
            $headImg_s = IMG_PATH . 'thumbs/' . $img->fileName;
            $headImg_l = IMG_PATH . $img->fileName;

            if(file_exists(REAL_IMG_PATH . 'medium/' . $img->fileName)) {
                list($img_width, $img_height) = getimagesize(REAL_IMG_PATH . 'medium/' . $img->fileName);
            }else {
                e_print(REAL_IMG_PATH . 'medium/' . $img->fileName);
            }
        }
        $img->src_t = IMG_PATH . 'thumbs/' . $img->fileName;
        $img->src   = IMG_PATH . 'medium/' . $img->fileName;
        $img->src_l = IMG_PATH . $img->fileName;
        $img->title = $img->metaData;
    }
}
if(isset($headImgs) && (count($headImgs) > $max_hdrImg)) {
    $headImgs = array_slice($headImgs, 0, $max_hdrImg);
}

if($headImg) {
    $meta_imgs = '
            <meta itemprop=image content="' . $headImg . '">
            <meta property=og:image content="' . $headImg . '">
            <meta name=twitter:image:src content="' . $headImg . '">
            <meta property=og:image:width content="' . $img_width . '">
            <meta property=og:image:height content="' . $img_height . '">
            ';
}