<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SchdhrController extends Controller
{
    public function index($data)
    {
        return view($data['url'], $data);
    }

    public function add($data)
    {
        return view($data['url'], $data);
    }
}
