<?php

namespace App\Controllers;

class CarouselController
{
    /**
     * Show carousel page.
     */
    public function index()
    {
        return view('carousel', ["page" => "Carousel"]);
    }

    /**
     * Show carousel page.
     */
    public function schema()
    {
        return view('schema', ["page" => "Schema Maker"]);
    }
}
