@extends('layouts.logged')

@section('title')
    Budgets
    <a class="button is-pulled-right is-primary is-inverted" href="{{ route('budgets.create') }}">
        Add budget
    </a>
@endsection

@section('main')
    @if (session('error'))
        <div class="notification is-warning">
            {{ session('error') }}
        </div>
    @endif

    @if (count($budgets) > 0)
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($budgets as $budget)
                    <tr>
                        <td><a href="{{ route('budgets.show', [$budget]) }}">{{ $budget->name }}</a></td>
                        <td>
                            <a class="button is-pulled-left is-small is-info" href="{{ route('budgets.edit', $budget) }}">Edit</a>

                            <form style="margin-left: 10px;" class="is-pulled-left" action="{{ route('budgets.destroy', $budget) }}" method="post">
                                {{ csrf_field() }}
                                {{ method_field('delete') }}
                                <button class="button is-small is-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <div class="notification">
            No budgets defined
        </div>
    @endif
@endsection