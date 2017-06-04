@extends('layouts.logged')

@section('title')
    Edit <strong>{{ $category->name }}</strong> category
@endsection

@section('main')
    <div class="columns">
        <div class="column is-half">
            <form class="form-horizontal" action="{{ route('categories.update', $category) }}" method="post">
                {{ method_field('put') }}
                @include('categories.form')
            </form>
        </div>
    </div>
@endsection
