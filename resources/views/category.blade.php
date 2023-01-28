<x-layout>
    <x-slot name='title'>
        {{ $category->name }}
    </x-slot>
    <h1>
        {{ $category->name }}
    </h1>
    <p>
        Товаров в категории: {{ $category->products->count() }}
    </p>
    <p>
        {{ $category->description }}
    </p>
    <div class="row">
        @foreach ($category->products as $product)
            @include('components.card', compact('product'))
        @endforeach
    </div>
</x-layout>
