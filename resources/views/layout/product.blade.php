@extends ('layout')

@section ('title', $product->name)

@section('pageTitle', 'Home')

@section ('content')

    {{--header--}}
    @include ('layout.partials.header')
    <main>
        <div class="product">
        <div class="product-single">
            <h3 class="product-single-name">{{ $product->name }}</h3>
            <div class="product-single-img" href=""><div class="space"></div>
                {{--<img src="{{ asset('images/product/'.$product->slug.'.jpg') }}" alt="">--}}
                <img src="{{ productImage($product->image) }}" alt=""> {{--function for broken link more in helper file--}}

                <div>
                    @if ($product->images)
                        @foreach (json_decode($product->images, true) as $image)
                            <img src="{{productImage($image)}}" alt="">
                        @endforeach
                    @endif
                </div>
            </div>
            <div class="product-single-section">
                <p class="product-single-section-description">{!! $product->description !!}</p>
                <div class="product-single-section-details">{{ $product->detials }}</div>
                <div class="product-single-section-price">{{ $product->presentPrice()}}</div>

                <form action="{{ route('cart.store') }}" method="POST">
                    {{ csrf_field() }}
                    <input type="hidden" name="id" value="{{ $product->id }}">
                    <input type="hidden" name="name" value="{{ $product->name }}">
                    <input type="hidden" name="price" value="{{ $product->price }}">
                    <button type="submit" class="button">Add to cart</button>
                </form>
            </div>
        </div>
        </div>

    </main>

    {{--footer--}}
    @include ('layout.partials.footer')

@endsection