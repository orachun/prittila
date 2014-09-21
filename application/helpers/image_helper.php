<?php

include ___config("base_path")."libs/wideimage/WideImage.php";

function image_download($img_path, $result_path = NULL, $thumb_path = NULL, $width = 0, $height = 0, $watermark = TRUE)
{
	image_prepare($img_path, $result_path, $width, $height, $watermark, TRUE);
	if(!empty($thumb_path))
	{
		image_prepare($img_path, $thumb_path, ___config('thumb_width'), ___config('thumb_height'), FALSE);
	}
}

function image_grid_item_prepare($img_path, $result_path)
{
	image_prepare($img_path, $result_path, ___config('grid_item_thumb_width'), ___config('grid_item_thumb_height'), FALSE);
}

function image_prepare($img_path, $result_path = NULL, $width = 0, $height = 0, $watermark = TRUE, $save = TRUE)
{
	if(empty($result_path))
	{
		$result_path = $img_path;
	}
	if($img_path instanceof WideImage_Image)
	{
		$img = $img_path;
	}
	else
	{
		$img = WideImage::load($img_path);
	}
	if($width > 0 && $height > 0)
	{
		$img = $img->resize($width, $height);
	}
//	if($watermark)
//	{
//		$w = $img->getWidth();
//		$h = $img->getHeight();
//		$watermark = WideImage::load(___config('watermark'))
//				->resize(0.5*$w);
//		$img = $img->merge($watermark, 'right', 'bottom-5%', 80);
//	}
	
	if($save)
	{
		$img->saveToFile($result_path);
	}
	else
	{
		$img->output('jpg', 100);
	}
	return $img;
}