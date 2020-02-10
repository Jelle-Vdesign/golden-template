<?php
$product = $oProduct->selectSingleObject(array('url' => array($url), 'urlOud' => array($url), 'languageGroupID' => $_SESSION['lnggID'], 'state' => 1), '', 'or-and');