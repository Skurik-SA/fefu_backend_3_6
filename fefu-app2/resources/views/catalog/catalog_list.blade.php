@foreach($categories as $category)
    <ul>
        <li>
            <a href="{{ route('catalog', ['slug' => $category->slug]) }}">
                {{ $category->name }}
            </a>
            @if(count($category->children))
                @include('catalog.catalog_list', ['categories' => $category->children])
            @endif
        </li>
    </ul>
@endforeach
