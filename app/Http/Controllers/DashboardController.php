<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        //ログインユーザーが所有する自転車のパーツを取得してビューで表示する
        //UserモデルのhasoneリレーションでBicycleインスタンスを取得し、
        //そのインスタンスのparts(hasManyリレーションで)プロパティに直接アクセスする
        //?? collect([])は自転車は存在しないときは空のコレクションを返す事でエラーを防止
         $parts = Auth::user()->bicycle->parts ?? collect([]);
         //viewで使う変数名を指定する別の書き方compact、複数の変数を扱う時に便利
        return view('dashboard', compact('parts'));
    }
}
