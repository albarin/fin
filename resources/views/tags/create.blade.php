@extends('layouts.logged')

@section('title')
    Create new tag
@endsection

@section('main')
    <div class="columns">
        <div class="column is-half">
            <form class="form-horizontal" action="{{ route('tags.store') }}" method="post">
                @include('tags.form')
            </form>
        </div>
    </div>
@endsection
