<x-layout>
    <x-slot name='title'>
        Товар
    </x-slot>
    <h1>{{ $product->name }}</h1>
    <h2>{{ $product->category->name }}</h2>
    <p>Цена: <b>{{ $product->price }}</b></p>
    <img src="{{ Storage::url($product->image) }}" height="240px">
    <p>{{ $product->description }}</p>
    <form action="{{ route('basket-add', $product) }}" method="POST">
        @if($product->isAvailable())
        <button type="submit" class="btn btn-primary" role="button">В корзину</button>
        @else
        <button type="submit" class="btn btn-primary" role="button">Заказать</button>
        @endif
        @csrf
    </form>
</x-layout>
