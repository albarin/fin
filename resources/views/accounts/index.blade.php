@extends('layouts.logged')

@section('title')
    Accounts
    <a class="button is-pulled-right is-primary is-inverted" href="{{ route('accounts.create') }}">
        Add account
    </a>
@endsection

@section('main')
    @if (session('error'))
        <div class="notification is-warning">
            {{ session('error') }}
        </div>
    @endif

    @if (count($accounts) > 0)
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($accounts as $account)
                    <tr>
                        <td>{{ $account->name }}</td>
                        <td>
                            <a class="button is-pulled-left is-small is-info" href="{{ route('accounts.edit', $account) }}">Edit</a>

                            <form style="margin-left: 10px;" class="is-pulled-left" action="{{ route('accounts.destroy', $account) }}" method="post">
                                {{ csrf_field() }}
                                {{ method_field('delete') }}
                                <button class="button is-small is-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection