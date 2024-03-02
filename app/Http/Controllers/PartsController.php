<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Part;
use Illuminate\Support\Facades\Auth; 

class PartsController extends Controller
{
    //
    public function updateAll (Request $request)
    {
        // バリデーション
        $request->validate([
        'parts.*.id' => 'exists:parts,id',
        'parts.*.name' => 'required|max:255',
        'parts.*.mileage' => 'required|numeric|max:999999',
        'newParts.*.name' => 'nullable|max:255',
        'newParts.*.mileage' => 'nullable|numeric|min:0|max:999999',
    ]);

    // 既存のパーツの更新処理
    foreach ($request->parts as $partData) {
        $part = Part::findOrFail($partData['id']);
        $part->name = $partData['name'];
        $part->mileage = $partData['mileage'];
        $part->save();
    }

    // 新しいパーツの追加処理
    if ($request->has('newParts')) {
        foreach ($request->newParts as $newPartData) {
            // nameが設定されており、かつ空でないことを確認
            if (isset($newPartData['name']) && $newPartData['name'] !== '') {
                $newPart = new Part();
                $newPart->name = $newPartData['name'];
                // mileageが設定されているか確認し、設定されていなければ0を使用
                $newPart->mileage = isset($newPartData['mileage']) ? $newPartData['mileage'] : 0;
                $bicycleId = Auth::user()->bicycle->id;
                $newPart->bicycle_id = $newPart->bicycle_id = $bicycleId;
                $newPart->save();
            }
        }
    }
        return redirect()->route('dashboard')->with('success', 'パーツが更新されました。');
    }
}