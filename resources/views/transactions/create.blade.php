@extends('layouts.logged')

@section('title')
    Create new transaction
@endsection

@section('main')
    <div class="columns">
        <div class="column is-half">
            <form class="form-horizontal" action="{{ route('transactions.store') }}" method="post">
                @include('transactions.form')
            </form>
        </div>
    </div>
@endsection
