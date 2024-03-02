@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <div class="mb-8 text-center">
        <h1 class="text-xl font-bold mb-4">自転車の情報</h1>
        <form action="{{ route('bicycle.update.info') }}" method="POST">
            @csrf
            @method('PUT')
        
            {{-- 自転車名の編集フィールド --}}
            <div class="mb-4">
                <label for="bicycle_name" class="block text-sm font-medium text-gray-700">自転車名</label>
                <input type="text" name="name" id="bicycle_name" value="{{ $bicycle->name ?? '' }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm text-center">
            </div>
        
            {{-- 自転車の総走行距離の編集フィールド --}}
            <div class="mb-4">
                <label for="total_mileage" class="block text-sm font-medium text-gray-700">総走行距離 (km)</label>
                <input type="number" name="total_mileage" id="total_mileage" value="{{ $bicycle->total_mileage ?? 0 }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm text-center">
            </div>
        
            <button type="submit" class="btn btn-primary">更新する</button>
        </form>
    
        {{-- 既存のパーツの編集フィールド --}}
        <h1 class="text-xl font-bold m-4">パーツの情報</h1>
        <form action="{{ route('parts.update.all') }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-8">
                @forelse ($parts as $index => $part)
                    <div class="flex gap-4 items-center mb-4 bg-white p-4 rounded-lg shadow">
                        <input type="hidden" name="parts[{{ $index }}][id]" value="{{ $part->id }}">
                        <div class="flex-1">
                            <label for="part_name_{{ $index }}" class="block text-sm font-medium text-gray-700 text-center">パーツ名</label>
                            <input type="text" name="parts[{{ $index }}][name]" id="part_name_{{ $index }}" value="{{ $part->name }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        </div>
                        <div class="flex-1">
                            <label for="part_mileage_{{ $index }}" class="block text-sm font-medium text-gray-700 text-center">走行距離(km)</label>
                            <input type="number" name="parts[{{ $index }}][mileage]" id="part_mileage_{{ $index }}" value="{{ $part->mileage }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        </div>
                    </div>
                @empty
                    <p>編集するパーツがありません。</p>
                @endforelse
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">パーツを更新する</button>
                </div>
            </div>

            {{-- 新しいパーツの追加フィールド --}}
            <div class="m-8">
                <h2 class="text-xl font-bold mb-4 text-center">新しいパーツを追加</h2>
                @for ($i = 0; $i < 4; $i++)
                    <div class="flex gap-4 items-center mb-4 bg-white p-4 rounded-lg shadow">
                        <div class="flex-1">
                            <input type="text" name="newParts[{{ $i }}][name]" placeholder="パーツ名" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-center">
                        </div>
                        <div class="flex-1">
                            <input type="number" name="newParts[{{ $i }}][mileage]" placeholder="走行距離(km)" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-center">
                        </div>
                    </div>
                @endfor
            </div>
            
            <div class="text-center">
                <button type="submit" class="btn btn-primary">パーツを更新する</button>
            </div>
        </form>
    </div>
</div>
@endsection