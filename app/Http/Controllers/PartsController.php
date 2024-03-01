<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Part;

class PartsController extends Controller
{
    //
    public function updateAll (Request $request)
    {
        // バリデーション
        $request->validate([
            'parts.*.id' => 'required|exists:parts,id',
            'parts.*.name' => 'required|max:255',
            'parts.*.mileage' => 'required|numeric|max:999999',
        ]);
    
        // リクエストデータを取得し、更新する
        foreach ($request->parts as $partData) {
            $part = Part::findOrFail($partData['id']);
            $part->name = $partData['name'];
            $part->mileage = $partData['mileage'];
            $part->save();
    }

    // 更新後にリダイレクト、フラッシュメッセージ付き
    return redirect()->route('dashboard')->with('success', 'パーツが更新されました。');

    }
}
