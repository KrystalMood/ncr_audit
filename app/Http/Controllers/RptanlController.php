<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class RptanlController extends Controller
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
