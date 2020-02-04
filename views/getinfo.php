<?php
$page_url = BASE_PATH.'/'.( isset($_SERVER['REQUEST_URI']) ? substr($_SERVER['REQUEST_URI'], 1) : '' ); // wordt deze gebruikt??

/* WAT IN TE LADEN */
if(isset($_REQUEST['load']) && ($_REQUEST['load'] != '') ) {

	switch($_REQUEST['load']){
		
		case 'page':

		    include_once $_SERVER['DOCUMENT_ROOT'].'/views/content/page.php';
            include_once $_SERVER['DOCUMENT_ROOT'].'/views/content/block_images.php';
            include_once $_SERVER['DOCUMENT_ROOT'].'/views/content/page_images.php';
            include_once $_SERVER['DOCUMENT_ROOT'].'/views/content/header_images.php';
            include_once $_SERVER['DOCUMENT_ROOT'].'/views/content/downloads.php';
            if($setInsta == true) {
                include_once $_SERVER['DOCUMENT_ROOT'] . '/views/content/insta.php';
            }

			break;
	}
	
	if($setMeta == false){
		$meta_title = $block->seoTitle;
		$meta_descr = $block->seoDescription;
	}
	
	$form_subj = $block->title;
	if($blockImg){
		$meta_imgs = '
			<meta itemprop=image content="'.$blockImg.'">
			<meta property=og:image content="'.$blockImg.'">
			<meta name=twitter:image:src content="'.$blockImg.'">
			<meta property=og:image:width content="'.$img_width.'">
			<meta property=og:image:height content="'.$img_height.'">
		';
	}
	
}else{
    include_once $_SERVER['DOCUMENT_ROOT'].'/views/content/default.php';
    include_once $_SERVER['DOCUMENT_ROOT'].'/views/content/block_images.php';
    include_once $_SERVER['DOCUMENT_ROOT'].'/views/content/block_videos.php';
    include_once $_SERVER['DOCUMENT_ROOT'].'/views/content/page_images.php';
    include_once $_SERVER['DOCUMENT_ROOT'].'/views/content/header_images.php';
}

/* MENU OPMAKEN */
include_once $_SERVER['DOCUMENT_ROOT'].'/views/content/nav.php';

?>