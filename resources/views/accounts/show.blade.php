@extends('layouts.logged')

@section('title')
    {{ $account->name }}
    <a class="button is-pulled-right is-primary is-inverted" href="{{ route('accounts.create') }}">
        Add account
    </a>
@endsection

@section('main')
    <nav class="level">
        <div class="level-right">
            <span style="margin-right: 5px" class="icon">
                <i class="fa fa-calendar"></i>
            </span>
            <p class="control">
                <span class="select">
                    <select>
                        <option>Select month...</option>
                        <option>Mayo 2017</option>
                    </select>
                </span>
            </p>

            <span style="margin-right: 5px; margin-left: 20px" class="icon">
                <i class="fa fa-tag"></i>
            </span>
            <p class="control">
                <span class="select">
                    <select>
                        <option>Select category...</option>
                        <option>Compra</option>
                        <option>Extra</option>
                        <option>Ocio</option>
                    </select>
                </span>
            </p>

            <p style="margin-left: 20px">
                <a class="button is-info">Filter</a>
                <a style="margin-left: 5px" class="button">Reset</a>
            </p>
        </div>
    </nav>

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
                <th>Value</th>
                <th>Category</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($transactions as $transaction)
                <tr>
                    <td>{{ $transaction->date->format('d-m-Y') }}</td>
                    <td>
                        {{ $transaction->name }}
                        @if ($transaction->tags->isNotEmpty())
                            <p style="font-size: 13px">
                                <strong>
                                    {{ $transaction->tags()->pluck('name')->implode(',') }}
                                </strong>
                            </p>
                        @endif
                    </td>
                    <td style="text-align: right; position: relative; right: 50px;">
                        @if ($transaction->amount > 0)
                            <strong>
                                {{ $transaction->formattedAmount }}&euro;
                            </strong>
                            @else
                            {{ $transaction->formattedAmount }}&euro;
                        @endif
                    </td>
                    <td>
                        @if ($transaction->category)
                            <span class="tag" style="background-color: #{{ $transaction->category->color }}">
                                {{ $transaction->category->name }}
                            </span>
                        @endif
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
        {{ $transactions->links() }}
    @endif
@endsection
