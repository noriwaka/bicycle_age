<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class BicycleController extends Controller
{
    public function updateName(Request $request)
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
    }
}