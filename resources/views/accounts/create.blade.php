@extends('layouts.logged')

@section('title')
    Create new account
@endsection

@section('main')
    <form action="{{ route('accounts.store') }}" method="post">
        {{ csrf_field() }}

        <input type="text" name="name">

        <button type="submit">Save</button>
    </form>
@endsection
