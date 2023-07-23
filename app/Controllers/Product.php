<?php

namespace App\Controllers;

class Product extends BaseController
{
    public function index()
    {
        return view('home/index');
    }

    public function detail()
    {
        return view('home/detail');
    }
}
