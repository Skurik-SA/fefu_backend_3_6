<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="/css/little_links.css">
    <title>Catalog</title>
</head>
<body>
<div>
    <form action="{{route('catalog')}}" method="GET">
        <input type="text" name="search_query" value="{{request('search_query')}}">
        <select name="sort_mode" id="sort_mode">
            <option value="price_asc" {{request('sort_mode') == 'price_asc' ? 'selected' : ''}}>Price asc</option>
            <option value="price_desc" {{request('sort_mode') == 'price_desc' ? 'selected' : ''}}>Price desc</option>
        </select>
        @foreach($filters as $filter)
            <h4>{{ $filter->name }}</h4>
            @foreach($filter->options as $option)
                <div>
                    <label>
                        <input type="checkbox" value="{{ $option->value }}" name="filters[{{ $filter->key }}][]"
                            {{ $option->isSelected ? 'checked' : '' }}>
                        {{ $option->value }} ({{ $option->productCount }})
                    </label>
                </div>
            @endforeach
        @endforeach
        <button>Apply</button>
    </form>
    @include('catalog.catalog_list', ['categories', $categories])
    @foreach ($products as $product)
        <article>
            <a href="{{ route('product', $product->slug) }}">
                <h3>{{ $product->name }}</h3>
            </a>
            <p>{{ $product->price }} руб.</p>
        </article>
    @endforeach
    <div name="little">{{ $products->links() }}</div>
</div>
</body>
</html>
