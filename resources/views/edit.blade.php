@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-3xl font-bold mb-4">パーツの一括編集</h1>
    <!-- 全パーツ編集フォーム -->
    <form action="{{ route('parts.update.all') }}" method="POST">
        @csrf
        @method('PUT')
        
        {{-- 既存のパーツの編集フィールド --}}
       @forelse ($parts as $index => $part)
    <div class="flex gap-4 items-center mb-4">
        <input type="hidden" name="parts[{{ $index }}][id]" value="{{ $part->id }}">
        <div>
            <label for="part_name_{{ $index }}" class="block text-sm font-medium text-gray-700">パーツ名</label>
            <input type="text" name="parts[{{ $index }}][name]" id="part_name_{{ $index }}" value="{{ $part->name }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
        </div>
        <div>
            <label for="part_mileage_{{ $index }}" class="block text-sm font-medium text-gray-700">走行距離(km)</label>
            <input type="number" name="parts[{{ $index }}][mileage]" id="part_mileage_{{ $index }}" value="{{ $part->mileage }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
        </div>
    </div>
@empty
    <p>編集するパーツがありません。</p>
@endforelse

        {{-- 新しいパーツの追加フィールド --}}
        <h2 class="text-xl font-bold my-4">新しいパーツを追加</h2>
        @for ($i = 0; $i < 20; $i++)
            <div class="flex gap-4 items-center mb-4">
                <input type="text" name="newParts[{{ $i }}][name]" placeholder="パーツ名" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                <input type="number" name="newParts[{{ $i }}][mileage]" placeholder="走行距離(km)" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            </div>
        @endfor
        
        <div>
            <button type="submit" class="btn btn-primary">一括更新</button>
        </div>
    </form>
</div>
@endsection