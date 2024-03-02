<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Part;
use App\Models\User;
use App\Models\Bicycle;

class DashboardController extends Controller
{
    public function index()
    {
       // ログインユーザーが所有する自転車を取得
       $bicycle = Auth::user()->bicycle;
    
       // ログインユーザーの自転車が存在する場合はそのパーツを取得、そうでなければ空のコレクションを設定
       $parts = $bicycle ? $bicycle->parts : collect([]);
    
       // ビューに自転車データとパーツデータを渡す
       return view('dashboard', compact('bicycle', 'parts'));
    }
}