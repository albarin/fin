@extends('layouts.logged')

@section('title')
    Create new budget
@endsection

@section('main')
    <form class="form-horizontal" action="{{ route('budgets.store') }}" method="post">
        @include('budgets.form')
    </form>
@endsection
