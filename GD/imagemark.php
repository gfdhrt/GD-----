<?php
$src = "img/first.jpg";
$info = getimagesize($src);
$type = image_type_to_extension($info[2],false);
$fun = "imagecreatefrom{$type}";
$image = $fun($src);
//设置水印路径
$src_mark = "img/11.png";
$info_mark = getimagesize($src_mark);
$type_mark = image_type_to_extension($info_mark[2],false);
$fun_mark = "imagecreatefrom{$type_mark}";
$image_mark = $fun_mark($src_mark);
//合并图片(参数1：原始图片，参数2：水印图片，参数3：x轴偏移，参数4：y轴偏移，参数5：水印图的左上角起始点，参数6：终止点，参数6：水印图宽度，参数7：水印图长度，参数8：透明度)
imagecopymerge($image,$image_mark,200,0,0,0,$info_mark[0],$info_mark[1],30);
//删除内存中的水印
imagedestroy($image_mark);
header("Content-type:".$info['mime']);
$funs = "image{$type}";
$funs($image);
$funs($image,"newimage.".$type);
imagedestroy($image);