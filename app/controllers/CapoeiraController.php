<?php

namespace App\Controllers;

use App\Core\App;

class CapoeiraController
{
    /**
     * Show carousel page.
     */
    public function index()
    {
        $page = "Capoeira Songs";
        $songs = []; // App::get('database')->selectAll("capoeira_songs", "*", "counter DESC, title");
        return view('capoeira-songs', compact('page', 'songs'));
    }

    /**
     * Evaluate and show Carousel.
     */
    public function evaluate()
    {
        $page = "Capoeira Songs";
        return redirect('stories.detail', compact('data', 'page'));
    }

    public function getAll()
    {
        json(["data" => App::get('database')->selectAll("capoeira_songs")]);
    }
}
