<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function show()
    {
        // 現在認証されているユーザーの自転車を取得
        $bicycle = Auth::user()->bicycle;
        
        // 自転車が存在しない場合は空のコレクションを返す
        $parts = $bicycle ? $bicycle->parts : collect([]);
        
        // 自転車の情報とパーツ情報をビューに渡す
        return view('edit', compact('bicycle', 'parts'));
    }
}
