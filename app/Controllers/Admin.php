<?php

namespace App\Controllers;

class Admin extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Tenda Hj.Yus',
        ];
        return view('admin/index', $data);
    }

}
