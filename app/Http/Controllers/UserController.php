<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function show()
    {
        return view('edit');
    }
    
    public function bicycleParts()
    {
        $parts = Auth::user()->getBicycleParts();
        //viewで使う変数名を指定する別の書き方compact、複数の変数を扱う時に便利
        return view('bicycle_parts', compact('parts'));
    }
}
