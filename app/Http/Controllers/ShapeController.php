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

    /**
     * Exercise2
     */
    public function exercise2()
    {
        echo "<br><b>1-b.</b> SSH to server - <code>SSH username@host.com</code><br>";

        echo "<br><b>1-c.</b> Check the disk usage - <code>disk_free_space('/directory');</code><br>";

        echo "<br><b>4.a </b>Command to observe performance - <code>top</code><br>";

        echo "<br><b>5.</b> Query to create view on routers table - <code> CREATE VIEW router_view AS
        SELECT *
        FROM routers;</code><br>";

        
    }
}
