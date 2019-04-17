<ul>
    @foreach($items as $menu_item) {{--voor elke menu item day bestaat in db--}}
        <li>
            <a href="{{ $menu_item->link() }}">
                {{ $menu_item->title }} {{--haalt menu links op uit db--}}
                {{--@if( $menu_item->title == 'Cart')
                    @if(Cart::instance('default')->count() > 0)
                        <span>{{ Cart::instance('default')->count() }}</span></span>
                    @endif
                @endif--}}
            </a>
        </li>
    @endforeach
        <li><a class="menu-cart" href="{{ route('cart.index') }}">CART<span>
                        @if(Cart::instance('default')->count() > 0) {{--als Cart meer dan 0 items heeft display getal--}}
                        <span>{{ Cart::instance('default')->count() }}</span></span>
                @endif
            </a>
        </li>
</ul>