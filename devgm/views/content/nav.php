<?php
$oMenBlockVw  = new \classes\General\ObjectFactory('menuBlockView');
$oBlockFileVw = new \classes\General\ObjectFactory('blockFileView');

$cBlock    = new \controllers\Block();

$this_hour = date("Hdmy");

//** MAIN MENU */
$contact_link = $cBlock->getPath(6);
$agenda_link  = $cBlock->getPath(2);
$nieuws_link  = $cBlock->getPath(3);

$mainmenuItems = $oMenBlockVw->selectMultiObject('parentMenuID ASC, menuSortIndex ASC', array('menuTypeID' =>3, 'showitem' => 1, 'languageGroupID' => $_SESSION['lnggID']));

foreach($mainmenuItems as $mainmenuItem){

    $mi++;

    $show_menu_options = false;

    if($mainmenuItem->parentMenuID == 0)
    {
        $class    = '';
        $link     = false;
        $url_pref = '';

        if($mainmenuItem->blockUrl == NULL){
            $mainmenuItem->blockUrl = \functions\Path::makeUrl($mainmenuItem->menuTitle);
        }

        if( ($mainmenuItem->hasBlock == 1) && ($mainmenuItem->blockID) ){
            $link = true;
        }

        $icon = $mainmenuItem->menuID;
        if($mainmenuItem->parentMenuLangID != 0){
            $icon = $mainmenuItem->parentMenuLangID;
        }

        $mainmenu[$mainmenuItem->menuID] = array('menuID'=>$mainmenuItem->menuID,'icon'=>$icon,'parentMenuID'=>$mainmenuItem->parentMenuID,'title'=>$mainmenuItem->menuTitle,'url'=>$url_pref.'/'.$mainmenuItem->blockUrl,'blockID'=>$mainmenuItem->blockID,'showOptions'=>$show_menu_options, 'class'=>$class, 'link'=>$link, 'target'=>'', 'hasBlock'=>$mainmenuItem->hasBlock);

        if($mainmenuItem->menuID == 1) {
            $link  = true;
            $check = \functions\Misc_front::getKeyArray($mainmenuItem->menuID,$mainmenu);
            if($check){
                $check     = implode(".", $check);
                $downloads = $oBlockFileVw->selectMultiObject('sortIndex ASC', array('blockID' => 5, 'fileGroupID' => 2));
                foreach($downloads as $subCat){
                    $url = 'javascript:;" data-fancybox="" data-type="iframe" data-src="/lib/pdf_viewer/web/viewer.html?pagemode=none&file='.FILE_PATH.$subCat->fileGroupID.'/'.$subCat->fileID.'_'.$subCat->name;
                    \functions\Misc_front::setValueArray($check.'.subs.'.$subCat->fileID,$mainmenu,array('menuID'=>$subCat->fileID,'icon'=>'','title'=>strtolower($subCat->title),'url'=>$url,'hasBlock'=>false,'link'=>$link));
                }
            }
        }

    }else{
        $check = \functions\Misc_front::getKeyArray($mainmenuItem->parentMenuID,$mainmenu);
        if($check){
            $check        = implode(".",$check);
            $old_menu_url = \functions\Misc_front::getValueArray($check.'.url',$mainmenu).'/';
            $link         = false;
            if($mainmenuItem->hasBlock==1 && $mainmenuItem->blockID){
                $link = true;
            }
            \functions\Misc_front::setValueArray($check.'.subs.'.$mainmenuItem->menuID,$mainmenu,array('menuID'=>$mainmenuItem->menuID,'icon'=>$icon,'parentMenuID'=>$mainmenuItem->parentMenuID,'title'=>$mainmenuItem->menuTitle,'url'=>$old_menu_url.$mainmenuItem->blockUrl,'blockID'=>$mainmenuItem->blockID,'hasBlock'=>$mainmenuItem->hasBlock, 'link'=>$link));
        }
    }
}
$_SESSION['mainmenu'][$lang][$this_hour] = $mainmenu;

//** FOOTER MENU */
$footermenuItems = $oMenBlockVw->selectMultiObject('parentMenuID ASC, menuSortIndex ASC', array('menuTypeID' => 8, 'showitem' => 1, 'languageGroupID' => $_SESSION['lnggID']));
$old_menu_url = '';
foreach($footermenuItems as $mainmenuItem){

    if($mainmenuItem->parentMenuID==0){

        if($mainmenuItem->blockUrl==NULL){
            $mainmenuItem->blockUrl = \functions\Path::makeUrl($mainmenuItem->menuTitle);
        }

        $footermenu[$mainmenuItem->menuID] = array('menuID'=>$mainmenuItem->menuID,'parentMenuID'=>$mainmenuItem->parentMenuID,'title'=>$mainmenuItem->menuTitle,'url'=>'/'.$mainmenuItem->blockUrl,'blockID'=>$mainmenuItem->blockID);
    }
}
$_SESSION['footermenu'][$lang][$this_hour] = $footermenu;


if(isset($curParMenuID) && $curParMenuID!='') {
    $pagemenuItems = $oMenBlockVw->selectMultiObject('parentMenuID ASC, menuSortIndex ASC', array('menuTypeID' => 3, 'parentMenuID' => $curParMenuID, 'showitem' => 1, 'languageGroupID' => $_SESSION['lnggID']));
    foreach($pagemenuItems as $key=>$menuitem){
        if($menuitem->hasBlock==0 || $menuitem->blockID=='') {
            unset($pagemenuItems[$key]);
        }else{
            if($menuitem->parentMenuID==0){
                if($menuitem->blockUrl==NULL){
                    $menuitem->blockUrl = \functions\Path::makeUrl($menuitem->menuTitle);
                }
            }else{
                $check = \functions\Misc_front::getKeyArray($menuitem->parentMenuID,$mainmenu);
                if($check){
                    $check = implode(".",$check);
                    $old_menu_url = \functions\Misc_front::getValueArray($check.'.url',$mainmenu).'/';
                    $menuitem->blockUrl = $old_menu_url.$menuitem->blockUrl;
                }
            }
        }
    }
}

