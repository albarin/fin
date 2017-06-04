@extends('layouts.logged')

@section('title')
    Create new category
@endsection

@section('main')
    <div class="columns">
        <div class="column is-half">
            <form class="form-horizontal" action="{{ route('categories.store') }}" method="post">
                @include('categories.form')
            </form>
        </div>
    </div>
@endsection
