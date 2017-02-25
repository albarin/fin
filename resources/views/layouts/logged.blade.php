@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-xs-3">
                @include('layouts.menu')
            </div>

            <div class="col-md-9 col-xs-9">
                <div class="panel panel-default">
                    <div class="panel-heading">@yield('title')</div>

                    <div class="panel-body">
                        @yield('main')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
