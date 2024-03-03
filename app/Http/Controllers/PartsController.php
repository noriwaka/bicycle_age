<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Part;
use Illuminate\Support\Facades\Auth; 
use App\Models\User;
use App\Models\Bicycle;

class PartsController extends Controller
{
    //
    public function updateAll (Request $request)
    {
        // バリデーション
        $request->validate([
            'parts.*.id' => 'exists:parts,id',
            'parts.*.name' => 'required|max:255',
            'parts.*.mileage' => 'required|numeric|min:0|max:999999',
        ]);

        // 既存のパーツの更新処理
        foreach ($request->parts as $partData) {
            $part = Part::findOrFail($partData['id']);
            $part->name = $partData['name'];
            $part->mileage = $partData['mileage'];
            $part->save();
        }
        
        return redirect()->route('dashboard')->with('success', 'パーツが更新されました。');
    }

    // 新しいパーツの追加処理
    public function addNewParts(Request $request)
    {
        $request->validate([
            'newParts.*.name' => 'required|max:255',
            'newParts.*.mileage' => 'required|numeric|min:0|max:999999',
        ]);

        $bicycleId = Auth::user()->bicycle->id;

        foreach ($request->newParts as $newPartData) {
            if (!empty($newPartData['name'])) {
                $newPart = new Part([
                    'name' => $newPartData['name'],
                    'mileage' => $newPartData['mileage'],
                    'bicycle_id' => $bicycleId,
                ]);
                $newPart->save();
            }
        }

        return redirect()->route('dashboard')->with('success', '新しいパーツが追加されました。');
    }
}