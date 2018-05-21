@extends('layouts.logged', [''])

@section('title')
    Global
    <span style="vertical-align: middle" class="subtitle">{{ $totalBalance }}&euro;</span>
@endsection

@section('main')
    <table class="table is-narrow">
        <thead>
            <tr>
                <th>Account</th>
                <th>Balance</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($accounts as $account)
                <tr>
                    <td><a href="{{ route('accounts.show', [$account]) }}">{{ $account->name }}</a></td>
                    <td>{{ $account->total }}&euro;</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
