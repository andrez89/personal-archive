<?php

namespace App\Controllers;

use App\Core\App;

class UkuleleController
{
    /**
     * Show carousel page.
     */
    public function index()
    {
        $page = "Ukulele Songs";
        $songs = []; // App::get('database')->selectAll("capoeira_songs", "*", "counter DESC, title");
        $secret = isset($_GET['secret']) ? "?secret=" . $_GET['secret'] : "";
        return view('ukulele-songs', compact('page', 'songs', 'secret'));
    }

    /**
     * Evaluate and show Carousel.
     */
    public function evaluate()
    {
        $page = "Ukulele Songs";
        return redirect('stories.detail', compact('data', 'page'));
    }

    public function getAll()
    {
        $result = App::get('database')->select(
            "ukulele_songs u INNER JOIN difficulties dU ON u.levelUke = dU.id INNER JOIN difficulties dG ON u.levelGuitar = dG.id",
            ["secret" => isset($_GET['secret']) ? $_GET['secret'] : ""],
            [
                "u.*",
                "concat(dU.id, ' ', dU.description) difficultyUke",
                "concat(dG.id, ' ', dG.description) difficultyGit"
            ]
        );
        header("X-ROWS: " . sizeof($result));
        json(["data" => $result]);
    }
}
