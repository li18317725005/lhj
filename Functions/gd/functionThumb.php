<?php
header('content-type:text/html;charset=utf-8');
/**
 * 图片的剪切和缩放
 * @param  str $filename,被缩放图片路径及名称
 * @param  int $src_x,原图的被缩放的坐标x
 * @param  int $src_y,原图的被缩放的坐标y
 * @param  int $des_w,缩放后图片宽
 * @param  int $des_h,缩放后图片的高
 */
function thumb($filename,$src_x,$src_y,$des_w,$des_h){
	//获取原图和缩放后图片的资源
	$des_img = imagecreatetruecolor($des_w,$des_h);
	list($src_w,$src_h,$type) = getimagesize($filename);
	$arr = array(
			1 => 'gif',
	        2 => 'jpeg',
			3 => 'png'
	);
	$str      = 'imagecreatefrom';
	$trpeName = $arr[$type];
	$fun      = $str.$trpeName;
	$src_img  = $fun($filename);
	$des_x    = 0; //一般缩略后的图片坐标为(0,0)
	$des_y    = 0; //一般缩略后的图片坐标为(0,0)
	imagecopyresampled($des_img,$src_img,
					   $des_x,$des_y,
					   $src_x,$src_y,
					   $des_w,$des_h,
					   $src_w,$src_h						
					  );
	//展示
	header('content-type:image/png');
	imagepng($des_img);
	//释放资源
	imagedestroy($des_img);
	imagedestroy($src_img);
}