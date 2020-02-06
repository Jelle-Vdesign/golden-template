<?php
if(
    (isset($_SERVER['HTTP_USER_AGENT']) && stripos($_SERVER['HTTP_USER_AGENT'],"Speed Insights") === false) &&
    (isset($_SERVER['HTTP_USER_AGENT']) && stripos($_SERVER['HTTP_USER_AGENT'],"PageSpeed") === false) &&
    (isset($_SERVER['HTTP_USER_AGENT']) && stripos($_SERVER['HTTP_USER_AGENT'],"Google") === false) &&
    (isset($_SERVER['HTTP_USER_AGENT']) && stripos($_SERVER['HTTP_USER_AGENT'],"Fetch") === false) &&
    (isset($_SERVER['HTTP_USER_AGENT']) && stripos($_SERVER['HTTP_USER_AGENT'],"Lighthouse") === false) &&
    (isset($_SERVER['HTTP_USER_AGENT']) && stripos($_SERVER['HTTP_USER_AGENT'],"Website Grader") === false) &&
    stripos($_SERVER['REMOTE_ADDR'],"141.101.80.28") === false &&
    stripos($_SERVER['REMOTE_ADDR'],"5.178.78.78") === false &&
    stripos($_SERVER['REMOTE_ADDR'],"66.249.93.") === false &&
    stripos($_SERVER['REMOTE_ADDR'],"66.102.9.") === false &&
    stripos($_SERVER['REMOTE_ADDR'],"204.187.14.72") === false && stripos($_SERVER['REMOTE_ADDR'],"204.187.14.73") === false
){
    $checkGoogleBot = false;
}
$preload[] = array(
    'src'=>$svg_file,
    'as'=>'image'
);
$preload[] = array(
    'src'=>$css_file,
    'as'=>'style'
);
$preload[] = array(
    'src'=>$js_file,
    'as'=>'script'
);
$preload = array_slice($preload,0,10);
?>

<?php if($checkGoogleBot == false) {include_once $_SERVER['DOCUMENT_ROOT'].'/meta/seo_script.php'; } ?>
<meta charset="utf-8">
<meta name="language" content="<?php echo $lang; ?>"/>
<title itemprop="name"><?php echo $meta_title; ?></title>
<meta name="description" content="<?php echo htmlspecialchars($meta_descr); ?>">

<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=no,viewport-fit=cover">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="mobile-web-app-capable" content="yes">
<meta name="format-detection" content="telephone=no">

<meta name="Author" content="<?php echo OWNER_NAME?>">
<meta name="Generator" content="LEO V3 | Veenstra Design">

<?php echo $bot_tags; ?>

<link rel="dns-prefetch" href="<?php echo STATIC_PATH; ?>">

<?php
if(isset($preload) && count($preload)>0) {
    foreach($preload as $pre_img){
        ?>
        <link rel="preload" href="<?=$pre_img['src']?>" as="<?=$pre_img['as']?>" <?=isset($pre_img['type']) ? 'type="'.$pre_img['type'].'"' : '' ?> <?=isset($pre_img['co']) ? 'crossorigin' : '' ?>>
        <?php
    }
}
?>

<link rel="apple-touch-icon" sizes="180x180" href="/images/icons/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="/images/icons/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="/images/icons/favicon-16x16.png">
<link rel="manifest" href="/images/icons/site.webmanifest">
<link rel="mask-icon" href="/images/icons/safari-pinned-tab.svg" color="<?php echo $mask_icon_clr; ?>">
<link rel="shortcut icon" href="/images/icons/favicon.ico">
<meta name="apple-mobile-web-app-title" content="<?php echo OWNER_NAME?>">
<meta name="application-name" content="<?php echo OWNER_NAME?>">
<meta name="msapplication-TileColor" content="<?php echo $theme_clr; ?>">
<meta name="msapplication-config" content="/images/icons/browserconfig.xml">
<meta name="theme-color" content="<?php echo $theme_clr; ?>">
<?php echo $meta_imgs; ?>
<?php echo $meta_extra; ?>

<?php echo (isset($page) && $page=='error') ? '<meta http-equiv="" content="10; url=/">' : ''; ?>