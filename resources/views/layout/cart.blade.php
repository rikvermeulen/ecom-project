@extends ('layout') {{--haalt <head> en layout op voor pagina--}}
@section('pageTitle', 'Home') {{--pagina titel--}}

@section ('content')

    {{--header--}}
    @include ('layout.partials.header')

    <main class="cart">
        <div class="cart-header">
            <h2>CART</h2>
            @if (session()->has('success_message'))
                <div class="alert alert-success">
                    {{ session()->get('success_message') }} {{--succes message als geslaagd zie controller --}}
                </div>
            @endif
            @if(count($errors) > 0) {{--als error hoger dan 0 display error zie controller--}}
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
        <div class="cart-wrap">

            <div class="cart-main">
            @if (Cart::count() > 0) {{--als items meer dan 0 display items--}}
                <p>{{ Cart::count()}} item(s) in shopping cart</p>

                <div class="cart-table">
                    @foreach (Cart::content() as $item) {{--voor elk item haal gegevens database op--}}
                    <div class="cart-table-row">
                        <div class="cart-table-row-left">
                            <a href="{{ route('shop.show', $item->model->slug) }}"><img src="{{ asset('storage/'.$item->model->image) }}" alt="item" class="cart-table-img"></a>
                        </div>
                        <div class="cart-item-details">
                            <div class="cart-table-item"><a href="{{ route('shop.show', $item->model->slug )}}">{{ $item->model->name }}</a></div>
                            <div class="cart-table-description">{{ $item->model->details }}</div>
                            <div>{{ presentPrice($item->subtotal) }}</div>
                        </div>
                        <div class="cart-table-row-right">
                            <form action="{{ route('cart.destroy', $item->rowId) }}" method="POST">
                                {{csrf_field()}}
                                {{ method_field('DELETE') }}
                                <button type="submit" class="cart-options">Remove</button>{{--verwijder item uit cart - destroy in controller--}}
                            </form>
                            <form action="{{ route('cart.switchToSaveForLater', $item->rowId) }}" method="POST">
                                {{csrf_field()}}
                                <button type="submit" class="cart-options">Save for later</button> {{--store item in saveforlater - store in controller--}}
                            </form>
                            <div>
                                <select class="quantity" data-id="{{ $item->rowId }}" data-productQuantity="{{ $item->model->quantity }}">
                                    @for ($i = 1; $i < 5 + 1 ; $i++)
                                        <option {{ $item->qty == $i ? 'selected' : '' }}>{{ $i }}</option>{{--select hoeveelheid van 1 tot 5 default 1 als selected veranderd hoeveelheid--}}
                                    @endfor
                                </select>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="cart-table">
                    <div class="cart-table-row">
                    <div class="cart-totals">
                        <div class="cart-totals-subtotal">subtotal{{ presentPrice(Cart::subtotal())}}<br>tax{{ presentPrice(Cart::tax())}}<br>{{--subtotal and tax insamen werking met cart plugin--}}
                            <span class="cart-totals-subtotal-total">total{{ presentPrice(Cart::total())}}</span> {{--berekend subtotal + tax zie helper.php--}}
                        </div>
                    </div>
                    <div class="cart-button">
                        <a href="{{ route('shop.index') }}" class="button">Continue Shopping</a> {{--terug naar shop page--}}
                        <a href="{{ route('checkout.index') }}" class="button-primary">Checkout</a> {{--verder naar betaal pagina--}}
                    </div>
                    </div>
                </div>

                @else

                    {{--als geen items display content hier onder--}}

                <p>No items in cart</p>
                <a href="{{ route('shop.index') }}" class="button">Continue Shopping</a>
            @endif
            </div>
        </div>


            @if (Cart::instance('saveForLater')->count() > 0){{--als saveforlater heeft meer dan 0 item display items--}}
                <div class="cart-header">
                 <p>{{ Cart::instance('saveForLater')->count()}} item(s) saved for later</p>{{--count aantal saveforlater items--}}
                 <h4>saved for later</h4>
                </div>
            <div class="cart-wrap">
                <div class="cart-main">
                <div class="cart-table">

                        @foreach (Cart::instance('saveForLater')->content() as $item ){{--als saveforlater item heeft display content daarvanv--}}
                                <div class="cart-table-row">

                            <a href="{{ route('shop.show', $item->model->slug) }}"><img src="{{ asset('storage/'.$item->model->image) }}" alt="item" class="cart-table-img"></a>
                            <div class="cart-item-details">
                                <div class="cart-table-item"><a href="{{ route('shop.show', $item->model->slug )}}">{{ $item->model->name }}</a></div>
                                <div class="cart-table-description">{{ $item->model->details }}</div>
                            </div>
                            <div class="cart-table-row-right">
                                <div>{{ $item->model->presentPrice()}}</div>
                                <form action="{{ route('saveForLater.destroy', $item->rowId) }}" method="POST">
                                    {{csrf_field()}}
                                    {{ method_field('DELETE') }}

                                    <button type="submit" class="cart-options">Remove</button>{{--verwijderd item van saveforlater -destroy in controller--}}
                                </form>
                                <form action="{{ route('saveForLater.switchToCart', $item->rowId) }}" method="POST">
                                    {{csrf_field()}}

                                    <button type="submit" class="cart-options">move to cart</button>{{--stored item in cart - zie store controller--}}
                                </form>
                            </div>
                        @endforeach
                    </div>
                </div>

                @else
            </div>
            </div>

            @endif

    </main>

    {{--footer--}}
    @include ('layout.partials.footer')

    {{--javascript voor items berekening in cart--}}
    <script>
        (function(){
            const classname = document.querySelectorAll('.quantity')
            Array.from(classname).forEach(function(element) {
                element.addEventListener('change', function() {
                    const id = element.getAttribute('data-id')
                    axios.patch(`/cart/${id}`, {
                        quantity: this.value,
                    })
                        .then(function (response) {
                            // console.log(response);
                            window.location.href = '{{ route('cart.index') }}'
                        })
                        .catch(function (error) {
                            // console.log(error);
                            window.location.href = '{{ route('cart.index') }}'
                        });
                })
            })
        })();
    </script>

@endsection