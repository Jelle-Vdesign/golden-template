<?php
/* MENU */
$menuBlockItems = $oMenBlockVw->selectMultiObject('parentMenuID ASC, menuSortIndex ASC', array('menuTypeID' =>3, 'showitem' => 1, 'languageGroupID' => $_SESSION['lnggID']));