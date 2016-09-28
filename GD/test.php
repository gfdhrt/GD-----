<?php

require "image_class.php";

$src = "img/first.jpg";
$source = "img/11.png";
$content = "你好啊";
$font_url = "img/msyh.ttc";
$size = 20;
$color = array(
0=>255,
1=>255,
2=>255,
3=>50
); 
$local = array(
'x'=>20,
'y'=>50
);
$local01 = array(
	'x'=>100,
	'y'=>0
);
$alpha = 30;
$angle = 10;
$image = new Image($src);
$image->fontMark($content,$font_url,$size,$color,$local,$angle);
$image->imageMark($source,$local01,$alpha);
$image->thumb(500,500);
$image->show();
