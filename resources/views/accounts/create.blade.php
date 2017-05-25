@extends('layouts.logged')

@section('title')
    Add account
@endsection

@section('main')
    <div class="columns">
        <div class="column is-one-quarter">
            <form class="form-horizontal" action="{{ route('accounts.store') }}" method="post">
                @include('accounts.form')
            </form>
        </div>
    </div>
@endsection
