<?php
//		Some Chess, a PHP multi-player chess server.
//		Copyright (C) 2007 Jon Link
session_start();
 
// Create image and define colors
$image	= ImageCreateFromJPEG('img/back.jpg');
$white	= ImageColorAllocate($image, 255, 255, 255);
$blue	= ImageColorAllocate($image, 50, 90, 145);
$black	= ImageColorAllocate($image, 0, 0, 0);
$codeLen= 6;
$height	= 30;
$width	= 75;

srand((double)microtime()*1000000);
$string 	= md5(rand(0,99799));
$theCode 	= substr($string, rand(1,20), $codeLen);
$_SESSION['theCode'] = $theCode;

for($n=0;$n<$codeLen;++$n){
   $font = rand(3,5);
   ImageString($image, $font, $width/$codeLen*$n+rand(4,7), 7, substr($theCode,$n,1), $blue);
}

header("Content-type: image/png");
imagepng($image);
imagedestroy($image);
?>