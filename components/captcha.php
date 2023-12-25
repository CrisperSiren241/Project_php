<?php

$caplen = 6;
$width = 200;
$height = 60;
$font = __DIR__ . '\captchacode.otf';
$fontsize = 17;

header('Content-type: image/png');

$im = imagecreatetruecolor($width, $height);
imagesavealpha($im, true);
$bg = imagecolorallocatealpha($im, 0, 0, 0, 127);
imagefill($im, 0, 0, $bg);

$img_arr = array("../images/captcha1.jpg", "../images/captcha2.jpg", "../images/captcha3.jpg");

$img_fn = $img_arr[rand(0, sizeof($img_arr) - 1)];
$im = imagecreatefromjpeg($img_fn);
$im = imagecrop($im, ['x' => 0, 'y' => 0, 'width' => 200, 'height' => 60]);

$linenum = rand(3, 7);
for ($i = 0; $i < $linenum; $i++) {
    $color = imagecolorallocate($im, rand(0, 255), rand(0, 200), rand(0, 255));
    imageline($im, rand(0, 10), rand(1, 60), rand(160, 200), rand(1, 60), $color);
}

$number1 = rand(10, 99);
$number2 = rand(1, 9);

session_start();
$_SESSION['captcha_result'] = $number1 + $number2;

$text_color = imagecolorallocate($im, 255, 255, 255);
imagefttext($im, $fontsize, 0, 20, 40, $text_color, $font, "$number1 + $number2 = ");

imagejpeg($im);
imagedestroy($im);
