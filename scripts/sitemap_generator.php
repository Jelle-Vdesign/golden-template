<?php
require_once $_SERVER['HOME'].'/httpdocs/init.php';
require_once $_SERVER['HOME'].'/httpdocs/lib/simple_html_dom.php';

// Set the output file name.
$xml_file = 'sitemap.xml';
$file     = $_SERVER['HOME'].'/httpdocs/'.$xml_file;

// Set the start URL. Here is http used, use https:// for
// SSL websites.
$start_url = URL_PREFIX.'//'.OWNER_URL.'/';

// Set true or false to define how the script is used.
// true:  As CLI script.
// false: As Website script.
define ('CLI', false);

// Define here the URLs to skip. All URLs that start with
// the defined URL will be skipped too.
// Example: "http://iprodev.com/print" will also skip
// http://iprodev.com/print/bootmanager.html
$skip = array (
    URL_PREFIX.'//'.OWNER_URL.'/download',
    URL_PREFIX.'//'.OWNER_URL.'/views',
    URL_PREFIX.'//'.OWNER_URL.'/storing',
    URL_PREFIX.'//'.OWNER_URL.'/uploads'
              );

$skip_exclude = array (
    URL_PREFIX.'//'.OWNER_URL.'/privacyverklaring.pdf'
              );

$skip_404 = array ();

// Define what file types should be scanned.
$extension = array (
                     "/"
                   );

// Scan frequency
$freq = "daily";

// Page priority
$priority = "1.0";

// Init end ==========================

define ('VERSION', "1.0");
define ('NL', CLI ? "\n" : "\n");

function get_http_response_code($url) {
    $agent = "Mozilla/5.0 (compatible; Groenewold Media XML Sitemap Generator/" . VERSION . ", https://groenewold.media)";
    $ch = curl_init();
    curl_setopt ($ch, CURLOPT_URL, $url);
    curl_setopt ($ch, CURLOPT_USERAGENT, $agent);
    curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt ($ch, CURLOPT_NOBODY, 0);
    curl_setopt ($ch, CURLOPT_TIMEOUT, 5);
    curl_setopt ($ch, CURLOPT_FOLLOWLOCATION, 1);
    $respPage['page'] = curl_exec($ch);
    $respPage['httpCode'] = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    return $respPage;
}

function rel2abs($rel, $base) {
    if(strpos($rel,"//") === 0) {
        return URL_PREFIX.$rel;
    }
    /* return if  already absolute URL */
    if  (parse_url($rel, PHP_URL_SCHEME) != '') return $rel;
    $first_char = substr ($rel, 0, 1);
    /* queries and  anchors */
    if ($first_char == '#'  || $first_char == '?') return $base.$rel;
    /* parse base URL  and convert to local variables:
    $scheme, $host,  $path */
    extract(parse_url($base));
    /* remove  non-directory element from path */
    $path = preg_replace('#/[^/]*$#',  '', $path);
    /* destroy path if  relative url points to root */
    if ($first_char ==  '/') $path = '';
    /* dirty absolute  URL */
    $abs =  "$host$path/$rel";
    /* replace '//' or  '/./' or '/foo/../' with '/' */
    $re =  array('#(/.?/)#', '#/(?!..)[^/]+/../#');
    for($n=1; $n>0;  $abs=preg_replace($re, '/', $abs, -1, $n)) {}
    /* absolute URL is  ready! */
    return  $scheme.'://'.$abs;
}

function GetUrl ($url) {
    $agent = "Mozilla/5.0 (compatible; Groenewold Media XML Sitemap Generator/" . VERSION . ", https://groenewold.media)";

    $ch = curl_init();
    curl_setopt ($ch, CURLOPT_AUTOREFERER, true);
    curl_setopt ($ch, CURLOPT_URL, $url);
    curl_setopt ($ch, CURLOPT_USERAGENT, $agent);
    curl_setopt ($ch, CURLOPT_VERBOSE, 0);
    curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
    curl_setopt ($ch, CURLOPT_HEADER, 0);
    curl_setopt ($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, 5);

    $data['page'] = curl_exec($ch);

    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $data['code'] = $httpCode;
    curl_close($ch);

    return $data;
}

function Scan ($url) {
    global $start_url, $scanned, $pf, $extension, $skip, $skip_exclude, $freq, $priority;

    $url = filter_var ($url, FILTER_SANITIZE_URL);

    if (!filter_var ($url, FILTER_VALIDATE_URL) || in_array ($url, $scanned)) {
        return;
    }

    array_push ($scanned, $url);

    $dataGet = GetUrl ($url);

    if($dataGet['code']=='200'){

        //echo $url . NL;
        $html = str_get_html ($dataGet['page']);

        $a1   = $html->find('a');

        foreach ($a1 as $val) {
            $next_url = $val->href or "";

            $fragment_split = explode ("#", $next_url);
            $next_url       = $fragment_split[0];

            if ((substr ($next_url, 0, 7) != "http://")  &&
                (substr ($next_url, 0, 8) != "https://") &&
                (substr ($next_url, 0, 6) != "ftp://")   &&
                (substr ($next_url, 0, 7) != "mailto:"))
            {
                $next_url = @rel2abs ($next_url, $url);
            }
            $next_url = rtrim($next_url,"/");
            $next_url = filter_var ($next_url, FILTER_SANITIZE_URL);

            if (substr ($next_url, 0, strlen ($start_url)) == $start_url) {
                $ignore = false;

                if (!filter_var ($next_url, FILTER_VALIDATE_URL)) {
                    $ignore = true;
                }

                if (in_array ($next_url, $scanned)) {
                    $ignore = true;
                }

                if (isset ($skip) && !$ignore) {
                    foreach ($skip as $v) {
                        if (substr ($next_url, 0, strlen ($v)) == $v)
                        {
                            $ignore = true;
                        }
                    }
                }

                if (!$ignore) {
                    $returnPage = get_http_response_code($next_url);
                    //echo $httpCode.': '.$next_url.NL;
                    if($returnPage['httpCode']<400){
                        foreach ($extension as $ext) {
                            if (strpos ($next_url, $ext) > 0) {
                                //echo $next_url.NL;

                                if (!in_array ($next_url, $skip_exclude)) {
                                    //error_log('SCAN URL: '.$next_url.' ##');

                                    $html->clear();
                                    $html_Langs = str_get_html ($returnPage['page']);
                                    $getLanglinks = $html_Langs->find('head link[rel=alternate]');

                                    $add_langLinks = '';
                                    foreach($getLanglinks as $element){
                                        if($element->hreflang!='' /*&& $element->hreflang!='x-default'*/){
                                            $hrefLang = $element->hreflang;
                                            if($element->hreflang=='x-default'){
                                                $hrefLang = 'nl';
                                            }
                                            $add_langLinks .= "    <xhtml:link".NL .
                                                         "        rel=\"alternate\"" .NL.
                                                         "        hreflang=\"".$hrefLang."\"" . NL.
                                                         "        href=\"".$element->href."\"" . NL.
                                                         "    />".NL;
                                        }
                                    }

                                    $pr = number_format ( round ( $priority / count ( explode( "/", trim ( str_ireplace ( array ("http://", "https://"), "", $next_url ), "/" ) ) ) + 0.5, 3 ), 1 );
                                    fwrite ($pf, "  <url>" .NL.
                                                 "    <loc>" . htmlentities ($next_url) ."</loc>".NL.
                                                 "    <changefreq>$freq</changefreq>".NL.
                                                 "    <priority>$pr</priority>".NL.
                                                 $add_langLinks .
                                                 "  </url>".NL);
                                }
                                Scan ($next_url);
                            }
                        }
                    }
                }
            }
        }
    }
}

$pf = fopen($file, "w");
if(!$pf) {
    echo "Cannot create $file!" . NL;
    return;
}

$start_url = filter_var ($start_url, FILTER_SANITIZE_URL);

$add_langLinks = '';

/*$add_langLinks .= "    <xhtml:link".NL.
                 "        rel=\"alternate\"".NL.
                 "        hreflang=\"en\"".NL.
                 "        href=\"".URL_PREFIX."//".OWNER_URL."/en\"".NL.
                 "    />".NL;
*/


fwrite ($pf, "<?xml version=\"1.0\" encoding=\"UTF-8\"?>".NL.
             "<urlset xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\"".NL.
             "        xmlns:xhtml=\"http://www.w3.org/1999/xhtml\">".NL.
             "  <url>".NL.
             "    <loc>" . htmlentities ($start_url) ."</loc>".NL.
             $add_langLinks.
             "    <changefreq>$freq</changefreq>".NL.
             "    <priority>$priority</priority>".NL.
             "    <xhtml:link".NL .
             "        rel=\"alternate\"" .NL.
             "        hreflang=\"nl\"" . NL.
             "        href=\"".htmlentities ($start_url)."\"" . NL.
             "    />".NL.
             "  </url>".NL);

$scanned = array ();
$add_langLinks = '';
Scan ($start_url);

fwrite ($pf, "</urlset>".NL);
fclose ($pf);