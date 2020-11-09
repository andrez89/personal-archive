<?php

namespace App\Controllers;

class PagesController
{
    /**
     * Show the home page.
     */
    public function home()
    {
        return view('index');
    }

    /**
     * Show the 404 Page.
     */
    public function notFound()
    {
        return view('404', ["page" => "Page Not Found"]);
    }
}
