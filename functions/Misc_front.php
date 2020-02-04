<?php


namespace functions;


use controllers\Language;

class Misc_front extends Misc
{

    /**
     * @return string
     */
    public static function setLanguage()
    {
        $cLang = new Language();

        //** BEPAAL TAAL, GEREGELD IN HTACCESS */
        if(isset($_REQUEST['lang']) && $_REQUEST['lang']){
            $lang = $_SESSION['lang'] = $_REQUEST['lang'];
        }
        // VOOR DE ZEKERHEID. GEEN TAAL, DAN NL
        if(!isset($lang)) {
            $lang = $_SESSION['lang'] = 'nl';
        }

        $link_lang = $cLang->getLanguageLinks($lang);
        $langID    = $cLang->getLanguageID($lang);
        $_SESSION['lnggID'] = $langID;

        return $link_lang;
    }

    /**
     * @param $key
     * @param $data
     * @param array $path
     * @return array|null
     */
    public static function getKeyArray($key, $data, $path = [])
    {
        if (is_array($data)) {
            foreach ($data AS $localKey => $value) {
                $localKey = (string)$localKey;
                $localPath = array_merge($path, [$localKey]);
                if ($localKey == $key) {
                    return $localPath;
                }
                if ($nestedPath = Misc_front::getKeyArray($key, $value, $localPath)) {
                    return $nestedPath;
                }
            }
        }
        # returns NULL if $key not found
        return NULL;
    }

    /**
     * @param $path
     * @param $array
     * @return mixed
     */
    public static function getValueArray($path, $array) {
        $path = explode('.', $path); //if needed
        $temp =& $array;

        foreach($path as $key) {
            $temp =& $temp[$key];
        }
        return $temp;
    }

    /**
     * @param $path
     * @param array $array // output // toodoo::to be changed into return
     * @param null $value
     */
    public static function setValueArray($path, &$array=array(), $value=null) {
        $path = explode('.', $path); //if needed
        $temp =& $array;

        foreach($path as $key) {
            $temp =& $temp[$key];
        }
        $temp = $value;
    }

    /**
     * @param $path
     * @param $array // output // toodoo::to be changed into return
     */
    public static function unsetValueArray($path, &$array) {
        $path = explode('.', $path); //if needed
        $temp =& $array;

        foreach($path as $key) {
            if(!is_array($temp[$key])) {
                unset($temp[$key]);
            } else {
                $temp =& $temp[$key];
            }
        }
    }

    public static function addReadMore($strWaarde,$neg=false)
    {

        $negClass = '';
        if($neg==true){
            $negClass = 'neg';
        }

        $strTekst = $strWaarde;

        if(strpos($strWaarde, 'class="readmore"')!==false){

            $chunks = preg_split('/<div(.*?)class=\"readmore\">(.*?)<\/div>/s',$strWaarde,-1);

            $uniqID = uniqid().md5($strWaarde);

            $strTekst = 	'<input type="checkbox" class="read_more_state" id="RM_'.$uniqID.'"/>'.
                '<span class="read_more_wrap">'.
                $chunks[0].
                '<span class="read_more_target">'.$chunks[1].'</span>'.
                '</span>'.
                '<div class="spcr_v px12"></div>'.
                '<label for="RM_'.$uniqID.'" class="read_more_trigger '.$lang.' style1 trans_all '.$negClass.'"></label>';
        }
        return $strTekst;
    }

}