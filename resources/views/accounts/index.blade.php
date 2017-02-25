@extends('layouts.logged')

@section('title')
    Accounts
@endsection

@section('main')
    @if (count($accounts) > 0)
        <ul class="accounts">
            @foreach ($accounts as $account)
                <li class="accounts-{{ $account->id }}">{{ $account->name }}</li>
            @endforeach
        </ul>
    @endif
@endsection