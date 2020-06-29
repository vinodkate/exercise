<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ShapeController extends Controller
{
    /**
     * shape draw
     */
    public function shape()
    {
        // Create a 500 x 500 image
        $image = imagecreatetruecolor(500, 500);

        // Allocate colors
        $color = imagecolorallocate($image, 255, 255, 255);

        $arr = [250,250,350,450,150,450];
        // Draws a polygon
        imagepolygon($image, $arr, 3, $color);

        // Output a PNG image
        imagepng($image, 'img.png'); 
        echo '<img src="img.png">';
        exit();
        
    }
}
