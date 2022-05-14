<?php

namespace App\Controllers;
use App\Core\App;


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
     * Show the home page.
     */
    public function track()
    {
        $id = -1;
        if (isset($_GET['id']) && is_numeric($_GET['id']))
            $id = $_GET['id'];

        $result = App::get('database')->insert('tracking', [
            'option_nr' => intval($id),
            'user_data' => $_SERVER['HTTP_USER_AGENT'] . ' - ' . $_SERVER['REMOTE_ADDR']
        ]);
        //return json($result);
    }


    /**
     * Show the 404 Page.
     */
    public function notFound()
    {
        return view('404', ["page" => "Page Not Found"]);
    }
}
