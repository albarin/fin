@extends('layouts.logged')

@section('title')
    Edit category
@endsection

@section('main')
    <form class="form-horizontal" action="{{ route('categories.update', $category) }}" method="post">
        {{ method_field('put') }}
        @include('categories.form')
    </form>
@endsection
