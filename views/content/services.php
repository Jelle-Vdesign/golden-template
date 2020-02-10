<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/views/content/page.php';
//** hier extra's inladen */
$subBlocks = $oSubBlock->selectMultiObject('', array('linkedBlockID' => $block->blockID));
