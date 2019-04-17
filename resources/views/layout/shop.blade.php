@extends ('layout')
@section('pageTitle', 'Home')

@section ('content')

    {{--header--}}
    @include ('layout.partials.header')
    <main>
        <div class="wrap">
        <div class="products-header">
            <h2>{{ $categoryName }}</h2>
            <div>
                <label for="">price</label>
                <a href="{{ route('shop.index', ['category'=> request()->category, 'sort' => 'low_high']) }}">low to high</a>
                <a href="{{ route('shop.index', ['category'=> request()->category, 'sort' => 'high_low']) }}">high to low</a>
            </div>
        </div>
        <div class="products-category">
            @foreach($categories as $category)
                <li class="{{ request()->category == $category->slug ? 'active' : '' }}"><a href="{{ route('shop.index', ['category' => $category->slug]) }}">{{ $category->name }}</a></li>{{--if active add active class and list of category--}}
            @endforeach
        </div>

        <div class="product-wrap">
            @forelse($products as $product)
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