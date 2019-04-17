@extends ('layout')
@section('pageTitle', 'Home')

@section ('content')

    {{--header--}}
    @include ('layout.partials.header')

    <main class="cart">
        <div class="cart-header">
            <h2>CART</h2>
            @if (session()->has('success_message'))
                <div class="alert alert-success">
                    {{ session()->get('success_message') }}
                </div>
            @endif
            @if(count($errors) > 0)
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
            @if (Cart::count() > 0)
                <p>{{ Cart::count()}} item(s) in shopping cart</p>

                <div class="cart-table">
                    @foreach (Cart::content() as $item)
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
                                <button type="submit" class="cart-options">Remove</button>
                            </form>
                            <form action="{{ route('cart.switchToSaveForLater', $item->rowId) }}" method="POST">
                                {{csrf_field()}}
                                <button type="submit" class="cart-options">Save for later</button>
                            </form>
                            <div>
                                <select class="quantity" data-id="{{ $item->rowId }}" data-productQuantity="{{ $item->model->quantity }}">
                                    @for ($i = 1; $i < 5 + 1 ; $i++)
                                        <option {{ $item->qty == $i ? 'selected' : '' }}>{{ $i }}</option>
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
                        <div class="cart-totals-subtotal">subtotal{{ presentPrice(Cart::subtotal())}}<br>tax{{ presentPrice(Cart::tax())}}<br>
                            <span class="cart-totals-subtotal-total">total{{ presentPrice(Cart::total())}}</span>
                        </div>
                    </div>
                    <div class="cart-button">
                        <a href="{{ route('shop.index') }}" class="button">Continue Shopping</a>
                        <a href="{{ route('checkout.index') }}" class="button-primary">Checkout</a>
                    </div>
                    </div>
                </div>

                @else

                <p>No items in cart</p>
                <a href="{{ route('shop.index') }}" class="button">Continue Shopping</a>
            @endif
            </div>
        </div>


            @if (Cart::instance('saveForLater')->count() > 0)
                <div class="cart-header">
                 <p>{{ Cart::instance('saveForLater')->count()}} item(s) saved for later</p>
                 <h4>saved for later</h4>
                </div>
            <div class="cart-wrap">
                <div class="cart-main">
                <div class="cart-table">

                        @foreach (Cart::instance('saveForLater')->content() as $item )
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

                                    <button type="submit" class="cart-options">Remove</button>
                                </form>
                                <form action="{{ route('saveForLater.switchToCart', $item->rowId) }}" method="POST">
                                    {{csrf_field()}}

                                    <button type="submit" class="cart-options">move to cart</button>
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