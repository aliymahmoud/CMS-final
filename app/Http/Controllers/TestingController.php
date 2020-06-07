<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestingController extends Controller
{
    public function create()
    {
        return view('users.create');
    }
    public function store(Request $request) 
    {
        return $request->username;
    }
}
