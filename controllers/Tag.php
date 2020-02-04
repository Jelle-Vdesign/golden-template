<?php


namespace controllers;


class Tag
{
    public function __construct()
    {
        $this->oTag = new \classes\General\ObjectFactory('tag');
    }

    public function getTags()
    {
        $oTag = $this->oTag;

        $arrTag	  = array();

        $allTags = $oTag->selectMultiObject('tagID');

        foreach($allTags as $oTag) {
            $title = $oTag->title;
            $arrTag[$title][$oTag->languageGroupID] = $oTag->description;
        }

        return $arrTag;
    }
}