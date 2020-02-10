<?php
if($setInsta) {
    $oInstaVw   = new \classes\General\ObjectFactory('instaView');
    $oInstaAcc  = new \classes\General\ObjectFactory('instaAccount');

    $getInstaItems    = $oInstaVw->selectMultiObject('feedDate DESC', array(), false, '*', 9);
    $getInstaAccounts = $oInstaAcc->selectMultiObject('instaAccount');
}