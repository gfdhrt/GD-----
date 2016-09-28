<?php
/*打开图片*/
$src = "img/first.jpg";
$info = getimagesize($src);
$type = image_type_to_extension($info[2],false);
$fun = "imagecreatefrom{$type}";
$image = $fun($src);
/*操作图片*/
//在内存中建立一个宽300高200的真色彩图片
$image_thumb = imagecreatetruecolor(200,200);
//将原图复制到新建的真色彩图片上，并且按照一定比例压缩(参数1：真色彩图片,参数2：原图，参数3,4,5,6：原图和真色彩图的起始点，参数7,8：原图和真色彩图的结束点，参数9：原图宽，参数10：原图高)
imagecopyresampled($image_thumb,$image,0,0,0,0,200,200,$info[0],$info[1]);
//销毁原始图片
imagedestroy($image);
/*输出图片*/
header("Content-type:".$info['mime']);
$funs = "image{$type}";
$funs($image_thumb);
$funs($image_thumb,"yst.".$type);
/*销毁图片*/
imagedestroy($image_thumb);
?>