@extends ('layout')
@section('pageTitle', 'Home')

@section ('content')

    {{--header--}}
    @include ('layout.partials.header')
    <main>
        <section>
            <div class="index-hero">
                <div class="wrap">
                    <div class="index-hero-title">
                        <h1>HANDMADE IN<br> ENGLAND.<br> MADE TO<br> MEASURE.</h1>
                    </div>
                </div>
            </div>
        </section>
        <section>
            <div class="index-intro">
                <div class="wrap">
                    <div class="index-intro-title">
                        <h2>EXPLORE.</h2>
                    </div>
                </div>
            </div>
        </section>
        <section>
            <div class="index-product">
                @foreach ($products as $product)
                    <div class="index-product-single">
                        <a href="{{ route('shop.show', $product->slug) }}">{{--<img src="{{ asset('images/product/'.$product->slug.'.jpg') }}" alt="">--}}</a>
                        <a class="home-product-name" href="{{ route('shop.show', $product->slug) }}">{{$product->name}}</a>
                        {{--<div class="product-prize">{{ $product->presentPrice()}}</div>--}} {{--price from product--}}
                    </div>

                @endforeach
            </div>
        </section>

    </main>

    {{--footer--}}
    @include ('layout.partials.footer')

@endsection