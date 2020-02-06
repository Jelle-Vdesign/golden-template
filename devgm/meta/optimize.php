<?php
header('Content-Type: text/html; charset=utf-8');
if( isset($_SERVER['HTTP_ACCEPT_ENCODING']) && substr_count($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip') ) {
    ob_start("ob_gzhandler");
}else {
    ob_start();
}

ob_start("minify_html");

function minify_html($buffer)
{
    $search = array(
        '/\>[^\S ]+/s',
        '/[^\S ]+\</s',
        '/(\s)+/s'
    );
    $replace = array(
        '>',
        '<',
        '\\1'
    );
    $buffer = preg_replace($search, $replace, $buffer);

    return $buffer;
}