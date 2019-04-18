@extends ('layout') {{--haalt <head> en layout op voor pagina--}}
@section('pageTitle', 'Home') {{--pagina titel--}}

@section ('content')

    {{--header--}}
    @include ('layout.partials.header')

    <main>
        <div class="cart-header" style="padding-bottom: 20px">
        <h2>coming soon :)</h2>
        </div>
    </main>

    {{--footer--}}
    @include ('layout.partials.footer')

@endsection
