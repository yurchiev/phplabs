<?php
$image_width = 800;
$image_height = 600;

$image = imagecreatetruecolor($image_width, $image_height);

$bg_color = imagecolorallocate($image, 255, 255, 255);
$axis_color = imagecolorallocate($image, 0, 0, 0);
$graph_color = imagecolorallocate($image, 0, 0, 255);

imagefill($image, 0, 0, $bg_color);

$x_min = -10;
$x_max = 10;
$y_min = -10;
$y_max = 100;

function mapX($x, $x_min, $x_max, $image_width) {
    return ($x - $x_min) / ($x_max - $x_min) * $image_width;
}

function mapY($y, $y_min, $y_max, $image_height) {
    return $image_height - ($y - $y_min) / ($y_max - $y_min) * $image_height;
}


imageline($image, mapX(0, $x_min, $x_max, $image_width), 0, mapX(0, $x_min, $x_max, $image_width), $image_height, $axis_color);
imageline($image, 0, mapY(0, $y_min, $y_max, $image_height), $image_width, mapY(0, $y_min, $y_max, $image_height), $axis_color);


$step = 0.01;
$x_prev = $x_min;
$y_prev = $x_prev * $x_prev;
for ($x = $x_min + $step; $x <= $x_max; $x += $step) {
    $y = $x * $x;
    imageline($image, mapX($x_prev, $x_min, $x_max, $image_width), mapY($y_prev, $y_min, $y_max, $image_height), mapX($x, $x_min, $x_max, $image_width), mapY($y, $y_min, $y_max, $image_height), $graph_color);
    $x_prev = $x;
    $y_prev = $y;
}

header('Content-Type: image/png');
imagepng($image);

imagedestroy($image);
?>
