@extends('layouts.logged')

@section('title')
    Edit transaction
@endsection

@section('main')
    <form class="form-horizontal" action="{{ route('transactions.update', $transaction) }}" method="post">
        {{ method_field('put') }}
        @include('transactions.form')
    </form>
@endsection
