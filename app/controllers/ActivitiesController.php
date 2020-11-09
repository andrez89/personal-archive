<?php

namespace App\Controllers;

use App\Core\App;

class ActivitiesController
{
    /**
     * Show carousel page.
     */
    public function index()
    {
        $page = "Activities";
        $songs = []; // App::get('database')->selectAll("capoeira_songs", "*", "counter DESC, title");
        return view('activities', compact('page', 'songs'));
    }

    public function getAll()
    {
        json(["data" => App::get('database')->selectAll("activities")]);
    }
}
