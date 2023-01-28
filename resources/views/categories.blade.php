<x-layout>
    <x-slot name='title'>
        Категории
    </x-slot>
    @foreach ($categories as $category)
        <div class="panel">
            <a href="{{ route('category', $category->code) }}">
                <img src="{{ Storage::url($category->image) }}" alt="{{ Storage::url($category->name) }}" height="240px">
                <h2>{{ $category->name }}</h2>
            </a>
            <p>
                {{ $category->description }}
            </p>
        </div>
    @endforeach
</x-layout>
