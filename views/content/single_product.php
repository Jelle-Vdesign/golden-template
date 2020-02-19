<?php
$custom_query = 'AND (url = "'.$url.'" OR urlOud = "'.$url.'")';
$product = $oProduct->selectSingleObject(array('languageGroupID' => $_SESSION['lnggID'], 'state' => 1), '', 'and', $custom_query);