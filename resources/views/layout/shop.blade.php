@extends ('layout')
@section('pageTitle', 'Home')

@section ('content')

    {{--header--}}
    @include ('layout.partials.header')
    <main>
        <div class="wrap">
        <div class="products-header">
            <h2>{{ $categoryName }}</h2>{{--display active categorie naam--}}
            <div>
                <label for="">price</label>
                <a href="{{ route('shop.index', ['category'=> request()->category, 'sort' => 'low_high']) }}">low to high</a> {{--sorteerd producten op prijs--}}
                <a href="{{ route('shop.index', ['category'=> request()->category, 'sort' => 'high_low']) }}">high to low</a> {{--sorteerd producten op prijs--}}
            </div>
        </div>
        <div class="products-category">
            @foreach($categories as $category) {{--voor elke categorie in db laat zien als li--}}
                <li class="{{ request()->category == $category->slug ? 'active' : '' }}"><a href="{{ route('shop.index', ['category' => $category->slug]) }}">{{ $category->name }}</a></li>{{--als active voeg active class toe and list of categorien--}}
            @endforeach
        </div>

        <div class="product-wrap">
            @forelse($products as $product){{--display items gegevens voor elke item op shop page--}}
                <div class="product-item">
                    <a href="{{ route('shop.show', $product->slug) }}"><img src="{{ asset('storage/'.$product->image) }}" alt=""></a>
                    <div class="product-prize">{{ $product->presentPrice()}}</div>
                    <a href="{{ route('shop.show', $product->slug) }}">{{$product->name}}</a>
                </div>
                @empty
                <div>no items found</div>
            @endforelse
        </div>

        {{ $products->appends(request()->input())->links() }}
        </div>
    </main>

    {{--footer--}}
    @include ('layout.partials.footer')

@endsection