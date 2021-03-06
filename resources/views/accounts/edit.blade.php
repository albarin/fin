@extends('layouts.logged')

@section('title')
    Edit <strong>{{ $account->name }}</strong> account
@endsection

@section('main')
    <div class="columns">
        <div class="column is-half">
            <form class="form-horizontal" action="{{ route('accounts.update', $account) }}" method="post">
                {{ method_field('put') }}
                @include('accounts.form')
            </form>
        </div>
    </div>
@endsection
