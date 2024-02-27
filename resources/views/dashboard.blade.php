@extends('layouts.app')

@section('content')

@if(Auth::check())
    <div class="prose hero bg-base-200 mx-auto max-w-full rounded">
        <div class="hero-content text-center my-10">
            <div class="max-w-md mb-10">
                <h2>{{ Auth::user()->bicycle->name ?? '自転車が登録されていません' }}</h2>
                <ul>
                    @forelse ($parts as $part)
                        <li>{{ $part->name }} - 走行距離: {{ $part->distance }}km</li>
                    @empty
                        <li>パーツがありません。</li>
                    @endforelse
                </ul>
            </div>
       
        </div>
    </div>
@else
    <div class="prose hero bg-base-200 mx-auto max-w-full rounded">
        <div class="hero-content text-center my-10">
            <div class="max-w-md mb-10">
                <h2>サービスを利用するためにはログインして下さい</h2>
                    {{-- ログインページへのリンク --}}
                <a class="btn btn-primary normal-case w-full mt-8" href="{{ route('login') }}">ログインページへ</a>
            </div>
        </div>
    </div>
@endif
@endsection('content')