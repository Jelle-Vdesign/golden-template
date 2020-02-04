<?php


namespace controllers;


class Language
{
    public function __construct()
    {
        $this->oLang = new \classes\General\ObjectFactory('languageGroup');

    }

    public function getLanguageLinks($defLang)
    {
        $oLang = $this->oLang;

        $languages = $oLang->selectMultiObject('languageGroupID ASC');
        $link_lang = '';

        foreach($languages as $lang_item){

            if($lang_item->language != $defLang) {
                $link_lang .= '<link rel="alternate" href="/'.$lang_item->language.'" hreflang="'.$lang_item->language.'"/>'."\r\n";
            }
        }
        $lang_link = '<link rel="alternate" href="/'.$defLang.'" hreflang="x-default"/>'."\r\n";

        if(!empty($link_lang)) {
            $lang_link .= $link_lang;
        }
        return $lang_link;
    }

    public function getLanguageID($lang)
    {
        $oLang = $this->oLang;

        $language = $oLang->selectSingleObject( array('language' => strtolower($lang)) );

        $langID = $language->languageGroupID;

        return $langID;
    }
}