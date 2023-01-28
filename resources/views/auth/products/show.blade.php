<x-layout>

    <x-slot name='title'>
        Продукт {{ $product->name }}
    </x-slot>

    <div class="col-md-12">
        <h1>{{ $product->name }}</h1>
        <table class="table">
            <tbody>
                <tr>
                    <th>
                        Поле
                    </th>
                    <th>
                        Значение
                    </th>
                </tr>
                <tr>
                    <td>ID</td>
                    <td>{{ $product->id }}</td>
                </tr>
                <tr>
                    <td>Код</td>
                    <td>{{ $product->code }}</td>
                </tr>
                <tr>
                    <td>Название</td>
                    <td>{{ $product->name }}</td>
                </tr>
                <tr>
                    <td>Описание</td>
                    <td>{{ $product->description }}</td>
                </tr>
                <tr>
                    <td>Картинка</td>
                    <td><img src="{{ Storage::url($product->image) }}" alt="{{ Storage::url($product->name) }}" height="240px"></td>
                </tr>
                <tr>
                    <td>Категория</td>
                    <td>{{ $product->category->name }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</x-layout>
