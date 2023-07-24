<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Wedding Organizer',
        ];
        return view('home/index', $data);
    }

    public function detail()
    {
        return view('home/detail');
    }
}
