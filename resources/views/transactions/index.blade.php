@extends('layouts.logged')

@section('title')
    Transactions
@endsection

@section('main')
    @if (count($transactions) > 0)
        <table class="table table-hover">
            <thead>
                <tr>
                    <td>Name</td>
                    <td>Description</td>
                    <td>Amount</td>
                    <td>Date</td>
                    <td>Category</td>
                    <td>Actions</td>
                </tr>
            </thead>
            @foreach ($transactions as $transaction)
                <tbody>
                    <tr>
                        <td>{{ $transaction->name }}</td>
                        <td>{{ $transaction->description }}</td>
                        <td>{{ $transaction->amount }}€</td>
                        <td>{{ $transaction->date }}</td>
                        <td>{{ isset($transaction->category_id) ? $transaction->category->name : '' }}</td>
                        <td>
                            <a href="{{ route('transactions.edit', $transaction) }}">Edit</a>
    
                            <form action="{{ route('transactions.destroy', $transaction) }}" method="post">
                                {{ csrf_field() }}
                                {{ method_field('delete') }}
                                <button>Delete</button>
                            </form>
                        </td>
                    </tr>
                </tbody>
            @endforeach
        </table>
    @endif

    <div>
        <a href="{{ route('transactions.create') }}">Add transaction</a>
    </div>
@endsection