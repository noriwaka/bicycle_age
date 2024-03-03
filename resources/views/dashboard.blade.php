@php
use Carbon\Carbon;
@endphp
@extends('layouts.app')

@section('content')

@if(Auth::check())
    <div class="container mx-auto p-4">
        <div class="text-center my-10">
            <div class="mb-10">
                @if(isset($bicycle))
                    <h2 class="text-3xl font-bold">{{ $bicycle->name }}</h2>
                    <!-- 自転車の総走行距離を表示 -->
                    <h3 class="font-bold">総走行距離: {{ $bicycle->total_mileage }} km</h3>
                    @if($bicycle->purchase_day)
                        @php
                            $purchaseDate = \Carbon\Carbon::parse($bicycle->purchase_day);
                            $now = \Carbon\Carbon::now();
                            $difference = $purchaseDate->diff($now);
                        @endphp
                    <h3 class="font-bold">年齢: {{ $difference->y }} 年 {{ $difference->m }} ヶ月</h3>
                    @else
                        <h3>購入日が登録されていません</h3>
                    @endif
                    <div class="flex justify-center items-center">
                        <div class="w-full max-w-xs mx-auto bg-#5eead4">
                            <form action="{{ route('bicycle.add.mileage') }}" method="POST" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                                @csrf
                                @method('PUT')
                                <h2 class="block text-gray-700 text-lg font-bold mb-2 text-center">本日の走行距離</h2>
                                <div class="mb-4">
                                    <label for="mileage" class="block text-sm font-medium text-gray-700"></label>
                                    <input type="number" name="mileage" id="mileage" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline text-right" placeholder="km" required>
                                </div>
                                <div class="flex items-center justify-center">
                                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">決定</button>
                                </div>
                            </form>
                        </div>
                    </div>
                @else
                    <h2>自転車が登録されていません</h2>
                    <a class="link link-hover text-skyblue" href="{{ route('edit') }}">Editページ</a>で登録して下さい。
                @endif
                <!-- グリッドレイアウトを適用したパーツリスト -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mt-6">
                    @forelse ($parts as $part)
                        <div class="flex justify-between items-center p-4 bg-skyblue shadow-md rounded-lg">
                            <span class="text-lg font-semibold">{{ $part->name }}</span>
                            <span class="text-sm font-bold">走行距離: {{ $part->mileage }}km</span>
                        </div>
                    @empty
                        <div class="col-span-full text-center p-4 bg-white shadow-md rounded-lg">
                            <p>パーツがありません</p>
                            <p><a class="link link-hover text-skyblue" href="{{ route('edit') }}">Editページ</a>でパーツを追加して下さい</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@else
    <div class="container mx-auto p-4">
        <div class="text-center my-10">
            <div class="mb-10">
                <h2>サービスを利用するためにはログインして下さい</h2>
                    {{-- ログインページへのリンク --}}
                <a class="btn btn-primary normal-case w-1/2 mt-8" href="{{ route('login') }}">ログインページへ</a>
            </div>
        </div>
    </div>
@endif
@endsection('content')