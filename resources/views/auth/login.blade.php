@extends('layouts.app')

@section('content')
    <div class="flex justify-center">
        <form method="POST" action="{{ route('login') }}" class="w-1/2">
            @csrf
                <h2 class="text-center font-medium my-4">メールアドレスとパスワードを入力してログイン</h2>
                
                <div class="form-control my-4">
                <label for="email" class="label">
                    <span class="label-text font-medium">メールアドレス</span>
                </label>
                <input type="email" name="email" class="input input-bordered w-full">
            </div>

            <div class="form-control my-4">
                <label for="password" class="label">
                    <span class="label-text font-medium">パスワード</span>
                </label>
                <input type="password" name="password" class="input input-bordered w-full">
            </div>
                <button type="submit" class="btn btn-primary normal-case w-full mt-8" href="{{ route('login') }}"><a>ログイン</a></button>
        </form>
    </div>
@endsection('content')