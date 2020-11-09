<?php

namespace App\Controllers;

use App\Core\App;

class StoriesController
{
    /**
     * Show carousel page.
     */
    public function index()
    {
        $page = "Stories";
        $stories = [];
        return view('stories', compact('page', 'stories'));
    }

    /**
     * Evaluate and show Carousel.
     */
    public function evaluate()
    {
        $page = "Stories";
        return redirect('stories.detail', compact('data', 'page'));
    }

    public function getAll()
    {
        json(["data" => App::get('database')->selectAll("stories")]);
    }
}
