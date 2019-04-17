@extends ('layout')
@section('pageTitle', 'Home')

<script src="https://js.stripe.com/v3/"></script>

@section ('content')

    {{--header--}}
    @include ('layout.partials.header')
    <div class="checkout-header">
        <h2>CHECKOUT</h2>
    </div>
    <main>
        <div class="checkout">
                    <form action="{{ route('checkout.store') }}" method="post" id="payment-form" class="checkout-form">
                    {{csrf_field()}}
                        <div class="checkout-wrap">
                            @if (session()->has('success_message'))
                                <div class="spacer"></div>
                                <div class="alert alert-success">
                                    {{ session()->get('success_message') }}
                                </div>
                            @endif

                            @if(count($errors) > 0)
                                <div class="spacer"></div>
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{!! $error !!}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <div class="checkout-main">
                                <div class="form-group">
                                    <div class="form-section">
                                <div class="form-group">
                                    <p class="from-group-title">customer info</p>
                                    <label for="email">Email Address</label>
                                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
                                </div>
                            </div>
                                    <div class="form-section">
                                        <div class="form-group">
                                            <div class="form-input">
                                                <p class="from-group-title">shipping address</p>
                                                <label for="name">Name</label>
                                                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
                                            </div>
                                            <div class="form-input">
                                                <label for="address">Address</label>
                                                <input type="text" class="form-control" id="address" name="address" value="{{ old('address') }}" required>
                                            </div>

                                            <div class="form-input">
                                                <label for="city">City</label>
                                                <input type="text" class="form-control" id="city" name="city" value="{{ old('city') }}" required>
                                            </div>
                                            <div class="form-input">
                                                <label for="province">Province</label>
                                                <input type="text" class="form-control" id="province" name="province" value="{{ old('province') }}" >
                                            </div>
                                            <div class="form-group">
                                                <label for="postalcode">Postal Code</label>
                                                <input type="text" class="form-control" id="postalcode" name="postalcode" value="{{ old('postalcode') }}" >
                                            </div>
                                            <div class="form-input">
                                                <label for="phone">Phone</label>
                                                <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone') }}" >
                                            </div>
                                     
                                        </div>
                                    </div>
                                    <div class="form-section">
                                        <div class="form-group">
                                            <p>payment</p>
                                            <label for="card-element">
                                            Credit or debit card
                                            </label>
                                            <div id="card-element">
                                        <!-- A Stripe Element will be inserted here. -->
                                    </div>
                                            <!-- Used to display form errors. -->
                                            <div id="card-errors" role="alert"></div>
                                        </div>
                                    </div>
                                    <div class="form-section">
                                        <div class="form-group">
                                            <p>items in order</p>
                                            <div class="checkout-table">
                                                @foreach (Cart::content() as $item)
                                                    <div class="checkout-table-row">
                                                        <img src="{{ asset('storage/'.$item->model->image) }}" alt="item" class="checkout-table-img">
                                                        <div class="checkout-item-details">
                                                            <p class="cart-table-item">{{ $item->model->name }}</p>
                                                            <p class="cart-table-description">{{ $item->model->details }}</p>
                                                            <p class="checkout-table-quantity">{{ $item->qty }} from this product</p><br>
                                                        </div>
                                                        <div class="cart-table-price">{{ $item->model->presentPrice() }}</div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="checkout-aside">
                                <div class="checkout-totals">
                                    <p>subtotal</p>
                                    {{ presentPrice(Cart::subtotal()) }}<br>
                                    @if (session()->has('coupon'))

                                        <p style="display: inline">discount</p>({{ session()->get('coupon')['name'] }})
                                        <form action="{{ route('coupon.destroy') }}" method="POST">
                                            {{ csrf_field() }}
                                            {{ method_field('delete') }}
                                            <button type="submit">Remove</button>
                                        </form>
                                        {{ presentPrice($discount)}}
                                        <hr>
                                        {{ presentPrice($newSubtotal) }}

                                        <hr>
                                        <p>New subtotal</p>
                                    @endif
                                    <p>tax(21%)</p>
                                    {{ presentPrice($newTax) }}<br>
                                    <div class="checkout-totals-total">
                                        <p>total</p>
                                        {{ presentPrice($newTotal) }}
                                    </div>

                                    <hr>
                                </div>
                                <button type="submit" id="complete-order" class="button-primary">complete order</button>
                            </div>
                        </div>
                    </form>
            <div class="checkout-coupon">
                @if (! session()->has('coupon'))
                    <div class="coupon">
                        <form action="{{ route('coupon.store') }}" method="POST">
                            {{csrf_field()}}
                            <input type="text" name="coupon_code" id="coupon_code">
                            <button type="submit" >apply</button>
                        </form>
                    </div>
                @endif
            </div>

        </div>
    </main>

    <script>
        (function () {
            // Create a Stripe client.
            var stripe = Stripe('pk_test_1gbuFbVe7ckatXh7dbgMeEWp00QxgnKmLB');

            // Create an instance of Elements.
            var elements = stripe.elements();

            // Custom styling can be passed to options when creating an Element.
            // (Note that this demo uses a wider set of styles than the guide below.)
            var style = {
                base: {
                    color: '#32325d',
                    fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
                    fontSmoothing: 'antialiased',
                    fontSize: '16px',
                    '::placeholder': {
                        color: '#aab7c4'
                    }
                },
                invalid: {
                    color: '#fa755a',
                    iconColor: '#fa755a'
                }
            };

            // Create an instance of the card Element.
            var card = elements.create('card', {
                style: style,
                hidePostalCode: true
            });

            // Add an instance of the card Element into the `card-element` <div>.
            card.mount('#card-element');

            // Handle real-time validation errors from the card Element.
            card.addEventListener('change', function(event) {
                var displayError = document.getElementById('card-errors');
                if (event.error) {
                    displayError.textContent = event.error.message;
                } else {
                    displayError.textContent = '';
                }
            });

            // Handle form submission.
            var form = document.getElementById('payment-form');
            form.addEventListener('submit', function(event) {
                event.preventDefault();

                document.getElementById('complete-order').disabled = true;

                var options = {
                   name: document.getElementById('name').value,
                   address_line1: document.getElementById('address').value,
                   address_city: document.getElementById('city').value,
                   address_state: document.getElementById('province').value,
                   address_zip: document.getElementById('postalcode').value,
                };

                stripe.createToken(card, options).then(function(result) {
                    if (result.error) {
                        // Inform the user if there was an error.
                        var errorElement = document.getElementById('card-errors');
                        errorElement.textContent = result.error.message;
                        document.getElementById('complete-order').disabled = false;
                    } else {
                        // Send the token to your server.
                        stripeTokenHandler(result.token);
                    }
                });
            });

            // Submit the form with the token ID.
            function stripeTokenHandler(token) {
                // Insert the token ID into the form so it gets submitted to the server
                var form = document.getElementById('payment-form');
                var hiddenInput = document.createElement('input');
                hiddenInput.setAttribute('type', 'hidden');
                hiddenInput.setAttribute('name', 'stripeToken');
                hiddenInput.setAttribute('value', token.id);
                form.appendChild(hiddenInput);

                // Submit the form
                form.submit();
            }
        })();
    </script>

    {{--footer--}}
    @include ('layout.partials.footer')

@endsection

