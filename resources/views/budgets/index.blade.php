@extends('layouts.logged')

@section('title')
    Budgets
@endsection

@section('main')
    @if (count($budgets) > 0)
        <ul class="budgets">
            @foreach ($budgets as $budget)
                <li class="budgets-{{ $budget->id }}">{{ $budget->name }}</li>

                <a href="{{ route('budgets.edit', $budget) }}">Edit</a>

                <form action="{{ route('budgets.destroy', $budget) }}" method="post">
                    {{ csrf_field() }}
                    {{ method_field('delete') }}
                    <button>Delete</button>
                </form>
            @endforeach
        </ul>
    @endif

    <div>
        <a href="{{ route('budgets.create') }}">Add budget</a>
    </div>
@endsection