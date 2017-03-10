@extends('layouts.logged')

@section('title')
    Edit tag
@endsection

@section('main')
    <form class="form-horizontal" action="{{ route('tags.update', $tag) }}" method="post">
        {{ method_field('put') }}
        @include('tags.form')
    </form>
@endsection
