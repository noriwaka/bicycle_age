@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-3xl font-bold mb-4">パーツの一括編集</h1>

    <!-- 全パーツ編集フォーム -->
    <form action="{{ route('parts.update.all') }}" method="POST">
        @csrf
        <!-- htmlフォームはput,patchはサポート外の為put指定する -->
        @method('PUT')
        
        @forelse ($parts as $index => $part)
    <div class="flex gap-4 items-center mb-4">
        <!-- 各パーツのIDを隠しフィールドとして含める -->
        <input type="hidden" name="parts[{{ $index }}][id]" value="{{ $part->id }}">

        <div>
            <label for="part_name_{{ $index }}" class="block text-sm font-medium text-gray-700">パーツ名</label>
            <input type="text" name="parts[{{ $index }}][name]" id="part_name_{{ $index }}" placeholder="{{ $part->name }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
        </div>

        <div>
            <label for="part_mileage_{{ $index }}" class="block text-sm font-medium text-gray-700">走行距離(km)</label>
            <input type="number" name="parts[{{ $index }}][mileage]" id="part_mileage_{{ $index }}" placeholder="{{ $part->mileage }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
        </div>
    </div>
@empty
    <p>編集するパーツがありません。</p>
@endforelse
        
        <div>
            <button type="submit" class="btn btn-primary">一括更新</button>
        </div>
    </form>
</div>
@endsection