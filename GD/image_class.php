<?php
class Image {
	private $image;
	private $info;
	/*打开图片*/
	public function __construct($src){
		$info = getimagesize($src);
		$this->info = array(
			'width' => $info[0],
			'height' => $info[1],
			'type' => image_type_to_extension($info[2],false),
			'mime'=>$info['mime']
		);
		$fun = "imagecreatefrom{$this->info['type']}"; 
		$this->image = $fun($src);
	}
	/*操作图片（压缩）*/
	public function thumb($width,$height){
		$image_thumb = imagecreatetruecolor($width,$height);
		imagecopyresampled($image_thumb,$this->image,0,0,0,0,$width,$height,$this->info['width'],$this->info['height']);
		imagedestroy($this->image);
		$this->image = $image_thumb;
	}
		/*添加文字水印*/
	public function fontMark($content,$font_url,$size,$color,$local,$angle){
		$col = imagecolorallocatealpha($this->image,$color[0],$color[1],$color[2],$color[3]);
		imagettftext($this->image,$size,$angle,$local['x'],$local['y'],$col,$font_url,$content);
	}
	/*添加图片水印*/
	public function imageMark($source,$local,$alpha){
		$info_Mark = getimagesize($source);
		$type_Mark = image_type_to_extension($info_Mark[2],false);
		$func = "imagecreatefrom{$type_Mark}";
		$image_Mark = $func($source);
		imagecopymerge($this->image,$image_Mark,$local['x'],$local['y'],0,0,$info_Mark[0],$info_Mark[1],$alpha);
		imagedestroy($image_Mark);
	}
	/*在浏览器中输出图片*/
	public function show(){
		header("Content-type:".$this->info['mime']);
		$funs = "image{$this->info['type']}";
		$funs($this->image);
	}
	/*把图片保存在硬盘中*/
	public function save($newname){
		$funs = "image{$this->info[type]}";
		$funs($this->image,$newname.'.'.$this->info[type]);
	}
	/*销毁内存中的图片*/
	public function __destruct(){
		imagedestroy($this->image);
	}
}