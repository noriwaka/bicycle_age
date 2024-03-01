<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PartsController extends Controller
{
    //
    public function updateAll (Request $request)
    {
        //バリデーション
        $request->validate([
            'parts.*.name' => 'required|max:255',
            //numericはintegerよりも基準が緩い
            'parts.*.mileage' => 'required|numeric|max:999999',
            ]);
            
        //リクエストデータを取得し、更新する
        foreach ($request->parts as $id => $partData) {
            $part = Part::findOrFail($id); // パーツをIDで検索し、見つからない場合はエラー
            $part->name = $partData['name']; // パーツ名の更新
            $part->mileage = $partData['mileage']; // 走行距離の更新
            $part->save(); // パーツを保存
        }

    // 更新後にリダイレクト、フラッシュメッセージ付き
    return redirect()->route('dashboard')->with('success', 'パーツが更新されました。');

    }
}
