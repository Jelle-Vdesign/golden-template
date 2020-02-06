<?php
require_once $_SERVER['HOME'].'/httpdocs/init.php';

$datafactory = new Datafactory();
$functions   = new Functions();
$langfactory = new LanguageGroupFactory();

$file = $_SERVER['HOME'].'/httpdocs/rss.xml';
$freq = "daily";

$finfo = finfo_open(FILEINFO_MIME_TYPE);

$items = array();

$pf = fopen ($file, "w");
if (!$pf)
{
	echo "Kan $file niet schrijven!" . NL;
	return;
}

fwrite ($pf, "<?xml version='1.0' encoding='UTF-8'?>
<rss
	version=\"2.0\"
	xmlns:content=\"http://purl.org/rss/1.0/modules/content/\"
	xmlns:media=\"http://search.yahoo.com/mrss/\">
	<channel>
		<lastBuildDate>".date("r")."</lastBuildDate>
		<title>".OWNER."</title>
		<description>Het laatste nieuws van ".OWNER."</description>
		<link>".URL_PREFIX.'//'.OWNER_URL."</link>
		<copyright>".date("Y")." ".OWNER."</copyright>
		<language>nl</language>
		<image>
		  <url>".URL_PREFIX.'//'.OWNER_URL."/images/icons/mstile-310x310.png</url>
		  <title>".OWNER."</title>
		  <link>".URL_PREFIX.'//'.OWNER_URL."</link>
		</image>
");

$newsItems =  $datafactory->getMultiObject('news', 'changeDate DESC', 'languageGroupID', 1, false, false, 'equal', 25);

foreach($newsItems as $item){
	$newsImage = $datafactory->getSingleObject('newsMediaView', 'newsID', $item->newsID, 'sortIndex', 'mediaGroupID=9');

	$image = '';
	$img_width = '';
	$img_height = '';
	$img_width_t = '';
	$img_height_t = '';
	$image_type = '';

	if(isset($newsImage) && isset($newsImage->fileName)){
		list($img_width,$img_height) = getimagesize(REAL_IMG_PATH.'medium/'.$newsImage->fileName);
		list($img_width_t,$img_height_t) = getimagesize(REAL_IMG_PATH.'thumbs/'.$newsImage->fileName);
		$image_type = finfo_file($finfo, REAL_IMG_PATH.$newsImage->fileName);

		$item->img = URL_PREFIX.IMG_PATH.'medium/'.$newsImage->fileName;
		$item->thumb = URL_PREFIX.IMG_PATH.'thumbs/'.$newsImage->fileName;
	}

	$title = strip_tags($functions->enitityEncodeSitemap($item->title));
	$item->url='/nieuws/'.$item->url;

	$content = $item->content;
	if(strlen($item->content_2)>7){
		$content = $content.$item->content_2;
	}

	$content = '<h1>'.$title.'</h1>'.$content;

	//$content = enitityEncodeSitemap($content);

	$description = strlen($item->content)>5 ? $functions->enitityEncodeSitemap($item->content) : OWNER.' Nieuws';

	$items[] = array(
		'id'=>OWNER_ABBR.'_'.$item->newsID,
		'link'=>$item->url,
		'title'=>$title,
		'description'=>$description,
		'content'=>$content,
		'image'=>$item->img,
		'image_thumb'=>$item->thumb,
		'image_type'=>$image_type,
		'image_w'=>$img_width,
		'image_h'=>$img_height,
		'image_thumb_w'=>$img_width_t,
		'image_thumb_h'=>$img_height_t,
		'date'=>strftime("%a, %d %b %Y %H:%M:%S %z", strtotime($item->changeDate))
	);

}

foreach($items as $item){

	fwrite ($pf, "
		<item>
			<guid isPermaLink=\"false\">".$item['id']."</guid>
			<pubDate>".$item['date']."</pubDate>
			<title>".$item['title']."</title>
			<description>".$item['description']."</description>
	");
	if($item['image']){
		fwrite ($pf, "
			<media:content url=\"".$item['image']."\" 
				type=\"".$item['image_type']."\" expression=\"full\" width=\"".$item['image_w']."\" height=\"".$item['image_h']."\">
				<media:description type=\"plain\"><![CDATA[".$item['title']."]]></media:description>
				<media:credit role=\"author\" scheme=\"urn:ebu\"><![CDATA[".OWNER."]]></media:credit>
			</media:content>
			
		");
		/*<media:thumbnail url=\"".$item['image_thumb']."\"
				type=\"".$item['image_type']."\" expression=\"full\" width=\"".$item['image_thumb_w']."\" height=\"".$item['image_thumb_h']."\">
			</media:thumbnail>*/
	}

	fwrite ($pf, "
			<content:encoded><![CDATA[".$item['content']."]]></content:encoded>
			<link>".URL_PREFIX.'//'.OWNER_URL.$item['link']."</link>
			<author>".OWNER_MAIL." (".OWNER.")</author>
		</item>	
	");

	//htmlspecialchars(html_entity_decode(strip_tags($item['content'])), ENT_QUOTES)

}


fwrite ($pf, "</channel>
</rss>");
fclose ($pf);
?>
