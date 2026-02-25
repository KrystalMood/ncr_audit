<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RptlogController extends Controller
{
    public function index($data)
    {
        return view($data['url'], $data);
    }

    public function store($data)
    {
        return view($data['url'], $data);
    }
}
