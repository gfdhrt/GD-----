<?php
/*打开图片*/
//1.配置图片路径
$src = "img/first.jpg";
//2.获取图片信息(通过gd库提供的方法，获得你想要处理的图片的基本信息)
$info = getimagesize($src);
//3.通过图像编号来获取图像类型
$type = image_type_to_extension($info[2],false);
//4.在内存中创建一个和我们图像类型一样的图像
$fun = "imagecreatefrom{$type}";//创建一个跟tpye获取到的格式一样的图片
//5.把图片复制到内存中
$image = $fun($src);
/*操作图片*/
//1.设置字体路径
$font = "img/msyh.ttc";
//2.填写水印内容
$content = "hello,imooc";
//3.设置字体的颜色RGB和透明度 参数1：图片，参数2：red，参数3：green，参数4：blue，参数5：透明度
$color = imagecolorallocatealpha($image,255,255,255,50);
//4.把文字写入到图片中 参数1：内存中的图片（图片源），参数2：文字尺寸，参数3：旋转角度，参数4：x轴偏移量，参数5：y轴偏移量，参数6：之前设置的字体颜色，参数7：字体库，参数8：写入的内容
imagettftext($image,20,0,20,30,$color,$font,$content);
/*输出图片*/
//浏览器输出
header("Content-type:".$info['mime']);
$func="image{$type}";
$func($image);

//保存图片
$func($image,"newimg.".$type);

/*销毁图片(清理内存图片)*/
imagedestroy($image);