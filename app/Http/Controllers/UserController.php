<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function show()
    {
        $parts = Auth::user()->bicycle->parts ?? collect([]);
        
        return view('edit', compact('parts'));
    }
}
