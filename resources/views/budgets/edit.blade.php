@extends('layouts.logged')

@section('title')
    Edit <strong>{{ $budget->name }}</strong> budget
@endsection

@section('main')
    <div class="columns">
        <div class="column is-half">
            <form class="form-horizontal" action="{{ route('budgets.update', $budget) }}" method="post">
                {{ method_field('put') }}
                @include('budgets.form')
            </form>
        </div>
    </div>
@endsection
