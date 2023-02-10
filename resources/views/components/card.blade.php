<div class="col-sm-6 col-md-4">
    <div class="thumbnail">
        <div class="labels">
            @if ($product->isNew())
                <span class="badge badge-success">Новинка</span>
            @endif

            @if ($product->isRecommend())
                <span class="badge badge-warning">Рекомендуем</span>
            @endif

            @if ($product->isHit())
                <span class="badge badge-danger">Хит продаж!</span>
            @endif
        </div>
        <div class="labels">
        </div>
        <img src="{{ Storage::url($product->image) }}" alt="{{ Storage::url($product->name) }}" height="240px">
        <div class="caption">
            <h3>{{ $product->name }}</h3>
            <p>{{ $product->price }} ₽</p>
            <br>
            <p>Категория: {{ $product->category->name }}</p>
            <form action="{{ route('basket-add', $product) }}" method="POST">
                @if($product->isAvailable())
                <button type="submit" class="btn btn-primary" role="button">В корзину</button>
                @else
                <button type="submit" class="btn btn-primary" role="button">Заказать</button>
                @endif
                <a href="{{ route('product', [$product->category->code, $product->code]) }}" class="btn btn-default"
                    role="button">Подробнее</a>
                @csrf
            </form>
            <p></p>
        </div>
    </div>
</div>
