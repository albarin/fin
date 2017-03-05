@extends('layouts.logged')

@section('title')
    Create new transaction
@endsection

@section('main')
    <form class="form-horizontal" action="{{ route('transactions.store') }}" method="post">
        @include('transactions.form')
    </form>
@endsection
