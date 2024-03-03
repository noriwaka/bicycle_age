<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BicycleController extends Controller
{
    public function updateInfo(Request $request)
    {
    $request->validate([
        'name' => 'required|string|max:255',
        'total_mileage' => 'required|numeric|min:0',
        'purchase_day' => 'required|date',
    ]);

    $bicycle = Auth::user()->bicycle;
    if ($bicycle) {
        $bicycle->update([
            'name' => $request->name,
            'total_mileage' => $request->total_mileage,
            'purchase_day' => $request->purchase_day,
        ]);
        return redirect()->route('dashboard')->with('success', '自転車の情報が更新されました。');
    } else {
        return back()->withErrors('自転車が見つかりません。');
    }
    }
    
    public function addMileage(Request $request)
    {
        $request->validate([
            'mileage' => 'required|numeric|min:0'
        ]);
        //DB::transactionはデータベースに変更を加えるクエリの処理中で、一つでも失敗したら何も更新しないようにする
        //データの整合性を保つため
        DB::transaction(function () use ($request) {
            $user = Auth::user();
            $bicycle = $user->bicycle;
            $bicycle->total_mileage += $request->mileage;
            $bicycle->save();
            
            
            foreach ($bicycle->parts as $part) {
                $part->mileage += $request->mileage;
                $part->save();
            }
        });
        
        return redirect()->route('dashboard');/*->with('success', '走行距離を更新しました。');*/
    }
}
    /* public function updateName(Request $request)
     {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $bicycle = Auth::user()->bicycle;
        if ($bicycle) {
            $bicycle->update(['name' => $request->name]);
            return redirect()->route('dashboard')->with('success', '自転車の名前が更新されました。');
        } else {
            return redirect()->route('dashboard')->withErrors('自転車が見つかりません。');
        }
    }*/