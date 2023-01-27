<x-layout>
    <x-slot name='title'>
        Категории
    </x-slot>
    <div class="starter-template">
        @foreach ($categories as $category)
            <div class="panel">
                <a href="/{{ $category->code }}">
                    <img src="http://internet-shop.tmweb.ru/storage/categories/mobile.jpg">
                    <h2>{{ $category->name }}</h2>
                </a>
                <p>
                    {{ $category->description }}
                </p>
            </div>
        @endforeach
    </div>
</x-layout>
