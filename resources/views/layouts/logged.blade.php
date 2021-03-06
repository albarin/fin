@extends('layouts.app')

@section('content')
    <div class="section">
        <div class="container">
            <div class="columns">
                <div class="column is-one-quarter">
                    @include('layouts.menu')
                </div>

                <div class="column">
                    <h3 class="title">@yield('title')</h3>

                    @yield('main')
                </div>
                {{--<div class="column is-2">--}}
                    {{--@include('layouts.menu')--}}
                {{--</div>--}}
            </div>
        </div>
    </div>
@endsection
