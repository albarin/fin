@extends('layouts.logged')

@section('title')
    Edit transaction
@endsection

@section('main')
    <div class="columns">
        <div class="column is-half">
            <form class="form-horizontal" action="{{ route('transactions.update', $transaction) }}" method="post">
                {{ method_field('put') }}
                @include('transactions.form')
            </form>
        </div>
    </div>
@endsection
