@extends('layouts.app')

@section('content')

@if(Auth::check())
    <div class="container mx-auto p-4">
        <div class="text-center my-10">
            <div class="mb-10">
                @if(isset($bicycle))
                    <h2 class="text-3xl font-bold">{{ Auth::user()->getBicycleName() }}</h2>
                @else
                    <h2>自転車が登録されていません。<a class="link link-hover" href="{{ route('edit') }}">Editページ</a>で登録して下さい。</h2>
                @endif
                <!-- グリッドレイアウトを適用したパーツリスト -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mt-6">
                    @forelse ($parts as $part)
                        <div class="flex justify-between items-center p-4 bg-white shadow-md rounded-lg">
                            <span class="text-lg font-semibold">{{ $part->name }}</span>
                            <span class="text-sm">走行距離: {{ $part->mileage }}km</span>
                        </div>
                    @empty
                        <div class="col-span-full text-center p-4 bg-white shadow-md rounded-lg">
                            <p>パーツがありません</p>
                            <p><a class="link link-hover" href="{{ route('edit') }}">Editページ</a>でパーツを追加して下さい</p>
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