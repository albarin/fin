@extends('layouts.logged')

@section('title')
    Create new account
@endsection

@section('main')
    <form class="form-horizontal" action="{{ route('accounts.store') }}" method="post">
        @include('accounts.form')
    </form>
@endsection
