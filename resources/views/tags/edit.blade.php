@extends('layouts.logged')

@section('title')
    Edit <strong>{{ $tag->name }}</strong> tag
@endsection

@section('main')
    <div class="columns">
        <div class="column is-half">
            <form class="form-horizontal" action="{{ route('tags.update', $tag) }}" method="post">
                {{ method_field('put') }}
                @include('tags.form')
            </form>
        </div>
    </div>
@endsection
