<?php


namespace controllers;


class Block
{
    public function __construct()
    {
        $this->oMenuBlockVw = new \classes\General\ObjectFactory('menuBlockView');
        $this->oBlock       = new \classes\General\ObjectFactory('block');
    }

    public function getPath($blockID)
    {
        $oMenuBlockVw = $this->oMenuBlockVw;
        $oBlock       = $this->oBlock;

        $path = array();

        $blockInfo = $oMenuBlockVw->selectSingleObject(array('blockID' => $blockID));
        if($blockInfo){
            $parentMenuID = $blockInfo->parentMenuID;
            $path[] = $blockInfo->blockUrl;

            while($parentMenuID!=0) {
                $blockInfo = $oMenuBlockVw->selectSingleObject(array('menuID' => $blockInfo->parentMenuID));
                $path[] = $blockInfo->blockUrl;
                $parentMenuID = $blockInfo->parentMenuID;
            }
        }else{
            $blockInfo = $oBlock->selectSingleObject(array('blockID' => $blockID));
            $path[] = $blockInfo->url;
        }
        $return = implode('/',array_reverse($path));

        return $return;
    }

    public function getBreadCrumbs($blockID)
    {
        $oMenuBlockVw = $this->oMenuBlockVw;
        $oBlock       = $this->oBlock;
        $breadcrumbs = array();

        $blockInfo = $oMenuBlockVw->selectSingleObject(array('blockID' => $blockID));
        if($blockInfo){
            $parentMenuID = $blockInfo->parentMenuID;
            $link = $blockInfo->blockID ? true : false;
            $breadcrumbs[] = array(
                'title'=>$blockInfo->menuTitle,
                'url'=>$blockInfo->blockUrl,
                'link'=>$link
            );

            while($parentMenuID!=0) {
                $blockInfo = $oMenuBlockVw->selectSingleObject(array('menuID' => $blockInfo->parentMenuID));
                $link = $blockInfo->blockID ? true : false;
                $breadcrumbs[] = array(
                    'title'=>$blockInfo->menuTitle,
                    'url'=>$blockInfo->blockUrl,
                    'link'=>$link
                );
                $parentMenuID = $blockInfo->parentMenuID;
            }
        }else{
            $blockInfo = $oBlock->selectSingleObject(array('blockID' => $blockID));
            $breadcrumbs[] = array(
                'title'=>$blockInfo->menuTitle,
                'url'=>$blockInfo->blockUrl,
                'link'=>false
            );
        }

        $breadcrumbs = array_reverse($breadcrumbs);

        return $breadcrumbs;
    }
}