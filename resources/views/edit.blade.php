@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-3xl font-bold mb-4">パーツの一括編集</h1>
    <form action="{{ route('parts.update.all') }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @forelse ($parts as $index => $part)
                <div class="p-4 bg-white shadow-md rounded-lg">
                    <input type="hidden" name="parts[{{ $index }}][id]" value="{{ $part->id }}">
                    <div class="mb-4">
                        <label for="part_name_{{ $index }}" class="block text-sm font-medium text-gray-700">パーツ名</label>
                        <input type="text" name="parts[{{ $index }}][name]" id="part_name_{{ $index }}" value="{{ $part->name }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>
                    <div>
                        <label for="part_mileage_{{ $index }}" class="block text-sm font-medium text-gray-700">走行距離(km)</label>
                        <input type="number" name="parts[{{ $index }}][mileage]" id="part_mileage_{{ $index }}" value="{{ $part->mileage }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center p-4 bg-white shadow-md rounded-lg">
                    <span>編集するパーツがありません。</span>
                </div>
            @endforelse
        </div>
        
        <div class="mt-4">
            <button type="submit" class="btn btn-primary">一括更新</button>
        </div>
    </form>
</div>
@endsection