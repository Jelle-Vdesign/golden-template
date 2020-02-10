<?php
if( ($load != '')  && ($url != 'home') ) {
    $block = $oBlock->selectSingleObject(array('url' => array($url), 'urlOud' => array($url), 'languageGroupID' => $_SESSION['lnggID'], 'state' => 1), '', 'or-and');
}else {
    $block  = $oBlock->selectSingleObject(array('onHomepage' => 1));
}

