@extends('layouts.logged')

@section('title')
    Create new category
@endsection

@section('main')
    <form class="form-horizontal" action="{{ route('categories.store') }}" method="post">
        @include('categories.form')
    </form>
@endsection
