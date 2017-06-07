@extends('layouts.logged')

@section('title')
    {{ $account->name }}
    <span style="vertical-align: middle" class="subtitle">{{ $balance }}&euro;</span>
    <a class="button is-pulled-right is-primary is-inverted"
       href="{{ route('transactions.create', ['account_id' => $account->id]) }}">
        Add transaction
    </a>
@endsection

@section('main')
    @include('accounts.filters')

    @if ($transactions->isEmpty())
        <div class="notification">
            No transactions found in the account
        </div>
    @else
        <table class="table">
            <thead>
            <tr>
                <th>Date</th>
                <th>Name</th>
                <th>Category</th>
                <th>Value</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($transactions as $transaction)
                <tr>
                    <td>{{ $transaction->date }}</td>
                    <td>
                        <strong>{{ $transaction->name }}</strong>
                        @if ($transaction->tags->isNotEmpty())
                            <p style="font-size: 13px">
                                <strong>
                                    {{ $transaction->tags()->pluck('name')->implode(',') }}
                                </strong>
                            </p>
                        @endif
                    </td>
                    <td>
                        @if ($transaction->category)
                            <span class="tag" style="background-color: {{ $transaction->category->color }}; color: white;">
                                {{ $transaction->category->name }}
                            </span>
                        @endif
                    </td>
                    <td style="color: {{ $transaction->color }}">
                        {{ $transaction->formattedAmount }}&euro;
                    </td>
                    <td>
                        <a class="button is-pulled-left is-small is-info" href="{{ route('transactions.edit', [$transaction]) }}">
                            Edit
                        </a>
                        <form style="margin-left: 10px;" class="is-pulled-left" action="{{ route('transactions.destroy', ['id' => $transaction->id]) }}" method="post">
                            {{ csrf_field() }}
                            {{ method_field('delete') }}
                            <button class="button is-small is-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{ $transactions->appends(request()->all())->links() }}
    @endif
@endsection
