<ul>
    @foreach($items as $menu_item)
        <li>
            <a href="{{ $menu_item->link() }}">
                {{ $menu_item->title }}
                {{--@if( $menu_item->title == 'Cart')
                    @if(Cart::instance('default')->count() > 0)
                        <span>{{ Cart::instance('default')->count() }}</span></span>
                    @endif
                @endif--}}
            </a>
        </li>
    @endforeach
        <li><a class="menu-cart" onclick="openNav()" href="{{ route('cart.index') }}">CART<span>
                        @if(Cart::instance('default')->count() > 0)
                        <span>{{ Cart::instance('default')->count() }}</span></span>
                @endif
            </a>
        </li>
</ul>

{{--@if (! request()->is('checkout'))
        <ul>
            <li><a href="/">HOME</a></li>
            <li><a href="/shop">SHOP</a></li>
            <li><a href="/about">ABOUT</a></li>
            <li><a class="cart" href="{{ route('cart.index') }}">CART<span>
                        @if(Cart::instance('default')->count() > 0)
                        <span>{{ Cart::instance('default')->count() }}</span></span>
                        @endif
                </a>
            </li>
        </ul>
        @endif--}}