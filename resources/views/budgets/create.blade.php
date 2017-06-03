@extends('layouts.logged')

@section('title')
    Add budget
@endsection

@section('main')
    <div class="columns">
        <div class="column is-half">
            <form class="form-horizontal" action="{{ route('budgets.store') }}" method="post">
                @include('budgets.form')
            </form>
        </div>
    </div>
@endsection
