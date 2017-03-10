@extends('layouts.logged')

@section('title')
    Create new tag
@endsection

@section('main')
    <form class="form-horizontal" action="{{ route('tags.store') }}" method="post">
        @include('tags.form')
    </form>
@endsection
