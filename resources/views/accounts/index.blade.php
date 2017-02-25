@extends('layouts.logged')

@section('title')
    Accounts
@endsection

@section('main')
    @if (count($accounts) > 0)
        <ul class="accounts">
            @foreach ($accounts as $account)
                <li class="accounts-{{ $account->id }}">{{ $account->name }}</li>

                <a href="{{ route('accounts.edit', $account) }}">Edit</a>

                <form action="{{ route('accounts.destroy', $account) }}" method="post">
                    {{ csrf_field() }}
                    {{ method_field('delete') }}
                    <button>Delete</button>
                </form>
            @endforeach
        </ul>
    @endif

    <div>
        <a href="{{ route('accounts.create') }}">Add account</a>
    </div>
@endsection