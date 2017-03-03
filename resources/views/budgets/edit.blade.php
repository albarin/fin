@extends('layouts.logged')

@section('title')
    Edit budget
@endsection

@section('main')
    <form class="form-horizontal" action="{{ route('budgets.update', $budget) }}" method="post">
        {{ method_field('put') }}
        @include('budgets.form')
    </form>
@endsection
