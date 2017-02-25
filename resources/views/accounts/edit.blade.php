@extends('layouts.logged')

@section('title')
    Edit account
@endsection

@section('main')
    <form action="{{ route('accounts.update', $account) }}" method="post">
        {{ method_field('put') }}
        @include('accounts.form')
    </form>
@endsection
